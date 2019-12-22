<div class="card p-2" style="background-color : rgba(255, 255, 255, 0.6) !important">
    <h5 class="justify-content-center text-center" ><?= $title?></h5>
    <div class="chart">
        <canvas id="<?= $chart_id?>" style="height:250px; min-height:250px"></canvas>
    </div>
</div>
<script>
    var budget_plan = <?php echo json_encode($budget_plan) ?>;
    var budget_realization = <?php echo json_encode($budget_realization) ?>;
    var areaChartData = {
        labels: [ "Januari",'Februari', 'Maret', 'April', 'Mei','Juni', 'Juli',  'Agustus','September', 'Oktober','November','Desember' ],
        datasets: [{
                label: 'Tidak Hadir',
                backgroundColor: 'rgba(235,22,22,0.9)',
                borderColor: 'rgba(235,22,22,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: budget_plan
            },
            {
                label: 'Hadir',
                backgroundColor: 'rgba(65, 193, 65, 1)',
                borderColor: 'rgba(65, 193, 65, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: budget_realization
            },
        ]
    }
    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                },
                

            }],
            yAxes: [{
                gridLines: {
                    display: false,
                },
                ticks: {
                        beginAtZero: true,
                        stepSize: 10,
                        max: 100
                },
            }]
        }
    }
    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#<?= $chart_id?>').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    })
</script>