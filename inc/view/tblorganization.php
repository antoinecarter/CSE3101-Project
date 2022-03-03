<?php
include __DIR__ . "/header.php";
$Organizationscontroller = new OrganizationsController();
$statement = $Organizationscontroller->vieworgs();
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
    <h5>Organizations</h5>
</div>
<div class = "usrtb">
        <h2>Listing of Organizations
        <a href="./Organizations/Registration"><button>Add Org.</button></a></h2>
        <a style= "margin-left: 7px;"> Num Of Organizations: <?php echo $num_rows; ?></a>
        <div class="tblfx">
        <table>
            <thead>
                <th>Edit</th>
                <th>Organization Id</th>
                <th>Short Name</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>Telephone</th>
                <th>Fax</th>
                <th>Email</th>
                <th>Country</th>
                <th>Start Date</th>
                <th>End Date</th>
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
                    <td><a href="./Organizations/Registration/Edit?id=<?php echo $row['id'];?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td>
                    <td><?php echo $row['org_id']; ?></td>
                    <td><?php echo $row['short_name']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['telephone']; ?></td>
                    <td><?php echo $row['fax'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['country'];?></td>
                    <td><?php echo date_format(date_create($row['start_date']), "d-M-Y"); ?></td>
                    <td><?php echo date_format(date_create($row['end_date']), "d-M-Y"); ?></td>
                    <td><?php echo $row['status']; ?></td>

                </tr>
            <?php } ?>
        
        </tbody>
    </table>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>