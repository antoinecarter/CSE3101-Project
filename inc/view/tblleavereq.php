<?php
include __DIR__ . "/header.php";
$leaverequestscontroller = new LeaverequestsController();
$statement = $leaverequestscontroller->viewleavreqs();
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

    <body>
        
    
    <h5>Leave Request</h5>
</div>
<div class = "usrtb">
        <h2>Listing of Leave Request
        <a href="./Leaverequests/Registration"><button>Add Request</button></a></h2>
        <a style= "margin-left: 7px;"> Num Of Leave Request: <?php echo $num_rows; ?></a>



        <div class="tblfx">
     
        <table>
            <thead>
                <tr>
                <th>Edit</th>
                <th>Employee</th>
                <th>Leave Type</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Resumption Date</th>
                <th>Approved By</th>
                <th>Approved Date</th>
                <th>Status</th>
                </tr>
            </thead>
            </div>
            <tbody>

                <?php
                    if($num_rows == 0){
                        echo '<tr><td colspan="10" style="text-align: center; font-family: Lato, sans-serif; font-size: 20px; font-weight: bolder">--No Data Found--</td></tr>';
                    }
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><a href="./Leaverequests/Registration/Edit?id=<?php echo $row['id'];?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td>
                    <td><?php echo $row['employee']; ?></td>
                    <td><?php echo $row['leave_type'];?></td>
                    <td><?php echo date_format(date_create($row['from_date']), "d-M-Y"); ?></td>
                    <td><?php echo date_format(date_create($row['to_date']), "d-M-Y"); ?></td>
                    <td><?php echo date_format(date_create($row['resumption_date']), "d-M-Y"); ?></td>
                    <td><?php echo $row['approved_by'];?></td>
                    <td><?php if(isset($row['approved_date'])){echo date_format(date_create($row['approved_date']), "d-M-Y");}else{ echo '-';} ?></td>
                    <td><?php echo $row['status'];?></td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>
    </body>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>