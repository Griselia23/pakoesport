<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap 5 CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS for login page -->
    <style>
        body {
            background-color: #f4f6f9;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            width: 100%;
            font-size: 16px;
        }

        .login-btn:hover {
            background-color: darkred;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

    </style>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <h3>Login</h3>
        <p>Please enter your credentials to continue</p>
    </div>

    <!-- Login Form -->
     <div>
     <form action="<?php echo base_url('login/authenticate'); ?>" method="post">
    <div class="mb-3">
        <label for="npk" class="form-label">NPK</label>
        <input type="text" class="form-control" id="npk" name="npk" required placeholder="Enter your npk">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
    </div>
    <button type="submit" class="btn login-btn">Login</button>
</form>

    </div>
    <br>

    <!-- Footer Text -->
    <div class="footer-text">
        <p>Don't have an account? ask admin to create for u</a></p>
    </div>
</div>

<!-- Bootstrap 5 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if ($this->session->flashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?php echo $this->session->flashdata('error'); ?>',
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Welcome!',
            text: '<?php echo $this->session->flashdata('success'); ?>',
        });
    <?php endif; ?>
</script>

</body>
</html>
