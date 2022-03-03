<?php
include __DIR__ . "/header.php";
$employeescontroller = new EmployeesController();
$statement = $employeescontroller->viewemps();
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
    <h5>Employees</h5>
</div>
<div class = "usrtb">
        <h2>Listing of Employees
        <a href="./Employees/Registration"><button>Add Emp.</button></a></h2>
        <a style= "margin-left: 7px;"> Num Of Employees: <?php echo $num_rows; ?></a>
        <div class="tblfx">
        <table>
            <thead>
                <th>Edit</th>
                <th>Organization Id</th>
                <th>Employee Id</th>
                <th>Individual Id</th>
                <th>Position Id</th>
                <th>Payment Frequency</th>
                <th>Employee Type</th>
                <th>Employee Status</th>
                <th>Employee Date</th>
                <th>Annual Leave Date</th>
                <th>Rate of Pay</th>
                <th>Seperation Status</th>
                <th>Seperation Date</th>
                <th>shift Id</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php
                    if($num_rows == 0){
                        echo '<tr><td colspan="7" style="text-align: center; font-family: Lato, sans-serif; font-size: 20px; font-weight: bolder">--No Data Found--</td></tr>';
                    }
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><a href="./Employees/Registration/Edit?id=<?php echo $row['id'];?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td>
                    <td><?php echo $row['org_id']; ?></td>
                    <td><?php echo $row['emp_no']; ?></td>
                    <td><?php echo $row['ind_id']; ?></td>
                    <td><?php echo $row['position_id']; ?></td>
                    <td><?php echo $row['payment_frequency']; ?></td>
                    <td><?php echo $row['emp_type'];?></td>
                    <td><?php echo $row['emp_status'];?></td>
                    <td><?php echo date_format(date_create($row['emp_date']), "d-M-Y"); ?></td>
                    <td><?php echo date_format(date_create($row['ann_leave_date']), "d-M-Y"); ?></td>
                    <td><?php echo $row['rate_of_pay']; ?></td>
                    <td><?php echo $row['seperation_status']; ?></td>
                    <td><?php echo date_format(date_create($row['seperation_date']), "d-M-Y"); ?></td>
                    <td><?php echo $row['shift_id']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php } ?>
        
        </tbody>
    </table>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>