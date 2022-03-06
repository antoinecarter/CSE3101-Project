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
    $orgcontroller = new OrganizationsController();
    $empcontroller = new EmployeesController();
    $orgs = $orgcontroller->orgList();
    $emps = $empcontroller->empList($_SESSION['org_id']);
?>
<div class = "form-usr">
    <div><?php if(isset($cred)){ echo $cred;}?></div>
        <?php if(isset($row['id'])){?>
            <div>
    <form method="post" action="">
        <h2>Create/Edit User Account</h2>
        <div>
            <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            </p>
            <span1>First Name </span1>                                                   
            <span1>Last Name</span1>
            
           <p>
            <label for="first_name"></label>
            <input type="text" name="first_name" placeholder="Enter First Name" value="<?php echo $row['first_name']; ?>" required>
            
            <label for="last_name"></label>
            <input type="text" name="last_name" placeholder="Enter Last Name" value="<?php echo $row['last_name']; ?>"required>
            </p>
            <span1>Email </span1> 
            <p>
            <label for="email"></label>
            <input style="width: auto; height:35px" type="email" name="email" placeholder="Enter Email" value="<?php echo $row['email']; ?>" required>
            </p>
                                                              
            <span>Username</span>
            <span>Password</span>  
            <p>
           
            <label for="username"></label>
            <input type="text" name="username" placeholder="Enter Username" value="<?php echo $row['username']; ?>" required>
 
            <label for="passcode"></label>
            <input type="password" name="passcode">
           </p>
           <span>Effective From</span>
            <span>Effective To</span>
           <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" value="<?php echo $row['start_date']; ?>" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
       
            <label for="end_date"></label>
            <input type="date" name="end_date" value="<?php echo $row['end_date']; ?>" <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
            </p>
            <span>Role</span>
            <span>Status</span>
            <p>
            <label for="role"></label>
            <select name="role" id="" required>
                <option value="ADMIN" <?php if($row['role'] == 'ADMIN'){?>selected <?php } ?>>ADMIN</option>
                <option value="USER" <?php if($row['role'] == 'USER'){?>selected <?php } ?>>USER</option>
            </select>
 
            <label for="status"></label>
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
        <span>Organization</span>
            <span>Employee No.</span>
            <p>
            <label for="org_id"></label>
            <select name="org_id">
                <option value="">--Select Organization--</option>

                <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>" <?php if($row['org_id'] == $org['id']){ ?> selected <?php } ?>><?php echo $org['full_name'];?></option>
                <?php } ?>
            </select>
            <label for="emp_no"></label>
            <select name="emp_no" id="">
                <option value="">--Attach Employee--</option>
                <?php while($emp = $emps->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $emp['id']; ?>" <?php if($row['employee_no'] == $emp['id']){ ?> selected <?php } ?>><?php echo $emp['employee'];?></option>
                <?php } ?>
            </select>
            </p>
            <span>Can Create</span>
            <span>Can View</span>
            <span>Can Update</span>
           <p>
            <label for="can_create"></label>
            <select name="can_create" id="">
                <option value="1" <?php if($row['can_create'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_create'] == 0){?>selected <?php } ?>>No</option>
            </select>
    
            <label for="can_view"></label>
            <select name="can_view" id="">
                <option value="1" <?php if($row['can_view'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_view'] == 0){?>selected <?php } ?>>No</option>
            </select>

            <label for="can_update"></label>
            <select name="can_update" id="">
                <option value="1" <?php if($row['can_update'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_update'] == 0){?>selected <?php } ?>>No</option>
            </select>
            </p>

            <span>Can Delete</span>
            <span>Can Verify</span>
            <span>Can Approve</span>
           <p>
            <label for="can_delete"></label>
            <select name="can_delete" id="">
                <option value="1" <?php if($row['can_delete'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_delete'] == 0){?>selected <?php } ?>>No</option>
            </select>

            <label for="can_verify"></label>
            <select name="can_verify" id="">
                <option value="1" <?php if($row['can_verify'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_verify'] == 0){?>selected <?php } ?>>No</option>
            </select>

            <label for="can_approve"></label>
            <select name="can_approve" id="">
                <option value="1" <?php if($row['can_approve'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['can_approve'] == 0){?>selected <?php } ?>>No</option>
            </select>
            </p>
           
        </div>
        <?php } ?>
        <div>
                <button type="submit" name="update_user">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Users/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_user"> Delete</button></a> <?php } ?>
 
 
            </div>
    </form>
    <?php } ?>
    <div>
                
    <a href="./Users" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
    </div>
    
    
    
</div>

<?php
    include_once __DIR__."/footer.php";
?>