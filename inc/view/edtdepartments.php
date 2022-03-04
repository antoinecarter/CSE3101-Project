<?php
    include __DIR__."/header.php";
    $departmentscontroller = new DepartmentsController();
    if(isset($_POST['update_dpt'])){
        $cred = $departmentscontroller->updatedpt();
    }else if (isset($_POST['delete_dpt'])){
        $cred = $departmentscontroller->deletedpt();
    }
    $statement = $departmentscontroller->viewdpt();   
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $orgcontroller = new OrganizationsController();
    $orgs = $orgcontroller->orgList();
    $orgstructcontroller = new OrgstructureController();
    $orgstructs = $orgstructcontroller->orgstructList($_SESSION['org_id']);
    $depts= $departmentscontroller->exdeptList($row['id'], $_SESSION['org_id']);
?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
  <?php if(isset($row['id'])){?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit Department</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Org Struct Name</span1>
            <span1>Parent Dept</span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>" <?php if($row['org_id'] == $org['id']){ ?> selected <?php } ?>><?php echo $org['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="org_struct_id" ></label>
            <select name="org_struct_id" required>
                <option value="">--Select Organization Structure--</option>

                <?php while($orgstruct = $orgstructs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $orgstruct['id']; ?>" <?php if($row['org_struct_id'] == $orgstruct['id']){ ?> selected <?php } ?>><?php echo $orgstruct['org_struct_name'];?></option>
                <?php } ?>
            </select>

            <label for="Parent Department" ></label>
            <select name="parent_dept_id">
                <option value="">--Select Parent Department--</option>

                <?php while($dept = $depts->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $dept['id']; ?>" <?php if($row['parent_dept_id'] == $dept['id']){ ?> selected <?php } ?>><?php echo $dept['department'];?></option>
                <?php } ?>
            </select>
           </p>
           <span>Dept Code</span>
           <span>Dept Name</span>   
           <span>Dept Level</span>   
           <p>
            <label for="dept_code" ></label>
            <input type="text" placeholder="Enter Department Code" name="dept_code" value="<?php echo $row['dept_code'];?>" required>
        
            <label for="dept_name"></label>
            <input type="text" placeholder="Enter Department Name" name="dept_name" value="<?php echo $row['dept_name'];?>" required>

            <label for="dept_level"></label>
            <input style="width: 100px;" type="number" placeholder="Enter Department Level" name="dept_level" value="<?php echo $row['dept_level'];?>" required>
            </p>
            <span>Start Date</span>
            <span>End Date</span>
            <span>Status</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" value="<?php echo $row['start_date'];?>" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date" value="<?php echo $row['end_date'];?>">

            <label for="status"></label>
            <select name="status" id="" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
                            <option value="KEYED" <?php if($row['status'] == 'KEYED'){?>selected <?php } ?>>Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY" <?php if($row['status'] == 'VERIFY'){?>selected <?php } ?>>Verify</option>
                <option value="UNVERIFY" <?php if($row['status'] == 'UNVERIFY'){?>selected <?php } ?>>Unverify</option> <?php } ?>
            </select>
            </p>
        </div>
        <div style="height:100px;"></div>
        <div>
                <button type="submit" name="update_dpt">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Departments/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_dpt"> Delete</button></a> <?php } ?>
 
 
            </div>
        
    </form>
    <?php }?>
    <div>
    <a href="./Departments" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
    include_once __DIR__."/footer.php";
?>