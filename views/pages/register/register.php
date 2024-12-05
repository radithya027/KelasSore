<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/register/register.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&display=swap" rel="stylesheet">
    <title>Register</title>
</head>
<body>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Register Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #000842;">
                <!-- Gambar dengan tinggi lebih besar -->
                <div class="featured-image mb-8">
                    <img src="assets/images/login.svg" class="img-fluid" style="width: 200px; height: 300px;" alt="Featured Image">
                </div>
                <!-- Font diganti ke Manrope -->
                <p class="text-white fs-2" style="font-family: 'Manrope', sans-serif; font-weight: 600;">Register for KelasSore</p>
            </div>

            <!--------------------------- Right Box ---------------------------->

            <div class="col-md-5 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>KelasSore</h2>
                        <p>Create your account to get started.</p>
                    </div>
                    <form action="process_register.php" method="POST">
                      
                        <!-- Input untuk nomor telepon -->
                        <!-- <div class="input-group mb-3">
                            <input type="text" name="phone" class="form-control form-control-lg bg-light fs-6" 
                                placeholder="Enter your phone number" 
                                style="font-weight: 400;" 
                                required>
                        </div> -->

                        <!-- Input untuk email -->
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control form-control-lg bg-light fs-6" 
                                placeholder="Enter your email address" 
                                style="font-weight: 600;" 
                                required>
                        </div>

                        <!-- Input untuk password -->
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" 
                                placeholder="Enter your password" 
                                style="font-weight: 600;" 
                                required>
                        </div>

                        <!-- Input untuk konfirmasi password -->
                        <div class="input-group mb-4">
                            <input type="password" name="confirm_password" class="form-control form-control-lg bg-light fs-6" 
                                placeholder="Confirm your password" 
                                style="font-weight: 600;" 
                                required>
                        </div>

                        <!-- Tombol register -->
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Register</button>
                        </div>
                    </form>
                    <div class="row">
                        <small>Already have an account? <a href="login.php">Login</a></small>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
