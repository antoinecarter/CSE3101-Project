<?php
include __DIR__ . "/header.php";
$compyearcontroller = new CompyearController();
$statement = $compyearcontroller->viewcompyrs();
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
        <h5>Company Years</h5>
</div>
<div class = "usrtb">
        <h2>Listing of Company Years
        <a href="./Compyear/Registration"><button>Add Compyr.</button></a></h2>
        <a style= "margin-left: 7px;"> Num Of Company Years Recorded: <?php echo $num_rows; ?></a>

        <div class="tblfx">
     
        <table>
            <thead>
                <tr>
                <th>Edit</th>
                <th>Organization Id</th>
                <th>Year</th>
                <th>Start Year</th>
                <th>End Year</th>
                <th>Payment Frequency</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($num_rows == 0){
                        echo '<tr><td colspan="7" style="text-align: center; font-family: Lato, sans-serif; font-size: 20px; font-weight: bolder">--No Data Found--</td></tr>';
                    }
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><a href="./Compyear/Registration/Edit?id=<?php echo $row['id'];?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td>
                    <td><?php echo $row['org_id']; ?></td>
                    <td><?php echo date_format(date_create($row['year']), "Y"); ?></td>
                    <td><?php echo date_format(date_create($row['start_year']), "Y"); ?></td>
                    <td><?php if(isset($row['end_date'])){echo date_format(date_create($row['end_year']), "Y");}else{ echo '-';} ?></td>
                    <td><?php echo $row['payment_frequency']; ?></td>
                </tr>
            <?php } ?>
            <script src="./js/script.js"></script>
        </tbody>
    </table>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>