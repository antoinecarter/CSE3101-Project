<?php
include __DIR__ . "/header.php";
$absencecontroller = new AbsenceController();
if (isset($_POST['create_absence'])) {
    $cred = $absencecontroller->createabsence();
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
        <h2>Create/Edit Absence</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization Id</span1>                                                   
            <span1>Employee Id</span1>
            <span1>Work Date</span1>  
           <p>
           <label for="org_id"></label>
            <input type="text" placeholder="Enter Organization Id" name="org_id" required>

           <label for="emp_id"></label>
            <input type="text" placeholder="Enter Employee Id" name="emp_id" required>
            
            <label for="work_date"></label>
            <input type="date" name="work_date">
            </p>

            <span >Shift Id</span>
            <span >Shift Hours</span>
            <span >Status</span>
         <p>

         
         <label for="shift_id"></label>
            <input type="text" placeholder="Enter Shift Id" name="shift_id" required>

            <label for="shift_hours"></label>
            <input type="time" name="shift_hours" required>
        
            <label for="status"></label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option>
            </select>
            </p>
            </p>
        </div>
        <div style="height:20px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_absence">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Absence" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>