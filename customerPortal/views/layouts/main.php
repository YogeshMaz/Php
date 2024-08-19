<!DOCTYPE html>
<html>
<head>
    <title>Customer Portal</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Navigation</h2>
            <ul>
                <li><a href="../summary/summary.php">Summary</a></li>
                <li><a href="../yourprojects/yourprojects.php">Projects</a></li>
                <li><a href="../analytics/analytics.php">Analytics</a></li>
                <li><a href="../logout">Logout</a></li>
            </ul>
        </aside>
        <main class="content">
            <?php echo $content; ?>
        </main>
    </div>
    <script src="/assets/js/script.js"></script>
</body>
</html>
