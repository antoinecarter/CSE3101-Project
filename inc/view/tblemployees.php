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
        <?php if($_SESSION['role'] == 'ADMIN'){?>  <a href="./Employees/Registration"><button>Add Emp.</button></a> <?php } ?>
    </h2>
        <a style= "margin-left: 7px;"> Num Of Employees: <?php echo $num_rows; ?></a>
        <div class="tblfx">
        <table>
            <thead>
                <?php if($_SESSION['can_view'] == 1){?><th>Edit</th> <?php } ?>
                <th>Employee</th>
                <th>Payment Frequency</th>
                <th>Employment Date</th>
                <th>Rate of Pay</th>
                <th>Seperation Status</th>
                <th>Seperation Date</th>
                <th>Shift</th>
            </thead>
            <tbody>
                <?php
                    if($num_rows == 0){
                        echo '<tr><td colspan="10" style="text-align: center; font-family: Lato, sans-serif; font-size: 20px; font-weight: bolder">--No Data Found--</td></tr>';
                    }
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                <?php if($_SESSION['can_view'] == 1){?><td><a href="./Employees/Registration/Edit?id=<?php echo $row['id']; ?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td> <?php } ?>
                    <td><?php echo $row['employee']; ?></td>
                    <td><?php echo $row['payment_frequency']; ?></td>
                    <td><?php echo date_format(date_create($row['emp_date']), "d-M-Y"); ?></td>
                    <td><?php echo $row['rate_of_pay']; ?></td>
                    <td><?php if(isset($row['separation_status'])){echo $row['separation_date'];}else{ echo '-';} ?></td>
                    <td><?php if(isset($row['separation_date'])){echo date_format(date_create($row['separation_date']), "d-M-Y");}else{ echo '-';} ?></td>
                    <td><?php echo $row['shift']; ?></td>
                </tr>
            <?php } ?>
        
        </tbody>
    </table>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>