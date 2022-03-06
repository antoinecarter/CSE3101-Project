<?php
include __DIR__ . "/header.php";
$employeesModel = new EmployeesController();
if (isset($_POST['create_emp'])) {
    $cred = $employeesModel->createemp();
}

$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();
$refcontroller = new ReferencesController();
$natids = $refcontroller->refList('IDENTIFIERS', $_SESSION['org_id']);
$indcontroller = new IndividualsController();
$empcontroller = new  EmployeesController();

$individuals = $indcontroller->individualsList($_SESSION['org_id']);
$employees = $empcontroller->empList($_SESSION['org_id'], $_SESSION['role'], $_SESSION['emp_no']);

$positionscontroller = new PositionsController();
$positions = $positionscontroller->positionsList($_SESSION['org_id']);
$payfreq = $refcontroller->refList('PAYMENTFREQUENCY', $_SESSION['org_id']);
$emptypes = $refcontroller->refList('EMPTYPE', $_SESSION['org_id']);
$empstatus = $refcontroller->refList('EMPSTATUS', $_SESSION['org_id']);
$rops = $refcontroller->refList('RATEOFPAY', $_SESSION['org_id']);
$sepstatus = $refcontroller->refList('SEPSTATUS', $_SESSION['org_id']);
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
        <h2>Create/Edit Employee</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Employee No.</span1>
            <span1>Individual</span1>  
           <p>
           <label for="org_id"></label>
           <select name="org_id" required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"<?php if($_SESSION['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>
           <label for="emp_no"></label>
            <input style="height:35px; width: 100px;" type="number" placeholder="Emp #" name="emp_no" required>

           <label for="ind_id"></label>
           <select name="ind_id" required>
                    <option value="">--Select Individual--</option>
    
                    <?php while($individual = $individuals->fetch(PDO::FETCH_ASSOC)){ ?>
                        <option value="<?php echo $individual['id']; ?>"><?php echo $individual['individual'];?></option>
                    <?php } ?>
                </select>
           </p>
           <span1>Position</span1>
           <span1>Payment Freq.</span1>   
           <span1>Employment Type</span1>   
           <p>
            <label for="position_id" ></label>
            <select name="position_id" required>
                    <option value="">--Select Position--</option>
    
                    <?php while($position = $positions->fetch(PDO::FETCH_ASSOC)){ ?>
                        <option value="<?php echo $position['id']; ?>"><?php echo $position['position'];?></option>
                    <?php } ?>
                </select>
        
            <label for="payment_frequency"></label>
            <select name="payment_frequency" required>
                <option value="">--Select Payment Frequency--</option>
                
                <?php while($pf = $payfreq->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $pf['value_desc']; ?>"><?php echo $pf['value_desc'];?></option>
                <?php } ?>
            </select>

            <label for="emp_type"></label>
            <select name="emp_type" required>
                <option value="">--Select Status--</option>
                
                <?php while($emptype = $emptypes->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $emptype['value_desc']; ?>"><?php echo $emptype['value_desc'];?></option>
                <?php } ?>
            </select>
            </p>
            <span1>Emp Status</span1>
            <span1>Emp Date</span1>
            <span1>Ann Leave Date</span1>
         <p>
         <label for="emp_status"></label>
         <select name="emp_status" required>
                <option value="">--Select Emp Status--</option>
                
                <?php while($emps = $empstatus->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $emps['value_desc']; ?>"><?php echo $emps['value_desc'];?></option>
                <?php } ?>
            </select>

            <label for="emp_date"></label>
            <input type="date" name="emp_date" required>
        
            <label for="ann_leave_date"></label>
            <input type="date" name="ann_leave_date" readonly>
            </p>
            <span1>Rate of Pay</span1>
            <span1>Seperation Status</span1>
            <span1>Seperation Date</span1>
                <p>
            <label for="rate_of_pay"></label>
            <select name="rate_of_pay" required>
                <option value="">--Select Rate of Pay--</option>
                
                <?php while($rop = $rops->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $rop['value_desc']; ?>"><?php echo $rop['value_desc'];?></option>
                <?php } ?>
            </select>            
            <select name="separation_status">
                <option value="">--Select Separation Status--</option>
                
                <?php while($sep = $sepstatus->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $sep['value_desc']; ?>"><?php echo $sep['value_desc'];?></option>
                <?php } ?>
            </select> 

            <label for="separation_date"></label>
            <input type="date" name="separation_date">

            </p>
            <span>Shift</span>
            <span>Status</span>
                <p>
                <label for="shift_id"></label>
                <select name="shift_id" required>
                <option value="">--Select Shift--</option>
                
                <?php while($shift = $shifts->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $shift['id']; ?>"><?php echo $shift['shift'];?></option>
                <?php } ?>
            </select> 
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