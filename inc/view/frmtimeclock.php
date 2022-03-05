<?php
include __DIR__ . "/header.php";
$timeclockcontroller = new TimeclocksController();
if (isset($_POST['create_time'])) {
    $cred = $timeclockcontroller->createtime();
}
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
    <form method="post" action="">
        <div>
        <h2>Create/Edit Time-in | Time-out</h2>
          
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
                    <option value="<?php echo $emp['id']; ?>" <?php if($_SESSION['emp_no'] == $emp['id']){?>selected<?php }?>><?php echo $emp['employee'];?></option>
                <?php } ?>
                </select>            
            <label for="work_date"></label>
            <input type="date" name="work_date">
            </p>

            <span >Time In</span>
            <span >Time Out</span>
            <p>
            <label for="time_in"></label>
            <input type="time" name="time_in" required>

            <label for="time_out"></label>
            <input type="time" name="time_out" required>

            </p>
            <span >Status</span>
            <p>
            <label for="status"></label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option> <?php } ?>
            </select>
            </p>
        </div>
        <div style="height:20px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_time">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Timeclocks" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>