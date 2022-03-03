<?php
include __DIR__ . "/header.php";
$leavetrackcontroller = new LeavetrackController();
$statement = $leavetrackcontroller->viewleavetracks();
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
        
    
    <h5>Leave Track</h5>
</div>
<div class = "usrtb">
        <h2>Listing of Leave Track
        <a href="./Leavetrack/Registration"><button>Add Track</button></a></h2>
        <a style= "margin-left: 7px;"> Num Of Leaves Tracked: <?php echo $num_rows; ?></a>



        <div class="tblfx">
     
        <table>
            <thead>
                <tr>
                <th>Edit</th>
                <th>Organization Id</th>
                <th>Employee Id</th>
                <th>Company Year Id</th>
                <th>Leave Entitlement Id</th>
                <th>Leave Request Id</th>
                <th>Leave Type</th>
                <th>Entitled Day</th>
                <th>Leave Earned</th>
                <th>Leave Used</th>
                </tr>
            </thead>
            </div>
            <tbody>

                <?php
                    if($num_rows == 0){
                        echo '<tr><td colspan="7" style="text-align: center; font-family: Lato, sans-serif; font-size: 20px; font-weight: bolder">--No Data Found--</td></tr>';
                    }
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><a href="./Leavetrack/Registration/Edit?id=<?php echo $row['id'];?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td>
                    <td><?php echo $row['org_id']; ?></td>
                    <td><?php echo $row['emp_id'];?></td>
                    <td><?php echo $row['com_year_id'];?></td>
                    <td><?php echo $row['leave_ent_id'];?></td>
                    <td><?php echo $row['leave_req_id'];?></td>
                    <td><?php echo $row['leave_type'];?></td>
                    <td><?php echo $row['entitled_days'];?></td>
                    <td><?php echo $row['leave_earned'];?></td>
                    <td><?php echo $row['leave_used'];?></td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>
    </body>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>