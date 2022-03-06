
<?php
    include __DIR__."/header.php";
    $absencecontroller = new AbsenceController();
    if(isset($_POST['update_absence'])){
        $cred = $absencecontroller->updateabsence();
    }else if (isset($_POST['delete_absence'])){
        $cred = $absencecontroller->deleteabsence();
    }
    $statement = $absencecontroller->viewabsence();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();

$empcontroller = new EmployeesController();
$emps = $empcontroller->empList($_SESSION['org_id'], $_SESSION['role'], $_SESSION['emp_no']);

$shiftscontroller = new ShiftsController();
$shifts = $shiftscontroller->shiftsList($_SESSION['org_id']);
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
        <h2>Create/Edit Absence</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Employee</span1>
            <span1>Work Date</span1>  
           <p>
           <label for="org_id"></label>
           <select name="org_id" required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"<?php if($row['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>
           <label for="emp_id"></label>
           <select name="emp_id" required>
                    <option value="">--Select Employee--</option>
    
                    <?php while($emp = $emps->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $emp['id']; ?>" <?php if($row['emp_id'] == $emp['id']){?>selected<?php }?>><?php echo $emp['employee'];?></option>
                <?php } ?>
                </select>               
            <label for="work_date"></label>
            <input type="date" name="work_date" value="<?php echo $row['work_date'];?>">
            </p>

            <span >Shift</span>
            <span>Shift Hours</span>
            <span >Status</span>
         <p>

         
         <label for="shift_id"></label>
         <select name="shift_id"  readonly="readonly">
                <option value="">--Select Shift--</option>
                
                <?php while($shift = $shifts->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $shift['id']; ?>" <?php if($row['shift_id'] == $shift['id']){?>selected<?php }?>><?php echo $shift['shift'];?></option>
                <?php } ?>
            </select> 
            <label for="shift_hours"></label>
            <input type="text" name="shift_hours" value="<?php echo $row['shift_hours'];?>" readonly>
            
        
            <label for="status"></label>
            <select name="status" id="" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
                            <option value="KEYED" <?php if($row['status'] == 'KEYED'){?>selected <?php } ?>>Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY" <?php if($row['status'] == 'VERIFY'){?>selected <?php } ?>>Verify</option>
                <option value="UNVERIFY" <?php if($row['status'] == 'UNVERIFY'){?>selected <?php } ?>>Unverify</option> <?php } ?>
            </select>
            </p>
            </p>
        </div>
        <div style="height:20px;"></div>
        <div>
                <?php if($_SESSION['can_update'] == 1){ ?> <button type="submit" name="update_absence">Apply Changes</button> <?php } ?>
                <?php if($_SESSION['can_delete'] == 1){ ?> <?php if($row['status'] != 'VERIFY'){ ?><a href="./Timeclocks/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_absence"> Delete</button></a> <?php } ?> <?php } ?>
 
 
            </div>
    </form>

    <?php } ?>
    <div>
    <a href="./Absence" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>