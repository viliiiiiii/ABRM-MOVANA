<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/csrf.php';
require_once __DIR__ . '/../../core/helpers.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_validate()) {
        $error = 'Invalid CSRF token';
    } else {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        if ($email && $password) {
            $result = login($email, $password);
            if ($result['success']) {
                header('Location: ' . base_url('landing'));
                exit;
            }
            $error = $result['message'];
        } else {
            $error = 'Email and password are required';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">
    <title>Login - ABRM</title>
</head>
<body class="container">
    <div class="card" style="max-width:420px;margin:3rem auto;">
        <h2>Login</h2>
        <?php if ($error): ?><p style="color:red;"><?php echo e($error); ?></p><?php endif; ?>
        <form method="post">
            <?php echo csrf_input(); ?>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button class="button" style="margin-top:1rem;width:100%;">Login</button>
        </form>
    </div>
</body>
</html>
