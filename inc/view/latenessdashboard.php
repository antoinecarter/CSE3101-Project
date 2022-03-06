
<canvas id="lateness" style="width: 100%; height:500px;"></canvas>

<script>
    <?php 
    $abslatdashcontroller = new LatenessController();
    $statement = $abslatdashcontroller->latenessAndAbsenceDashboard($_SESSION['role'], $_SESSION['emp_no']);
    $num_rows = $statement->rowCount(); 

    $employees = array();
    $latenesses = array();
    $absences = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        $employees[] = $row['employee'];
        $latenesses[] = $row['lateness'];
        $absences[] = $row['absences'];
    }
    ?>

    var densityCanvas = document.getElementById("lateness");

    Chart.defaults.global.defaultFontFamily="Lato";
    Chart.defaults.global.defaultFontSize = 18;

    var latenessData = {
        label: 'Lateness',
        data: [<?php foreach($latenesses as $lateness){echo $lateness . ",";}?>],
        backgroundColor: 'rgba(0,99,132,0.6)',
        borderColor: 'rgba(0,99,132,1)',
        yAxisID: "y-axis-lateness"
    };

    var absenceData = {
        label: 'Absence',
        data: [<?php foreach($absences as $absence){echo $absence . ",";}?>],
        backgroundColor: 'rgba(99,132,0,0.6)',
        borderColor: 'rgba(99,132,0,1)',
        yAxisID: "y-axis-absence"
    };

    var empData = {
        labels: [<?php foreach($employees as $employee){echo "'".$employee."',";}?>],
        datasets: [latenessData, absenceData]
    };

    var chartOptions = {
        scales: {
            xAxes: [{
                barPercentage: 1,
                categoryPercentage: 0.6
            }],
            yAxes: [{
                id: "y-axis-lateness"
            }, {
                id: "y-axis-absence"
            }]
        },
        responsive: true,
        title: {
            display:true,
            position: "top",
            text: "Lateness and Absence Per Employee",
            fontSize: 18,
            fontColor: "#fff"
        },
        legend: {
            display: true,
            position: "right",
            labels: {
                fontColor: "#fff",
                fontSize: 16
            }
        }
    };

    var barChart = new Chart(densityCanvas, {
        type: 'bar',
        data: empData,
        options: chartOptions
    });

</script>