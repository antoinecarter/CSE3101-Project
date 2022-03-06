<?php
    include __DIR__."/header.php";
    $unitscontroller = new UnitsController();
    if(isset($_POST['update_units'])){
        $cred = $unitscontroller->updateunits();
    }else if (isset($_POST['delete_units'])){
        $cred = $unitscontroller->deleteunits();
    }
    $statement = $unitscontroller->viewunit();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    
$departmentscontroller = new DepartmentsController();
$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();
$orgstructcontroller = new OrgstructureController();
$orgstructs = $orgstructcontroller->orgstructList($_SESSION['org_id']);
$depts= $departmentscontroller->deptList($_SESSION['org_id']);
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
        <h2>Create/Edit Units</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Org Struct. Name</span1>
            <span1>Parent Dept.</span1>  
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
           <span1>Unit Code</span1>
           <span1>Unit Name</span1>   
           <span1>Unit Level</span1>   
           <p>
            <label for="unit_code" ></label>
            <input type="text" placeholder="Enter Unit Code" name="unit_code" value="<?php echo $row['unit_code'];?>" required>
        
            <label for="unit_name"></label>
            <input type="text" placeholder="Enter Unit Name" name="unit_name" value="<?php echo $row['unit_name'];?>" required>

            <label for="unit_level"></label>
            <input style="width: 100px;" type="number" placeholder="#" name="unit_level" value="<?php echo $row['unit_level'];?>" required>
            </p>
            <span1>Start Date</span1>
            <span1>End Date</span1>
            <span1>Status</span1>
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
        <?php if($_SESSION['can_update'] == 1){ ?> <button type="submit" name="update_units">Apply Changes</button> <?php } ?>
        <?php if($_SESSION['can_delete'] == 1){ ?>    <?php if($row['status'] != 'VERIFY'){ ?><a href="./Units/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_units"> Delete</button></a> <?php } ?> <?php } ?>
 
            </div>
    </form>
    <?php } ?>
    <div>
    <a href="./Units" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
    include_once __DIR__."/footer.php";
?>