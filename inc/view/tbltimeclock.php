<?php
include __DIR__ . "/header.php";
$timeclockscontroller = new TimeclocksController();
$statement = $timeclockscontroller->viewtimes();
$num_rows = $statement->rowCount();
?>
<div class="breadcrumb">
    <?php 
    $path = $_SERVER["REQUEST_URI"];
    $url = $_SERVER['REQUEST_SCHEME'] . '://';
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
    $url_components = parse_url($url);
    parse_str($url_components['path'], $params);?>
    <h5>Timeclocks</h5>
</div>
<div class = "usrtb">
        <h2>Listing of Timeclocks
        <a href="./Timeclocks/Registration"><button>Add Time</button></a></h2>
        <a style= "margin-left: 7px;"> Num Of Timeclocks: <?php echo $num_rows; ?></a>
        <div class="tblfx">
        <table>
            <thead>
            <?php if($_SESSION['role'] == 'ADMIN'){?>  <th>Edit</th> <?php } ?>
                <th>Work Date</th>
                <th>Day</th>
                <th>Employee</th>
                <th>Shift</th>
                <th>Shift Hours</th>
                <th>Min Time In</th>
                <th>Max Time Out</th>
                <th>Hours Worked</th>
                <th>status</th>
            </thead>
            <tbody>
                <?php
                    if($num_rows == 0){
                        echo '<tr><td colspan="10" style="text-align: center; font-family: Lato, sans-serif; font-size: 20px; font-weight: bolder">--No Data Found--</td></tr>';
                    }
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                <?php if($_SESSION['role'] == 'ADMIN'){?>  <td><a href="./Timeclocks/Registration/Edit?id=<?php echo $row['id']; ?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td> <?php } ?>
                    <td><?php echo date_format(date_create($row['work_date']), "d-M-Y"); ?></td>
                    <td><?php echo $row['day']; ?></td>
                    <td><?php echo $row['employee']; ?></td>
                    <td><?php echo $row['shift']; ?></td>
                    <td><?php echo $row['shift_hours']; ?></td>
                    <td><?php echo $row['min']; ?></td>
                    <td><?php echo $row['max']; ?></td>
                    <td><?php echo $row['hours_worked']; ?></td>
                    <td><?php echo $row['status']; ?></td>

                </tr>
            <?php } ?>
        
        </tbody>
    </table>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>