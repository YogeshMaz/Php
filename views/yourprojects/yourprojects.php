<?php
ob_start();
?>

<h1>Projects Page</h1>
<div>
    <h2>Projects List</h2>
    <table>
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Status</th>
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects['data'] as $project): ?>
                <tr>
                    <td><?php echo htmlspecialchars($project['name']); ?></td>
                    <td><?php echo htmlspecialchars($project['status']); ?></td>
                    <td><?php echo htmlspecialchars($project['due_date']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
require '../views/layouts/main.php';
?>
