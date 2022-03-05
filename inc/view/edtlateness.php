<?php
include __DIR__ . "/header.php";
$latenesscontroller = new LatenessController();
if (isset($_POST['update_lateness'])) {
    $cred = $latenesscontroller->updatelateness();
}else if(isset($_POST['delete_lateness'])){
    $cred = $latenesscontroller->deletelateness();
}

$statement = $latenesscontroller->viewlateness();

$row = $statement->fetch(PDO::FETCH_ASSOC);

$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();

$empcontroller = new EmployeesController();
$emps = $empcontroller->empList($_SESSION['org_id']);

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
        <h2>Create/Edit Lateness</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value = "<?php echo $row['id']?>">
            </p>
            <span1>Organization Id</span1>                                                   
            <span1>Employee Id</span1>
            <span1>Work Date</span1>  
           <p>
           <label for="org_id"></label>
           <select name="org_id" readonly="readonly" aria-disabled="true" required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"<?php if($_SESSION['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>
           <label for="emp_id"></label>
           <select name="emp_id"  readonly="readonly" required>
                    <option value="">--Select Employee--</option>
    
                    <?php while($emp = $emps->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $emp['id']; ?>" <?php if($_SESSION['emp_no'] == $emp['id']){?>selected<?php }?>><?php echo $emp['employee'];?></option>
                <?php } ?>
                </select>               
            <label for="work_date"></label>
            <input type="date" name="work_date" value = "<?php echo $row['work_date']?>">
            </p>

            <span >Shift Id</span>
            <span >Shift Hours</span>
            <span >Timeclock Id</span>
         <p>
         <label for="shift_id"></label>
         <select name="shift_id"  readonly="readonly" required>
                <option value="">--Select Shift--</option>
                
                <?php while($shift = $shifts->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $shift['id']; ?>"<?php if($row['shift_id']==$shift['id']){?> selected <?php }?>><?php echo $shift['shift'];?></option>
                <?php } ?>
            </select> 
            <label for="shift_hours"></label>
            <input type="text" name="shift_hours" value = "<?php echo $row['shift_hours']?>" required>

            <label for="timeclock_id"></label>
            <input type="text" placeholder="Enter Timeclock Id" name="timeclock_id" value = "<?php echo $row['timeclock_id']?>" required>
            
            </p>
            <span >Min Time In</span>
            <span >Hours Deducted</span>
         <p>
            <label for="min_time_in"></label>
            <input type="time" name="min_time_in" value = "<?php echo $row['min_time_in']?>" required>

            <label for="hours_deducted"></label>
            <input type="text" name="hours_deducted" value = "<?php echo $row['hours_deducted']?>" required>

            </p>
            </p>
        </div>
        <div style="height:20px;"></div>
        <div>
                <button type="submit" name="update_lateness">Apply Changes</button>
            <a href="./Lateness/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_lateness"> Delete</button></a>
 
 
            </div> 
        </form>

        <?php } ?>
    <div>
    <a href="./Lateness" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>