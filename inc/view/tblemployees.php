<?php
include __DIR__ . "/header.php";
$employeesModel = new EmployeesController();
$statement = $employeesModel->viewemps();
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
        <a href="./Users/Registration"><button>Add New</button></a></h2>
        <a style= "margin-left: 7px;"> Num Of Users: <?php echo $num_rows; ?></a>
        <div class="tblfx">
        <table>
            <thead>
                <th>Edit</th>
                <th>Username</th>
                <th>Fullname</th>
                <th>Email</th>
                <?php if($_SESSION['role'] == 'ADMIN'){ echo '<th>Role</th>'; } ?>
                <th>Effective From</th>
                <th>Effective To</th>
            </thead>
            <tbody>
                <?php
                    if($num_rows == 0){
                        echo '<tr><td colspan="7" style="text-align: center; font-family: Lato, sans-serif; font-size: 20px; font-weight: bolder">--No Data Found--</td></tr>';
                    }
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><a href="./Users/Registration/Edit?id=<?php echo $row['id'];?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['last_name'] .','. $row['first_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <?php if($_SESSION['role'] == 'ADMIN'){?> <td><?php echo $row['role']; ?></td> <?php } ?>
                    <td><?php echo date_format(date_create($row['start_date']), "d-M-Y"); ?></td>
                    <td><?php if(isset($row['end_date'])){echo date_format(date_create($row['end_date']), "d-M-Y");}else{ echo '-';} ?></td>
                </tr>
            <?php } ?>
        
        </tbody>
    </table>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>