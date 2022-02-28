<?php
    include __DIR__."/header.php";
    $usercontroller = new UsersController();
    if(isset($_POST['create_user'])){
        $cred = $usercontroller->createuser();
    }
?>
<div class = "form-usr">
    <div><?php echo $_SESSION['role']; 
        if(isset($cred)){ echo $cred;}?></div>
    <form method="post" action="">
        <div>
        <h2>Create new user</h2>
            <?php if($_SESSION['role']=='ADMIN'){ ?><button type="submit" name="create_user">Create</button> <?php } ?>
        </div>
        <div>
            <label for="id"></label>
            <input type="hidden" name="id">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" required>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" required>
            <label for="email">Email</label>
            <input type="text" name="email" required>
            <label for="username">Username</label>
            <input type="text" name="username" required>
            <label for="passcode">Password</label>
            <input type="password" name="passcode" required>
            <label for="role">Role</label>
            <select name="role" id="" required>
                <option value="ADMIN">ADMIN</option>
                <option value="USER">USER</option>
            </select>
            <label for="start_date">Effective From</label>
            <input type="date" name="start_date" required>
            <label for="end_date">Effective To</label>
            <input type="date" name="end_date">
            <label for="status">Status</label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option>
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
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <label for="can_view">Can View</label>
            <select name="can_view" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <label for="can_update">Can Update</label>
            <select name="can_update" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <label for="can_delete">Can Delete</label>
            <select name="can_delete" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <label for="can_verify">Can Verify</label>
            <select name="can_verify" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <label for="can_approve">Can Approve</label>
            <select name="can_approve" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <?php } ?>
        
    </form>
</div>

<?php
    include_once __DIR__."/footer.php";
?>