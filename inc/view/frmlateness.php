<?php
include __DIR__ . "/header.php";
$latenesscontroller = new LatenessController();
if (isset($_POST['create_lateness'])) {
    $cred = $latenesscontroller->createlateness();
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
        <h2>Create/Edit Lateness</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Employee</span1>
            <span1>Work Date</span1>  
           <p>
           <label for="org_id"></label>
            <input type="text" placeholder="Enter Organization Id" name="org_id" required>

           <label for="emp_id"></label>
            <input type="text" placeholder="Enter Employee Id" name="emp_id" required>
            
            <label for="work_date"></label>
            <input type="date" name="work_date">
            </p>

            <span >Shift</span>
            <span >Shift Hours</span>
            <span >Timeclock</span>
         <p>
         <label for="shift_id"></label>
            <input type="text" placeholder="Enter Shift Id" name="shift_id" required>

            <label for="shift_hours"></label>
            <input type="time" name="shift_hours" required>

            <label for="timeclock_id"></label>
            <input type="text" placeholder="Enter Timeclock Id" name="timeclock_id" required>
            
            </p>
            <span >Min Time In</span>
            <span >Hours Deducted</span>
         <p>
            <label for="min_time_in"></label>
            <input type="time" name="min_time_in" required>

            <label for="hours_deducted"></label>
            <input type="time" name="hours_deducted" required>

            </p>
            </p>
        </div>
        <div style="height:20px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_lateness">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Lateness" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>