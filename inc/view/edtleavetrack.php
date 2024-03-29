<?php
include __DIR__ . "/header.php";
$leavetrackcontroller = new LeavetrackController();
if (isset($_POST['update_leavetrack'])) {
    $cred = $leavetrackcontroller->updateleavetrack();
}else if(isset($_POST['delete_leavetrack'])){
    $cred = $leavetrackcontroller->deleteleavetrack();
}

$statement= $leavetrackcontroller->viewleavetrack();

$row = $statement->fetch(PDO::FETCH_ASSOC);

$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();

$empcontroller = new EmployeesController();
$emps = $empcontroller->empList($_SESSION['org_id'], $_SESSION['role'], $_SESSION['emp_no']);

$shiftscontroller = new ShiftsController();
$shifts = $shiftscontroller->shiftsList($_SESSION['org_id']);

$refcontroller = new ReferencesController();
$refs = $refcontroller->refList('LEAVETYPES', $_SESSION['org_id']);
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
        <h2>Create/Edit Leave Track</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id'];?>"> 
            </p>
            <span1>Organization</span1>                                                   
            <span1>Employee Id</span1>
            <span1>Leave Type</span1>  
           <p>
           <label for="org_id"></label>
           <select name="org_id" readonly="readonly" aria-disabled="true" required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"<?php if($row['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>
           <label for="emp_id"></label>
           <select name="emp_id"  readonly="readonly" required>
                    <option value="">--Select Employee--</option>
    
                    <?php while($emp = $emps->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $emp['id']; ?>" <?php if($row['emp_id'] == $emp['id']){?>selected<?php }?>><?php echo $emp['employee'];?></option>
                <?php } ?>
                </select>             
                <select name="leave_type" required>
                <option value="">--Select Leave Type--</option>
                
                <?php while($leave = $refs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $leave['value_desc']; ?>"<?php if($row['leave_type'] == $leave['value_desc']){?> selected<?php }?>><?php echo $leave['value_desc'];?></option>
                <?php } ?>
            </select>

           </p>
  
           <p>
            <label for="comp_year_id" ></label>
            <input type="hidden" placeholder="Enter Company Iear Id" name="comp_year_id">
        
            <label for="leave_ent_id"></label>
            <input type="hidden" placeholder="Leave Entitlement Id" name="leave_ent_id" value="<?php echo $row['leave_ent_id'];?>">

            <label for="leave_req_id"></label>
            <input type="hidden" placeholder="Enter Leave Request Id" name="leave_req_id" value="<?php echo $row['leave_req_id'];?>">

            </p>

            <span  style=" padding-left: 27px;">Entitled Days</span>
            <span >Leave Earned</span>
            <span >Leave Used</span>
         <p>

         <label for="entitled_days"></label>
            <input type="text" placeholder="Enter Entitled Days" name="entitled_days"   value="<?php echo $row['entitled_days'];?>">

         <label for="leave_earned"></label>
            <input type="text" placeholder="Enter Leave Earned" name="leave_earned" value="<?php echo $row['leave_earned'];?>">

         <label for="leave_used"></label>
            <input type="text" placeholder="Enter Leave Used" name="leave_used"  value="<?php echo $row['leave_used'];?>">

            </p>
            </p>
        </div>
        <div style="height:30px;"></div>
        <div>
        <?php if($_SESSION['can_update'] == 1){ ?> <button type="submit" name="update_leavetrack">Apply Changes</button> <?php } ?>
        <?php if($_SESSION['can_delete'] == 1){ ?>   <a href="./Leavetrack/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_leavetrack"> Delete</button></a> <?php } ?>
 
 
            </div>
    </form>
    <?php } ?>
    <div>
    <a href="./Leavetrack" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>