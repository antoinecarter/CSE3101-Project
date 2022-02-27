
    <?php
    include __DIR__ . "/header.php";
    $usercontroller = new UsersController();
    $statement = $usercontroller->viewusers();
    $num_rows = $statement->rowCount();
    ?>
    <div class="breadcrumb">
  
        <h5>Home/User Accounts</h5>
    </div>
    <div>
        <h2>Listing of User Accounts</h2>
    </div>
    <div>

        <a href="./Users/Registration"><button>Add New</button></a>
    </div>
    <div class = "usrtb">
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
                        <td><a href="Users/Registration/Edit/<?php echo $row['id'];?>"><img alt= "" style="width:30px; height:30px" src="include/edit.png"></a></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['last_name'] .','. $row['first_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <?php if($_SESSION['role'] == 'ADMIN'){?> <td><?php echo $row['role']; ?></td> <?php } ?>
                        <td><?php echo date_format(date_create($row['start_date']), "d-M-Y"); ?></td>
                        <td><?php if(isset($row['end_date'])){echo date_format(date_create($row['end_date']), "d-M-Y");}else{ echo '-';} ?></td>
                        
                    </tr>
                <?php } ?>
                <td>      <?php echo $num_rows; ?></td>
            </tbody>
        </table>
    </div>

    <?php
    include __DIR__ . "/footer.php";
    ?>
