<?php
    include __DIR__."/header.php";
    $employeesModel = new EmployeesController();
    if(isset($_POST['update_emp'])){
        $cred = $employeesModel->updateemp();
    }else if (isset($_POST['delete_emp'])){
        $cred = $employeesModel->deleteemp();
    }
    $statement = $employeesModel->viewemp();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<div class = "edit-usr">
    <div><?php if(isset($cred)){ echo $cred;}?></div>
        <?php if(isset($row['id'])){?>
            <div>
    <form method="post" action="">
        <h2>Update Employee</h2>
        <div>
            <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            </p>
           <p>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required>
            </p>
           <p>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>"required>
            </p>
           <p>
            <label for="email">Email</label>
            <input type="text" name="email" value="<?php echo $row['email']; ?>" required>
            </p>
           <p>
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
           </p>
           <p>
            <label for="passcode">Password</label>
            <input type="password" name="passcode">
           </p>
           <p>
            <label for="role">Role</label>
            <select name="role" id="" required>
                <option value="ADMIN" <?php if($row['role'] == 'ADMIN'){?>selected <?php } ?>>ADMIN</option>
                <option value="USER" <?php if($row['role'] == 'USER'){?>selected <?php } ?>>USER</option>
            </select>
            </p>
           <p>
            <label for="start_date">Effective From</label>
            <input type="date" name="start_date" value="<?php echo $row['start_date']; ?>" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
            </p>
           <p>
            <label for="end_date">Effective To</label>
            <input type="date" name="end_date" value="<?php echo $row['end_date']; ?>" <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
            </p>
           <p>
            <label for="status">Status</label>
            <select name="status" id="" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
                <option value="KEYED" <?php if($row['status'] == 'KEYED'){?>selected <?php } ?>>Keyed</option>
                <option value="VERIFY" <?php if($row['status'] == 'VERIFY'){?>selected <?php } ?>>Verify</option>
                <option value="UNVERIFY" <?php if($row['status'] == 'UNVERIFY'){?>selected <?php } ?>>Unverify</option>
            </select>
        </div>
        </p>
           <p>
        <div style="height:100px;"></div>
        <?php if($_SESSION['role'] == 'ADMIN'){ ?>
        <div>
            <p>
            <label for="org_id">Organization</label>
            <input type="text" name="org_id">
            </p>
           <p>
            <label for="emp_no">Employee No.</label>
            <input type="text" name="emp_no">
            </p>
         
 
           
        </div>
        <?php } ?>
        <div>
                <button type="submit" name="update_emp">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Users/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_emp"> Delete</button></a> <?php } ?>
 
 
            </div>
    </form>
    <?php } ?>
    <div>
                
        <a href="./Users"> <button style = "background-color:#0b74eb;">Return</button></a>
        
    </div>
    </div>
    
    
    
</div>

<?php
    include_once __DIR__."/footer.php";
?>