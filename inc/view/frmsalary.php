<?php
include __DIR__ . "/header.php";
$salaryModel = new SalaryController();
if (isset($_POST['create_sal'])) {
    $cred = $salaryModel->createsal();
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
        <h2>Create/Edit Salary</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization Id</span1>                                                   
            <span1>Employee Id</span1>
            <span1>Salary</span1>  
           <p>
           <label for="org_id"></label>
            <input type="text" placeholder="Enter Organization Id" name="org_id" required>

           <label for="emp_id"></label>
            <input type="text" placeholder="Enter Employee Id" name="emp_id" required>

           <label for="ind_id"></label>
            <input type="text" placeholder="Enter Salary" name="salary" required>

           </p>
           <span style=" padding-left: 90px;">NIS Deduct</span>
           <span>Taxable</span>   
           <span>Monthly Basic</span>   
           <p>
            <label for="nis_deduct" ></label>
            <input type="text" placeholder="Enter NIS Deduct" name="nis_deduct" required>
        
            <label for="taxable"></label>
            <input type="text" placeholder="Enter Taxable" name="taxable" required>

            <label for="monthly_basic"></label>
            <input type="text" placeholder="Enter Monthly Basic" name="monthly_basic" required>

            </p>
            <span >Daily Rate</span>
            <span >Employee Date</span>
         <p>
         
         <label for="daily_rate"></label>
            <input type="text" placeholder="Enter Daily Rate" name="daily_rate" required>

            <label for="hourly_rate"></label>
            <input type="text" placeholder="Enter Hourly Rate" name="hourly_rate" required>

         </p>
            <span >Start Date</span>
            <span >End Date</span>
         <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date">
            </p>
            </p>
        </div>
        <div style="height:30px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_sal">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Salary" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>