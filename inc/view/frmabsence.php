<?php
include __DIR__ . "/header.php";
$absencecontroller = new AbsenceController();
if (isset($_POST['create_absence'])) {
    $cred = $absencecontroller->createabsence();
}
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
    <form method="post" action="">
        <div>
        <h2>Create/Edit Absence</h2>
          
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

            <span >Shift</span>
            <span>Shift Hours</span>
            <span >Status</span>
         <p>

         
         <label for="shift_id"></label>
         <select name="shift_id"  readonly="readonly">
                <option value="">--Select Shift--</option>
                
                <?php while($shift = $shifts->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $shift['id']; ?>"><?php echo $shift['shift'];?></option>
                <?php } ?>
            </select> 
            <label for="shift_hours"></label>
            <input type="text" name="shift_hours" readonly>
            
        
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