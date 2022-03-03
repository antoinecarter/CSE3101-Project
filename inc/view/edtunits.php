<?php
    include __DIR__."/header.php";
    $unitscontroller = new UnitsController();
    if(isset($_POST['update_units'])){
        $cred = $unitscontroller->updateunits();
    }else if (isset($_POST['delete_units'])){
        $cred = $unitscontroller->deleteunits();
    }
    $statement = $unitsModel->viewunit();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    
$departmentscontroller = new DepartmentsController();
$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();
$orgstructcontroller = new OrgstructureController();
$orgstruct = $orgstructcontroller->orgstructList($_SESSION['org_id']);
$depts= $departmentscontroller->deptList($_SESSION['org_id']);
?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit Units</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Org Structure Name</span1>
            <span1>Parent Department</span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($orgs){ ?>
                    <option value="<?php echo $orgs['id']; ?>"><?php echo $orgs['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="org_struct_id" ></label>
            <select name="org_struct_id" required>
                <option value="">--Select Organization Structure--</option>

                <?php while($orgstruct){ ?>
                    <option value="<?php echo $orgstruct['id']; ?>" <?php if($row['org_struct_id'] == $orgstruct['id']){?> selected <?php } ?>><?php echo $orgstruct['org_struct_name'];?></option>
                <?php } ?>
            </select>

            <label for="Parent Department" ></label>
            <select name="parent_dept_id">
                <option value="">--Select Parent Department--</option>

                <?php while($depts){ ?>
                    <option value="<?php echo $depts['id']; ?>" <?php if($row['parent_dept_id'] == $depts['id']){?> selected <?php } ?>><?php echo $depts['department'];?></option>
                <?php } ?>
            </select>t>
           </p>
           <span>Unit Code</span>
           <span>Unit Name</span>   
           <span>Unit Level</span>   
           <p>
            <label for="unit_code" ></label>
            <input type="text" placeholder="Enter Unit Code" name="unit_code" value="<?php echo $row['unit_code'];?>" required>
        
            <label for="unit_name"></label>
            <input type="password" placeholder="Enter Unit Name" name="unit_name" value="<?php echo $row['unit_name'];?>" required>

            <label for="unit_level"></label>
            <input type="password" placeholder="Enter Unit Level" name="unit_level" value="<?php echo $row['unit_level'];?>" required>
            </p>
            <span>Start Date</span>
            <span>End Date</span>
            <span>Status</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" value="<?php echo $row['start_date'];?>" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date" value="<?php echo $row['start_date'];?>">

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
                <button type="submit" name="update_units">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Units/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_units"> Delete</button></a> <?php } ?>
 
            </div>
    </form>
    <div>
    <a href="./Units" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
    include_once __DIR__."/footer.php";
?>