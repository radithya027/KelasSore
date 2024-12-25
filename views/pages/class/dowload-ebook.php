<?php
// Explicitly set error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Use absolute paths with dirname to ensure correct file inclusion
require_once dirname(__DIR__, 3) . '/models/BookModel.php';
require_once dirname(__DIR__, 3) . '/services/database.php';

// Enhanced logging function with directory creation
function logError($message) {
    $logDir = dirname(__DIR__, 3) . '/logs';
    $logFile = $logDir . '/download-ebook.log';
    
    // Create logs directory if it doesn't exist
    if (!file_exists($logDir)) {
        if (!mkdir($logDir, 0755, true)) {
            // If we can't create log directory, fallback to system log
            error_log('Failed to create log directory. Message: ' . $message);
            return;
        }
    }
    
    // Ensure the log directory is writable
    if (!is_writable($logDir)) {
        chmod($logDir, 0755);
        if (!is_writable($logDir)) {
            error_log('Log directory is not writable. Message: ' . $message);
            return;
        }
    }
    
    // Format the log message with timestamp
    $formattedMessage = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
    
    // Try to write to log file
    if (!error_log($formattedMessage, 3, $logFile)) {
        // Fallback to system log if file logging fails
        error_log('Failed to write to log file. Message: ' . $message);
    }
}

try {
    // Start session for potential authentication checks
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Validate book ID
    if (!isset($_GET['book_id']) || !is_numeric($_GET['book_id'])) {
        logError('Invalid book ID: ' . ($_GET['book_id'] ?? 'No ID provided'));
        http_response_code(400);
        die('Invalid book ID');
    }

    $bookId = intval($_GET['book_id']);
    $bookModel = new BookModel();

    // Fetch the book details
    $book = $bookModel->getBookById($bookId);

    if (!$book || empty($book['ebook_file'])) {
        logError("Book not found or no ebook file for ID: $bookId");
        http_response_code(404);
        die('Ebook not found');
    }

    // Normalize the file path
    $bookFile = str_replace('\\', '/', $book['ebook_file']);
    $bookFile = ltrim($bookFile, '/');

    // Construct full file path with multiple potential base directories
    $possibleBasePaths = [
        dirname(__DIR__, 3) . '/public/',
        $_SERVER['DOCUMENT_ROOT'] . '/public/',
        dirname(__DIR__, 3) . '/public/ebooks/',
        $_SERVER['DOCUMENT_ROOT'] . '/public/ebooks/'
    ];

    $filePath = false;
    foreach ($possibleBasePaths as $basePath) {
        $testPath = $basePath . $bookFile;
        $testPath = str_replace('\\', '/', $testPath); // Normalize path
        
        logError("Checking path: $testPath");
        
        if (file_exists($testPath)) {
            $filePath = $testPath;
            break;
        }
    }

    if (!$filePath) {
        logError("File not found in any of the potential paths for: " . $bookFile);
        http_response_code(404);
        die('Ebook file does not exist');
    }

    // Validate file
    if (!is_readable($filePath)) {
        logError("File not readable: $filePath");
        http_response_code(403);
        die('Unable to read file');
    }

    // Get file information
    $fileName = basename($filePath);
    $fileSize = filesize($filePath);
    
    // Safer MIME type detection
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($finfo, $filePath);
    finfo_close($finfo);

    // Validate file type
    $allowedTypes = ['application/pdf', 'application/epub+zip'];
    if (!in_array($fileType, $allowedTypes)) {
        logError("Invalid file type: $fileType");
        http_response_code(400);
        die('Invalid file type');
    }

    // Clear any existing output
    if (ob_get_level()) {
        ob_end_clean();
    }

    // Send download headers
    header('Content-Type: ' . $fileType);
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Length: ' . $fileSize);
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Output file in chunks to handle large files
    $handle = fopen($filePath, 'rb');
    if ($handle === false) {
        logError("Failed to open file: $filePath");
        http_response_code(500);
        die('Failed to process file');
    }

    while (!feof($handle)) {
        $buffer = fread($handle, 8192);
        if ($buffer === false) {
            break;
        }
        echo $buffer;
        flush();
    }

    fclose($handle);
    exit;

} catch (Exception $e) {
    logError('Download error: ' . $e->getMessage());
    http_response_code(500);
    die('An error occurred during download');
}