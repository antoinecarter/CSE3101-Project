<?php
    
    include_once("header.php");
    if(isset($_POST['create_user'])){
        $cred = $usercontroller->createuser();
    }
?>
<div>
    <?php if(isset($cred)){ ?>
        <h5><?php echo $cred; ?></h5>
    <?php } ?>
    <form method="post" action="">
        <div>
            <button type="submit" name="create_user">Create</button>
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
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" required>
            <label for="end_date">End Date</label>
            <input type="date" name="end_date">
            <label for="status">Status</label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option>
            </select>
        </div>
        <div style="height:100px;"></div>
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
        
    </form>
</div>

<?php
    include_once __DIR__."/footer.php";
?>