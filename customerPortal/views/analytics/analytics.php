<?php
ob_start();
?>

<h1>Analytics Page</h1>
<div>
    <h2>Data Overview</h2>
    <canvas id="analyticsChart" width="400" height="200"></canvas>
    <script>
        var ctx = document.getElementById('analyticsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($analyticsData['labels']); ?>,
                datasets: [{
                    label: 'Analytics Data',
                    data: <?php echo json_encode($analyticsData['values']); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>

<?php
$content = ob_get_clean();
require '../views/layouts/main.php';
?>
