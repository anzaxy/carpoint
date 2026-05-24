<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login - CarPoint</title>
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet'>
    <style>
        body {
            background: linear-gradient(135deg, #272c33 0%, #1a1e24 100%);
            font-family: 'Open Sans', sans-serif;
        }
        .login-content {
            max-width: 450px;
            margin: 8vh auto;
        }
        .login-form {
            background: #fff;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 25px;
        }
        .login-logo img {
            max-width: 180px;
        }
        .btn-login {
            background: #20a8d8;
            border: none;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            color: white;
            border-radius: 5px;
        }
        .btn-login:hover {
            background: #1985ac;
        }
        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-content">
        <div class="login-logo">
            <a href="<?= base_url() ?>">
                <img src="<?= base_url('images/logo.png') ?>" alt="CarPoint">
            </a>
        </div>
        <div class="login-form">

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-circle"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('login/proses') ?>" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fa fa-sign-in"></i> Sign In
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">CarPoint - Sistem Jual Beli Mobil Bekas</small>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
</body>
</html>