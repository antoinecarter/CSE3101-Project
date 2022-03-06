
<canvas id="leavetypes" style="width: 100%; height:200px;"></canvas>

<script>
    <?php 
    $leavedashcontroller = new LeaveentitlemtController();
    $statement = $leavedashcontroller->leavetypeDashboard();
    $num_rows = $statement->rowCount(); 

    $leavetypes = array();
    $counts = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        $leavetypes[] = $row['leave_type'];
        $counts[] = $row['counts'];
    }
    ?>

    var densityCanvas = document.getElementById("leavetypes");

    Chart.defaults.global.defaultFontFamily="Lato";
    Chart.defaults.global.defaultFontSize = 18;

    var countData = {
        label: 'Count',
        data: [<?php foreach($counts as $count){echo $count . ",";}?>],
        backgroundColor: 'rgba(99,132,0,0.6)',
        borderColor: 'rgba(99,132,0,1)'
    };

    var leaveData = {
        labels: [<?php foreach($leavetypes as $leavetype){echo "'".$leavetype."',";}?>],
        datasets: countData,
        backgroundColor: [
            "#DEB887",
            "#A9A9A9",
            "#DC143C",
            "#F4A460",
            "#2E8B57"
        ],
        borderColor: [
          "#CDA776",
          "#989898",
          "#CB252B",
          "#E39371",
          "#1D7A46"
        ],
        borderWidth: [1, 1, 1, 1, 1, 1, 1],
        
        

    };

    var chartOptions = {
        responsive: true,
        title: {
            display:true,
            position: "top",
            text: "Allocation of Leave Types in the Organization",
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

    var doughnutChart = new Chart(densityCanvas, {
        type: 'doughnut',
        data: leaveData,
        options: chartOptions
    });

</script>