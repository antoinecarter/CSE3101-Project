<?php
include __DIR__ . "/header.php";
$leaverequestsModel = new LeaverequestsController();
if (isset($_POST['create_leavreq'])) {
    $cred = $leaverequestsModel->createleavreq();
}

$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();

$empcontroller = new EmployeesController();
$emps = $empcontroller->empList($_SESSION['org_id'], $_SESSION['role'], $_SESSION['emp_no']);

$shiftscontroller = new ShiftsController();
$shifts = $shiftscontroller->shiftsList($_SESSION['org_id']);

$refcontroller = new ReferencesController();
$refs = $refcontroller->refList('LEAVETYPES', $_SESSION['org_id']);

$usercontroller = new UsersController();
$users = $usercontroller->approveList($_SESSION['org_id']);
?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit Leave Requests</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Employee</span1>
            <span1>Leave Type</span1>  
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
                <select name="leave_type" required>
                <option value="">--Select Leave Type--</option>
                
                <?php while($leave = $refs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $leave['value_desc']; ?>"><?php echo $leave['value_desc'];?></option>
                <?php } ?>
            </select>

           </p>
           <span1>From Date</span1>
           <span1>To Date</span1>   
           <span1>Resumption Date</span1>   
           <p>
    
           <label for="from_date"></label>
            <input type="date" name="from_date" required>
    
           <label for="to_date"></label>
            <input type="date" name="to_date" required>
    
           <label for="resumption_date"></label>
            <input type="date" name="resumption_date" required>

            </p>

            <span1>Approved By</span1>
            <span1 >Approved Date</span1>
            <span1 >Status</span1>
         <p>

         <label for="approved_by"></label>
         <select name="approved_by" <?php if(($_SESSION['role'] != 'ADMIN') || $_SESSION['can_approve'] != 1){?> readonly="readonly" <?php }?>>
                <option value="">--Select User--</option>
                
                <?php while($user = $users->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $user['id'];?>"><?php echo $user['user'];?></option>
                <?php } ?>

            <label for="approved_date"></label>
            <input type="date" name="approved_date">

            <label for="status"></label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option>
                <?php if($_SESSION['can_approve'] == 1){ ?> <option value="APPROVE">Apprvove</option>
                    <option value="UNAPPROVE">Unapprvove</option> <?php }?>
            </select>
            </p>
            </p>
        </div>
        <div style="height:30px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_leavreq">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Leaverequests" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>