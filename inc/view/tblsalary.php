<?php
include __DIR__ . "/header.php";
$salarycontroller = new SalaryController();
$statement = $salarycontroller->viewsals();
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
    <h5>Salary</h5>
</div>
<div class = "usrtb">
        <h2>Listing of Salary
        <a href="./Salary/Registration"><button>Add Sal.</button></a></h2>
        <a style= "margin-left: 7px;"> Num Of Salary: <?php echo $num_rows; ?></a>
        <div class="tblfx">
        <table>
            <thead>
                <th>Edit</th>
                <th>Organization Id</th>
                <th>Employee Id</th>
                <th>Salary</th>
                <th>NIS Deduct</th>
                <th>Taxable</th>
                <th>Monthly Basic</th>
                <th>Daily Rate</th>
                <th>Hourly Rate</th>
                <th>Start Date</th>
                <th>End Date</th>
            </thead>
            <tbody>
                <?php
                    if($num_rows == 0){
                        echo '<tr><td colspan="7" style="text-align: center; font-family: Lato, sans-serif; font-size: 20px; font-weight: bolder">--No Data Found--</td></tr>';
                    }
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><a href="./Salary/Registration/Edit?id=<?php echo $row['id'];?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td>
                    <td><?php echo $row['org_id']; ?></td>
                    <td><?php echo $row['emp_id']; ?></td>
                    <td><?php echo $row['salary']; ?></td>
                    <td><?php echo $row['nis_deduct']; ?></td>
                    <td><?php echo $row['taxable']; ?></td>
                    <td><?php echo $row['monthly_basic']; ?></td>
                    <td><?php echo $row['daily_rate']; ?></td>
                    <td><?php echo $row['hourly_rate']; ?></td>
                    <td><?php echo date_format(date_create($row['start_date']), "d-M-Y"); ?></td>
                    <td><?php echo date_format(date_create($row['end_date']), "d-M-Y"); ?></td>

                </tr>
            <?php } ?>
        
        </tbody>
    </table>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>