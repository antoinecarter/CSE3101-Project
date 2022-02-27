<?php
    include __DIR__."/header.php";
    $usercontroller = new UsersController();
    if(isset($_POST['update_user'])){
        $cred = $usercontroller->updateuser();
    }else if (isset($_POST['delete_user'])){
        $cred = $usercontroller->deleteuser();
    }
    $statement = $usercontroller->viewuser();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<div class = "edit-usr">
    <div><?php echo $_SESSION['id']; 
        if(isset($cred)){ echo $cred;}?></div>
    <form method="post" action="">
        <div>
            <a href="./Users"> <button name="delete_user"> Delete</button></a>
            <button type="submit" name="update_user">Apply Changes</button>
        </div>
        <div>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>"required>
            <label for="email">Email</label>
            <input type="text" name="email" value="<?php echo $row['email']; ?>" required>
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
            <label for="passcode">Password(Please re-enter password if any changes)</label>
            <input type="password" name="passcode" required>
            <label for="role">Role</label>
            <select name="role" id="" required>
                <option value="ADMIN" <?php if($row['role'] == 'ADMIN'){?>selected <?php } ?>>ADMIN</option>
                <option value="USER" <?php if($row['role'] == 'USER'){?>selected <?php } ?>>USER</option>
            </select>
            <label for="start_date">Effective From</label>
            <input type="date" name="start_date" value="<?php echo $row['start_date']; ?>" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
            <label for="end_date">Effective To</label>
            <input type="date" name="end_date" value="<?php echo $row['end_date']; ?>" <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
            <label for="status">Status</label>
            <select name="status" id="" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
                <option value="KEYED" <?php if($row['status'] == 'KEYED'){?>selected <?php } ?>>Keyed</option>
                <option value="VERIFY" <?php if($row['status'] == 'VERIFY'){?>selected <?php } ?>>Verify</option>
                <option value="UNVERIFY" <?php if($row['status'] == 'UNVERIFY'){?>selected <?php } ?>>Unverify</option>
            </select>
        </div>
        <div style="height:100px;"></div>
        <?php if($_SESSION['role'] == 'ADMIN'){ ?>
        <div>
            <label for="org_id">Organization</label>
            <input type="text" name="org_id">
            <label for="emp_no">Employee No.</label>
            <input type="text" name="emp_no">
            <label for="can_create">Can Create</label>
            <select name="can_create" id="">
                <option value="1" <?php if($row['can_create'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_create'] == 0){?>selected <?php } ?>>No</option>
            </select>
            <label for="can_view">Can View</label>
            <select name="can_view" id="">
                <option value="1" <?php if($row['can_view'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_view'] == 0){?>selected <?php } ?>>No</option>
            </select>
            <label for="can_update">Can Update</label>
            <select name="can_update" id="">
                <option value="1" <?php if($row['can_update'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_update'] == 0){?>selected <?php } ?>>No</option>
            </select>
            <label for="can_delete">Can Delete</label>
            <select name="can_delete" id="">
                <option value="1" <?php if($row['can_delete'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_delete'] == 0){?>selected <?php } ?>>No</option>
            </select>
            <label for="can_verify">Can Verify</label>
            <select name="can_verify" id="">
                <option value="1" <?php if($row['can_verify'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_verify'] == 0){?>selected <?php } ?>>No</option>
            </select>
            <label for="can_approve">Can Approve</label>
            <select name="can_approve" id="">
                <option value="1" <?php if($row['can_approve'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_approve'] == 0){?>selected <?php } ?>>No</option>
            </select>
        </div>
        <?php } ?>
        
    </form>
    <div>
        <a href="./Users"> <button>Return</button></a>
        
    </div>
</div>

<?php
    include_once __DIR__."/footer.php";
?>