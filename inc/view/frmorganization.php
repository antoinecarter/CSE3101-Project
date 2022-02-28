<?php
include __DIR__ . "/header.php";
$organizationsModel = new OrganizationsController();
if (isset($_POST['create_org'])) {
    $cred = $organizationsModel->createorg();
}
?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create new user</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
           <p>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" required>
            </p>
           <p>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" required>
            </p>
           <p>
            <label for="email">Email</label>
            <input type="text" name="email" required>
            </p>
           <p>
            <label for="username">Username</label>
            <input type="text" name="username" required>
            </p>
           <p>
            <label for="passcode">Password</label>
            <input type="password" name="passcode" required>
            </p>
           <p>
            <label for="role">Role</label>
            <select name="role" id="" required>
                <option value="ADMIN">ADMIN</option>
                <option value="USER">USER</option>
            </select>
            </p>
           <p>
            <label for="start_date">Effective From</label>
            <input type="date" name="start_date" required>
            </p>
           <p>
            <label for="end_date">Effective To</label>
            <input type="date" name="end_date">
            </p>
           <p>
            <label for="status">Status</label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option>
            </select>
            </p>
           <p>
        </div>
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
           <p>
            <label for="can_create">Can Create</label>
            <select name="can_create" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            </p>
           <p>
            <label for="can_view">Can View</label>
            <select name="can_view" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            </p>
           <p>
            <label for="can_update">Can Update</label>
            <select name="can_update" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            </p>
           <p>
            <label for="can_delete">Can Delete</label>
            <select name="can_delete" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            </p>
           <p>
            <label for="can_verify">Can Verify</label>
            <select name="can_verify" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            </p>
           <p>
            <label for="can_approve">Can Approve</label>
            <select name="can_approve" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            </p>
           <p>
      <?php if($_SESSION['role']=='ADMIN'){ ?><button type="submit" name="create_org">Create</button> <?php } ?>
      </p>
        </div>
        <?php } ?>
        
    </form>
    <div>
        <a href="./Users" > <button style = "background-color:#0b74eb;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>