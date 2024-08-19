<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php if (isset($error)): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form action="../../contollers/LoginController.php" method="post">
        <label for="username">Email:</label>
        <input type="text" name="email" id="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    <a href="/forgot_password">Forgot Password?</a>
</body>
</html>
