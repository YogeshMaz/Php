<?php
// Start output buffering
ob_start();

// Your page content
?>
<h1>Summary Page</h1>
<div>
    <h2>Summary Details</h2>
    <p><?php echo htmlspecialchars($summaryData['details']); ?></p>
    <p>Other Summary Information:</p>
    <ul>
        <?php foreach ($summaryData['items'] as $item): ?>
            <li><?php echo htmlspecialchars($item); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php

// Capture the content and store it in $content
$content = ob_get_clean();

// Include the layout file
require '../views/layouts/main.php';
?>
