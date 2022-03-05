<?php
    include __DIR__."/header.php";
    $timeclocksModel = new TimeclocksController();
    if(isset($_POST['update_time'])){
        $cred = $timeclocksModel->updatetime();
    }else if (isset($_POST['delete_time'])){
        $cred = $timeclocksModel->deletetime();
    }
    $statement = $timeclocksModel->viewtime();
    
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
        <h2>Create/Edit Timeclocks</h2>
          
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
            <input type="date" name="work_date" value="<?php echo $row['work_date'];?>" readonly>
            </p>

            <span >Day</span>
            <span >Shift Id</span>
            <span >Shift Hours</span>
         <p>
         <label for="day"></label>
            <input type="text" name="day" value="<?php echo $row['day'];?>" readonly>

         <label for="shift_id"></label>
         <select name="shift_id"  readonly="readonly" required>
                <option value="">--Select Shift--</option>
                
                <?php while($shift = $shifts->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $shift['id']; ?>"<?php if($row['shift_id']==$shift['id']){?> selected <?php }?>><?php echo $shift['shift'];?></option>
                <?php } ?>
            </select> 
            <label for="shift_hours"></label>
            <input type="text" name="shift_hours" value="<?php echo $row['shift_hours'];?>" readonly>

            </p>
            <span >Time In</span>
            <span >Time Out</span>
         <p>
            <label for="time_in"></label>
            <input type="time" name="time_in">

            <label for="time_out"></label>
            <input type="time" name="time_out">

            </p>
            <span1 >Max Time In</span1>
            <span1 >Max Time Out</span1>
            <span1 >Hours Worked</span1>
         <p>
            <label for="min_time_in"></label>
            <input type="text" name="min_time_in" value="<?php echo $row['min_time_in'];?>"readonly>

            <label for="max_time_out"></label>
            <input type="text" name="max_time_out" value="<?php echo $row['max_time_out'];?>"readonly>

            <label for="hours_worked"></label>
            <input type="text" name="hours_worked" value="<?php echo $row['hours_worked'];?>"readonly>

            </p>
            <span >Status</span>
            <p>
            <label for="status"></label>
            <select name="status" id="" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
                            <option value="KEYED" <?php if($row['status'] == 'KEYED'){?>selected <?php } ?>>Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY" <?php if($row['status'] == 'VERIFY'){?>selected <?php } ?>>Verify</option>
                <option value="UNVERIFY" <?php if($row['status'] == 'UNVERIFY'){?>selected <?php } ?>>Unverify</option> <?php } ?>
            </select>
            </p>
        </div>
        <div style="height:20px;"></div>
        <div>
                <button type="submit" name="update_time">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Timeclocks/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_time"> Delete</button></a> <?php } ?>
 
 
            </div>
    </form>
    <?php } ?>
    <div>
    <a href="./Timeclocks" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
    include_once __DIR__."/footer.php";
?>