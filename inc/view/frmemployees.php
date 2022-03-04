<?php
include __DIR__ . "/header.php";
$employeesModel = new EmployeesController();
if (isset($_POST['create_emp'])) {
    $cred = $employeesModel->createemp();
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
        <h2>Create/Edit Employee</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization Id</span1>                                                   
            <span1>Employee No.</span1>
            <span1>Individual Id</span1>  
           <p>
           <label for="org_id"></label>
            <input type="text" placeholder="Enter Organization Id" name="org_id" required>

           <label for="emp_no"></label>
            <input type="text" placeholder="Enter Employee Number" name="emp_no" required>

           <label for="ind_id"></label>
            <input type="text" placeholder="Enter Individual Id" name="ind_id" required>

           </p>
           <span style=" padding-left: 90px;">Position Id</span>
           <span>Payment Freq.</span>   
           <span>Employee Type</span>   
           <p>
            <label for="position_id" ></label>
            <input type="text" placeholder="Enter Position Id" name="position_id" required>
        
            <label for="payment_frequency"></label>
            <input type="text" placeholder="Enter Payment Frequency" name="payment_frequency" required>

            <select name="emp_type" id="" required>
                <option value="KEYED">Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option> <?php } ?>
            </select>
            </p>
            <span style="padding-left: 20px;">Employee Status</span>
            <span style="margin-right: 40px;">Employee Date</span>
            <span>Annual Leave Date</span>
         <p>

         <select name="emp_status" id="" required>
                <option value="KEYED">Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option> <?php } ?>
            </select>

            <label for="emp_date"></label>
            <input type="date" name="emp_date" required>
        
            <label for="ann_leave_date"></label>
            <input type="date" name="ann_leave_date">
            </p>
            <span style="margin-right: 40px;">Rate of Pay</span>
            <span style="margin-right: 40px;">Seperation Status</span>
            <span>Seperation Date</span>
                <p>
            <label for="rate_of_pay"></label>
            <input type="text" placeholder="Enter Rate of Pay " name="rate_of_pay" required>
            
            <select name="separation_status" id="" required>
                <option value="KEYED">Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option> <?php } ?>
            </select>

            <label for="separation_date"></label>
            <input type="date" name="separation_date" required>

            </p>
            <span>Shift Id</span>
            <span>Status</span>
                <p>
                <label for="shift_id"></label>
            <input type="text" placeholder="Enter Shift Id" name="shift_id" required>

            <label for="status"></label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option> <?php } ?>
            </select>
            </p>
        </div>
        <div style="height:30px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_emp">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Employees" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>