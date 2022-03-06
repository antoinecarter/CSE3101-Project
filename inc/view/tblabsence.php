<?php
include __DIR__ . "/header.php";
$absencecontroller = new AbsenceController();
$statement = $absencecontroller->viewabsences();
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
        
    
    <h5>Absence</h5>
</div>
<div class = "usrtb">
        <h2>Listing of Absences
        <?php if($_SESSION['role'] == 'ADMIN'){?>  <a href="./Absence/Registration"><button>Add Absence</button></a><?php } ?>
        </h2> 
        <a style= "margin-left: 7px;"> Num Of Absences: <?php echo $num_rows; ?></a>



        <div class="tblfx">
     
        <table>
            <thead>
                <tr>
                <?php if($_SESSION['role'] == 'ADMIN'){ ?><th>Edit</th> <?php } ?>
                <th>Employee </th>
                <th>Work Date</th>
                <th>Shift</th>
                <th>Shift Hours</th>
                <th>Status</th>
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
                <?php if($_SESSION['role'] == 'ADMIN'){ ?><td><a href="./Absence/Registration/Edit?parent_id=<?php echo $row['emp_id'];?>&id=<?php echo $row['id']; ?>"><img style="width:30px; height:30px" src="./inc/view/include/edit.png"></a></td><?php } ?>
                    <td><?php echo $row['employee'];?></td>
                    <td><?php echo date_format(date_create($row['work_date']), "d-M-Y"); ?></td>
                    <td><?php echo $row['shift'];?></td>
                    <td><?php echo $row['shift_hours']; ?></td>
                    <td><?php echo $row['status'];?></td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>
    </body>
</div>
    <?php
    include __DIR__ . "/footer.php";
    ?>