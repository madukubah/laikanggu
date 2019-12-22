<div class="card p-2" style="background-color : rgba(255, 255, 255, 0.6) !important">
    <h5 class="justify-content-center text-center" ><?= ($title) ?></h5>
    <div class=" ml-5 mr-5 chart">
        <canvas id="<?= $chart_id?>" style="height:230px; min-height:230px"></canvas>
    </div>
    
</div>
<script>
    var donutData = {
        labels: <?= json_encode( $labels ) ?>,
        datasets: [{
            data: <?= json_encode( $data ) ?> ,
            backgroundColor: <?= json_encode( $backgroundColor ) ?>,//['rgba(65, 193, 65, 1)', 'rgba(235,22,22,0.9)', 'rgba(239, 239, 26, 1)', 'rgba(26, 111, 239, 1)'],
        }]
    }
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#<?= $chart_id?>').get(0).getContext('2d')
    var pieData = donutData;
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    })
</script>