<?php
include __DIR__ . "/header.php";
$salarycontroller = new SalaryController();
if (isset($_POST['create_sal'])) {
    $cred = $salarycontroller->createsal();
}

$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();

$empcontroller = new EmployeesController();
$emps = $empcontroller->empList($_SESSION['org_id'], $_SESSION['role'], $_SESSION['emp_no']);

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
            <span1>Organization</span1>                                                   
            <span1>Employee</span1>
            <span1>Salary</span1>  
           <p>
           <label for="org_id"></label>
           <select name="org_id" required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"<?php if($_SESSION['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>
           <label for="emp_id"></label>
           <select name="emp_id" required>
                    <option value="">--Select Employee--</option>
    
                    <?php while($emp = $emps->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $emp['id']; ?>"><?php echo $emp['employee'];?></option>
                <?php } ?>
                </select>

           <label for="salary"></label>
            <input type="text" placeholder="Enter Salary" name="salary" required>

           </p>

            <span1>Monthly Basic</span1>   
            <span1 >Daily Rate</span1>
            <span1 >Hourly Rate</span1>
         <p>
         
         <label for="monthly_basic"></label>
            <input type="text"  name="monthly_basic" readonly>

         <label for="daily_rate"></label>
            <input type="text"  name="daily_rate" readonly>

            <label for="hourly_rate"></label>
            <input type="text"  name="hourly_rate" readonly>

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