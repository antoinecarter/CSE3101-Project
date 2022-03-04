<?php
include __DIR__ . "/header.php";
$employeecontroller = new EmployeesController();
if (isset($_POST['update_emp'])) {
    $cred = $employeecontroller->updateemp();
}else if(isset($_POST['delete_emp'])){
    $cred = $employeecontroller->delemployees();
}
$statement = $employeecontroller->viewemp();
$row = $statement->fetch(PDO::FETCH_ASSOC);
$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();
$refcontroller = new ReferencesController();
$natids = $refcontroller->refList('IDENTIFIERS', $_SESSION['org_id']);
$indcontroller = new IndividualsController();
$empcontroller = new  EmployeesController();
$usercontroller = new UsersController();
$individuals = $indcontroller->individualsList($_SESSION['org_id']);
$employees = $empcontroller->empList($_SESSION['org_id']);
$users = $usercontroller->userList();
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
        <?php if(isset($row['id'])){?>
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
                    <option value="<?php echo $org['id']; ?>"<?php if($row['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>
           <label for="emp_no"></label>
            <input style="height:35px; width: 100px;" type="number" placeholder="Emp #" name="emp_no" value="<?php echo $row['emp_no']?>" required>

           <label for="ind_id"></label>
           <select name="ind_id" required>
                    <option value="">--Select Individual--</option>
    
                    <?php while($individual = $individuals->fetch(PDO::FETCH_ASSOC)){ ?>
                        <option value="<?php echo $individual['id']; ?>"<?php if($row['ind_id'] == $individual['id']){ ?> selected <?php } ?>><?php echo $individual['individual'];?></option>
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
                        <option value="<?php echo $position['id']; ?>" <?php if($row['position_id'] == $position['id']){ ?> selected <?php } ?>><?php echo $position['position'];?></option>
                    <?php } ?>
                </select>
        
            <label for="payment_frequency"></label>
            <select name="payment_frequency" required>
                <option value="">--Select Payment Frequency--</option>
                
                <?php while($pf = $payfreq->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $pf['value_desc']; ?>"<?php if($row['payment_frequency'] == $pf['value_desc']){ ?> selected <?php } ?>><?php echo $pf['value_desc'];?></option>
                <?php } ?>
            </select>

            <label for="emp_type"></label>
            <select name="emp_type" required>
                <option value="">--Select Status--</option>
                
                <?php while($emptype = $emptypes->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $emptype['value_desc']; ?>" <?php if($row['emp_type'] == $emptype['value_desc']){ ?> selected <?php } ?>><?php echo $emptype['value_desc'];?></option>
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
                    <option value="<?php echo $emps['value_desc']; ?>"<?php if($row['emp_status'] == $emps['value_desc']){ ?> selected <?php } ?>><?php echo $emps['value_desc'];?></option>
                <?php } ?>
            </select>

            <label for="emp_date"></label>
            <input type="date" name="emp_date" value="<?php echo $row['emp_date'];?>" required>
        
            <label for="ann_leave_date"></label>
            <input type="date" name="ann_leave_date" value="<?php echo $row['ann_leave_date'];?>" readonly>
            </p>
            <span1>Rate of Pay</span1>
            <span1>Seperation Status</span1>
            <span1>Seperation Date</span1>
                <p>
            <label for="rate_of_pay"></label>
            <select name="rate_of_pay" required>
                <option value="">--Select Rate of Pay--</option>
                
                <?php while($rop = $rops->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $rop['value_desc']; ?>" <?php if($row['rate_of_pay'] == $rop['value_desc']){ ?> selected <?php } ?>><?php echo $rop['value_desc'];?></option>
                <?php } ?>
            </select>            
            <select name="separation_status">
                <option value="">--Select Separation Status--</option>
                
                <?php while($sep = $sepstatus->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $sep['value_desc']; ?>" <?php if($row['separation_status'] == $sep['value_desc']){ ?> selected <?php } ?>><?php echo $sep['value_desc'];?></option>
                <?php } ?>
            </select> 

            <label for="separation_date"></label>
            <input type="date" name="separation_date" value="<?php echo $row['separation_date'];?>">

            </p>
            <span>Shift</span>
            <span>Status</span>
                <p>
                <label for="shift_id"></label>
                <select name="shift_id" required>
                <option value="">--Select Shift--</option>
                
                <?php while($shift = $shifts->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $shift['id']; ?>"<?php if($row['shift_id'] == $shift['id']){ ?> selected <?php } ?>><?php echo $shift['shift'];?></option>
                <?php } ?>
            </select> 
            <label for="status"></label>
            <select name="status" id="" required>
            <option value="KEYED" <?php if($row['status'] == 'KEYED'){?>selected <?php } ?>>Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY" <?php if($row['status'] == 'VERIFY'){?>selected <?php } ?>>Verify</option>
                <option value="UNVERIFY" <?php if($row['status'] == 'UNVERIFY'){?>selected <?php } ?>>Unverify</option> <?php } ?>
            </select>
            </p>
        </div>
        <div style="height:30px;"></div>
        <div>
                <button type="submit" name="update_emp">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Employees/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_emp"> Delete</button></a> <?php } ?>
 
            </div>
    </form>
    <?php } ?>
    <div>
    <a href="./Employees" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>