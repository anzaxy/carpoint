<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - CarPoint | Jual Beli Mobil Bekas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        /* Container split 50:50 */
        .login-container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        /* Sisi Kiri - Gambar Mobil */
        .login-image {
            flex: 1;
            background: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(0,0,0,0.5)), 
                        url('<?= base_url('images/car-bg.jpg') ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .login-image .overlay-text {
            text-align: center;
            color: white;
            padding: 20px;
        }

        .login-image .overlay-text h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
        }

        .login-image .overlay-text p {
            font-size: 18px;
            opacity: 0.9;
        }

        .login-image .overlay-text .car-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        /* Sisi Kanan - Form Login */
        .login-form-container {
            flex: 1;
            background: linear-gradient(135deg, #f5f7fa 0%, #fff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-box {
            max-width: 400px;
            width: 100%;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo img {
            max-width: 180px;
        }

        .login-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-title h3 {
            color: #333;
            font-weight: 600;
            font-size: 24px;
        }

        .login-title p {
            color: #777;
            font-size: 14px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color: #555;
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 8px;
            display: block;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #20a8d8;
            box-shadow: 0 0 0 3px rgba(32,168,216,0.1);
            outline: none;
        }

        .checkbox {
            margin: 15px 0;
        }

        .checkbox label {
            color: #777;
            font-size: 13px;
            font-weight: normal;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #20a8d8;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #1985ac;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(32,168,216,0.3);
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 12px 15px;
            font-size: 13px;
        }

        .alert-danger {
            background: #fff5f5;
            border-left: 4px solid #dc3545;
            color: #dc3545;
        }

        .alert-success {
            background: #f0fff4;
            border-left: 4px solid #28a745;
            color: #28a745;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-image {
                display: none;
            }
            .login-form-container {
                flex: 100%;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Sisi Kiri: Gambar Mobil -->
    <div class="login-image">
        <div class="overlay-text">
            <div class="car-icon">
                <i class="fa fa-car"></i>
            </div>
            <h1>CarPoint</h1>
            <p>Jual Beli Mobil Bekas Terpercaya</p>
            <p style="margin-top: 20px; font-size: 14px;">
                <i class="fa fa-check-circle"></i> Mobil Berkualitas<br>
                <i class="fa fa-check-circle"></i> Harga Terjangkau<br>
                <i class="fa fa-check-circle"></i> Proses Cepat & Aman
            </p>
        </div>
    </div>

    <!-- Sisi Kanan: Form Login -->
    <div class="login-form-container">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?= base_url() ?>">
                    <img src="<?= base_url('images/logo.png') ?>" alt="CarPoint Logo">
                </a>
            </div>

            <div class="login-title">
                <h3>Selamat Datang!</h3>
                <p>Silakan login untuk melanjutkan</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-circle"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <i class="fa fa-check-circle"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('index.php?page=login/proses') ?>" method="post">
                <div class="form-group">
                    <label><i class="fa fa-user"></i> Username</label>
                    <div class="input-group">
                        <i class="fa fa-user"></i>
                        <input type="text" 
                               name="username" 
                               class="form-control" 
                               placeholder="Masukkan username"
                               value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fa fa-lock"></i> Password</label>
                    <div class="input-group">
                        <i class="fa fa-lock"></i>
                        <input type="password" 
                               name="password" 
                               class="form-control" 
                               placeholder="Masukkan password"
                               required>
                    </div>
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fa fa-sign-in"></i> Sign In
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fa fa-car"></i> CarPoint - Sistem Jual Beli Mobil Bekas
                </small>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

<script>
    // Auto close alert setelah 3 detik
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").fadeOut("slow", function() {
                $(this).remove();
            });
        }, 3000);
    });
</script>

</body>
</html>