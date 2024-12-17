<?php
// Explicitly set error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Use absolute paths with dirname to ensure correct file inclusion
require_once dirname(__DIR__, 3) . '/models/BookModel.php';
require_once dirname(__DIR__, 3) . '/services/database.php';

// Logging function
function logError($message) {
    error_log($message, 3, dirname(__DIR__, 3) . '/logs/download-ebook.log');
}

try {
    // Start session for potential authentication checks
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Optional: Authentication check
    // Uncomment and modify as per your authentication logic
    // if (!isset($_SESSION['user_id'])) {
    //     logError('Unauthorized download attempt');
    //     die('Unauthorized access');
    // }

    // Validate book ID
    if (!isset($_GET['book_id']) || !is_numeric($_GET['book_id'])) {
        logError('Invalid book ID: ' . ($_GET['book_id'] ?? 'No ID provided'));
        die('Invalid book ID');
    }

    $bookId = intval($_GET['book_id']);
    $bookModel = new BookModel();

    // Fetch the book details
    $book = $bookModel->getBookById($bookId);

    if (!$book || empty($book['ebook_file'])) {
        logError("Book not found or no ebook file for ID: $bookId");
        die('Ebook not found');
    }

    // Debug logging for file paths
    logError("Attempting to download book ID: $bookId");
    logError("Ebook file path from DB: " . $book['ebook_file']);

    // Construct full file path with multiple potential base directories
    $possibleBasePaths = [
        dirname(__DIR__, 3) . '/public/',
        $_SERVER['DOCUMENT_ROOT'] . '/public/',
        dirname(__DIR__, 3) . '/public/ebooks/',
        $_SERVER['DOCUMENT_ROOT'] . '/public/ebooks/'
    ];

    $filePath = false;
    foreach ($possibleBasePaths as $basePath) {
        $testPath = $basePath . $book['ebook_file'];
        if (file_exists($testPath)) {
            $filePath = $testPath;
            break;
        }
    }

    if (!$filePath) {
        logError("File not found in any of the potential paths for: " . $book['ebook_file']);
        die('Ebook file does not exist');
    }

    logError("Found file path: $filePath");

    // Validate file
    if (!is_readable($filePath)) {
        logError("File not readable: $filePath");
        die('Unable to read file');
    }

    // Get file information
    $fileName = basename($filePath);
    $fileSize = filesize($filePath);
    $fileType = mime_content_type($filePath);

    // Send download headers
    header('Content-Type: ' . $fileType);
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Length: ' . $fileSize);
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');

    // Output file contents
    readfile($filePath);
    exit;

} catch (Exception $e) {
    logError('Download error: ' . $e->getMessage());
    die('An error occurred during download');
}