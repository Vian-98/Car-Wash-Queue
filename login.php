<?php
session_start();
// Jika sudah login, lempar ke index
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
$error = isset($_GET['error']) ? 'Username atau password salah!' : '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Antrian</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f6f6f6; }
        form { background: #fff; border: 1px solid #ddd; padding: 20px; border-radius: 5px; }
        input { display: block; margin-bottom: 10px; width: 250px; padding: 8px; }
        button { padding: 10px 15px; background: #3949ab; color: #fff; border: 0; cursor: pointer; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <form method="post" action="login_process.php">
        <h2>Login Admin</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>