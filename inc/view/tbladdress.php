<?php
include __DIR__ . "/header.php";
$addresscontroller = new AddressController();
$statement = $addresscontroller->viewaddreses();
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
        
    
    <h5>Address</h5>
</div>
<div class = "usrtb">
        <h2>Listing of Addresss
        <a href="./Address/Registration"><button>Add Address</button></a></h2>
        <a style= "margin-left: 7px;"> Num Of Addresss: <?php echo $num_rows; ?></a>



        <div class="tblfx">
     
        <table>
            <thead>
                <tr>
                <th>Edit</th>
                <th>Organization Id</th>
                <th>Individuals Id</th>
                <th>Address Type</th>
                <th>Lot</th>
                <th>Address Line 1</th>
                <th>Address Line 2</th>
                <th>Address Line 3</th>
                <th>Country</th>
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
                    <td><a href="./Address/Registration/Edit?id=<?php echo $row['id'];?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td>
                    <td><?php echo $row['org_id']; ?></td>
                    <td><?php echo $row['ind_id'];?></td>
                    <td><?php echo $row['address_type'];?></td>
                    <td><?php echo $row['lot'];?></td>
                    <td><?php echo $row['address_line1'];?></td>
                    <td><?php echo $row['address_line2'];?></td>
                    <td><?php echo $row['address_line3'];?></td>
                    <td><?php echo $row['country'];?></td>
                    <td><?php echo date_format(date_create($row['start_date']), "d-M-Y"); ?></td>
                    <td><?php echo date_format(date_create($row['end_date']), "d-M-Y"); ?></td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>
    </body>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>