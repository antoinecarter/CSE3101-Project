<?php
include __DIR__ . "/header.php";
$unitscontroller = new UnitsController();
$statement = $unitscontroller->viewunits();
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
    <h5>Units</h5>
</div>
<div class = "usrtb">
        <h2>Listing of Units
        <a href="./Units/Registration"><button>Add Unit</button></a></h2>
        <a style= "margin-left: 7px;"> Num Of Units: <?php echo $num_rows; ?></a>
        <div class="tblfx">
        <table>
            <thead>
                <th>Edit</th>
                <th>Organization Structure</th>
                <th>Parent Dept.</th>
                <th>Code</th>
                <th>Unit Name</th>
                <th>Level</th>
                <th>Start Date</th>
                <th>End Date</th>

            </thead>
            <tbody>
                <?php
                    if($num_rows == 0){
                        echo '<tr><td colspan="10" style="text-align: center; font-family: Lato, sans-serif; font-size: 20px; font-weight: bolder">--No Data Found--</td></tr>';
                    }
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><a href="./Units/Registration/Edit?id=<?php echo $row['id'];?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td>
                    <td><?php echo $row['org_struct_name']; ?></td>
                    <td><?php echo $row['parent_dept_name']; ?></td>
                    <td><?php echo $row['unit_code']; ?></td>
                    <td><?php echo $row['unit_name']; ?></td>
                    <td><?php echo $row['unit_level']; ?></td>
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