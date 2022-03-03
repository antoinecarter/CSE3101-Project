<?php
include __DIR__ . "/header.php";
$referencescontroller = new ReferencesController();
$statement = $referencescontroller->viewrefs();
$num_rows = $statement->rowCount();
?>
<div class="breadcrumb">
    <h5>References</h5>
</div>
<div class = "usrtb">
        <h2>Listing of References
        <a href="./References/Registration"><button>Add Ref.</button></a></h2>
        <a style= "margin-left: 7px;"> Num Of References: <?php echo $num_rows; ?></a>
        <div class="tblfx">
        <table>
            <thead>
                <th>Edit</th>
                <th>Table Name</th>
                <th>Table Description</th>
                <th>Table Value</th>
                <th>Value Description</th>
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
                    <td><a href="./References/Registration/Edit?id=<?php echo $row['id'];?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td>
                    <td><?php echo $row['table_name']; ?></td>
                    <td><?php echo $row['table_desc']; ?></td>
                    <td><?php echo $row['table_value']; ?></td>
                    <td><?php echo $row['value_desc']; ?></td>
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