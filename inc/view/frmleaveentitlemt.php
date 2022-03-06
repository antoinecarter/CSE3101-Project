<?php
include __DIR__ . "/header.php";
$leaveentcontroller = new LeaveentitlemtController();
if (isset($_POST['create_leav'])) {
    $cred = $leaveentcontroller->createleav();
}

$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();

$empcontroller = new EmployeesController();
$emps = $empcontroller->empList($_SESSION['org_id'], $_SESSION['role'], $_SESSION['emp_no']);

$refcontroller = new ReferencesController();
$refs = $refcontroller->refList('LEAVETYPES', $_SESSION['org_id']);
?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit Leave Entitlemt</h2>
          
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
                    <option value="<?php echo $emp['id']; ?>"><?php echo $emp['employee'];?></option>
                <?php } ?>
                </select>
            
                <select name="leave_type" required>
                <option value="">--Select Leave Type--</option>
                
                <?php while($leave = $refs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $leave['value_desc']; ?>"><?php echo $leave['value_desc'];?></option>
                <?php } ?>
            </select>

           </p>
           <span1>Quantity</span1>
           <span1>Max Accumulation</span1>   
           <span1>Monthly Rate</span1>   
           <p>
            <label for="quantity" ></label>
            <input style="height:35px; width: 200px;" type="number" placeholder="Enter Quantity" name="quantity" required>
        
            <label for="max_accumulation"></label>
            <input style="height:35px; width: 200px;" type="number" placeholder="Enter Max Accumulation" name="max_accumulation" required>

            <label for="monthly_rate"></label>
            <input type="text" name="monthly_rate"  readonly>

            </p>

            <span >Leave Earn</span>
            <span >Start Date</span>
            <span >End Date</span>
         <p>

         
         <label for="leave_earn"></label>
            <input style="height:35px; width: 200px;" type="number"  name="leave_earn" readonly>

            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date">
            </p>
        </div>
        <div style="height:30px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_leav">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Leaveentitlemt" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>