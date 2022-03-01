<?php
include __DIR__ . "/header.php";
$usercontroller = new UsersController();
if (isset($_POST['create_user'])) {
    $cred = $usercontroller->createuser();
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
            <span1>First Name </span1>                                                   
            <span1>Last Name</span1>
            <span1>Email </span1>  
           <p>
            <label for="first_name" ></label>
            <input type="text" placeholder="Enter First Name" name="first_name" required>

            <label for="last_name" ></label>
            <input type="text" placeholder="Enter Last Name" name="last_name" required>

            <label for="email" ></label>
            <input type="text" placeholder="Enter Email" name="email" required>
           </p>
           <span>Username</span>
           <span>Password</span>   
           <p>
            <label for="username" ></label>
            <input type="text" placeholder="Enter Username" name="username" required>
        
            <label for="passcode"></label>
            <input type="password" placeholder="Enter Passcode" name="passcode" required>
            </p>
            <span>Effective From</span>
            <span>Effective To</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date">
            </p>
            <span>Role</span>
            <span>Status</span>
           <p>
            <label for="role"></label>
            <select name="role" id="" required>
                <option value="ADMIN">ADMIN</option>
                <option value="USER">USER</option>
            </select>
      
            <label for="status"></label>
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
            <span>Organization</span>
            <span>Employee No.</span>
        <p>
            <label for="org_id"></label>
            <input type="text" placeholder=" Enter Organization" name="org_id">
           
            <label for="emp_no"></label>
            <input type="text" placeholder=" Enter Employee No." name="emp_no">
            </p>
            <span>Can Create</span>
            <span>Can View</span>
            <span>Can Update</span>
           <p>
            <label for="can_create"></label>
            <select name="can_create" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
     
            <label for="can_view"></label>
            <select name="can_view" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

      
            <label for="can_update"></label>
            <select name="can_update" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            </p>
           <span>Can Delete</span>
           <span>Can Verify</span>
            <span>Can Approve</span>
           <p>
            <label for="can_delete"></label>
            <select name="can_delete" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

            <label for="can_verify"></label>
            <select name="can_verify" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        
            <label for="can_approve"></label>
            <select name="can_approve" id="">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            </p>
           <p>
      <?php if($_SESSION['role']=='ADMIN'){ ?><button type="submit" name="create_user">Create</button> <?php } ?>

      </p>
  
        </div>
        <?php } ?>
        
    </form>
    <div>
    <a href="./Users" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>