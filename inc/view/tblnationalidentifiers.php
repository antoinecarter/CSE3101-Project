<?php
include __DIR__ . "/header.php";
$nationalidentifiersController = new NationalidentifiersController();
$statement = $nationalidentifiersController->viewnationalidentifiers();
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
        
    
    <h5>National Identifier</h5>
</div>
<div class = "usrtb">
        <h2>Listing of National Identifier
        <?php if($_SESSION['role'] == 'ADMIN'){?> <a href="./NationalIdentifier/Registration"><button>Add Identifier</button></a> <?php } ?>
    </h2>
        <a style= "margin-left: 7px;"> Num Of National Identifiers: <?php echo $num_rows; ?></a>



        <div class="tblfx">
     
        <table>
            <thead>
                <tr>
                <th>Edit</th>
                <th>Individual</th>
                <th>Identifier</th>
                <th>Start Date</th>
                <th>End Date</th>
   
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
                    <td><a href="./NationalIdentifier/Registration/Edit?id=<?php echo $row['id'];?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td>
                    <td><?php echo $row['individual'];?></td>
                    <td><?php echo $row['natid'];?></td>
                    <td><?php echo date_format(date_create($row['start_date']), "d-M-Y"); ?></td>
                    <td><?php if(isset($row['end_date'])){echo date_format(date_create($row['end_date']), "d-M-Y");}else{ echo '-';} ?></td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>
    </body>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>