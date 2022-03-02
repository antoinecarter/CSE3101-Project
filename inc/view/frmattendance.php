<?php
include __DIR__ . "/header.php";
$attendancecontroller = new AttendanceController();
if (isset($_POST['create_attendance'])) {
    $cred = $attendancecontroller->createattendance();
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
        <h2>Create new Attendance</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span>Organization Id</span>
            <span>Employee Id</span>
        <p>
            <label for="org_id"></label>
            <input type="text" placeholder=" Enter Organization" name="org_id">
           
            <label for="emp_id"></label>
            <input type="text" placeholder=" Enter Employee No." name="emp_id">
            </p>
            <span>Effective From</span>
            <span>Effective To</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date">
            </p>
            <span>Rule Option</span>
            <span>Rule Value</span>
            <p>
            <label for="rule_option"></label>
            <select name="rule_option" id="" required>
          
                <option value="1">Yes</option>
                <option value="0">No</option>
        
            </select>
      
            <label for="rule_value"></label>
            <select name="rule_value" id="" required>

                <option value="1">Yes</option>
                <option value="0">No</option>
       
            </select>

            </p>
            </p>    
   

      <?php if($_SESSION['role']=='ADMIN'){ ?><button type="submit" name="create_attendance">Create</button> <?php } ?>

      </p>
  
        </div>
        
    </form>
    <div>
    <a href="./Attendance" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>