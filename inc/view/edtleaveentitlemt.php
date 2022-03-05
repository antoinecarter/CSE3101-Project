<?php
    include __DIR__."/header.php";
    $leaveentitlemtModel = new LeaveentitlemtController();
    if(isset($_POST['update_leav'])){
        $cred = $leaveentitlemtModel->updateleav();
    }else if (isset($_POST['delete_leav'])){
        $cred = $leaveentitlemtModel->deleteleav();
    }
    $statement = $leaveentitlemtModel->viewleav();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    
$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();

$empcontroller = new EmployeesController();
$emps = $empcontroller->empList($_SESSION['org_id']);

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
        <h2>Create/Edit Leave Entitlemt</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Employee</span1>
            <span1>Leave Type</span1>  
           <p>
           <label for="org_id"></label>
           <select name="org_id" required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"<?php if($row['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>

           <label for="emp_id"></label>
                <select name="emp_id" required>
                    <option value="">--Select Employee--</option>
    
                    <?php while($emp = $emps->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $emp['id']; ?>"<?php if($row['emp_id'] == $emp['id']){?> selected <?php }?>><?php echo $emp['employee'];?></option>
                <?php } ?>
                </select>
            
                <select name="leave_type" required>
                <option value="">--Select Leave Type--</option>
                
                <?php while($leave = $refs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $leave['value_desc']; ?>"<?php if($row['leave_type'] == $leave['value_desc']){?> selected<?php }?>><?php echo $leave['value_desc'];?></option>
                <?php } ?>
            </select>

           </p>
           <span1>Quantity</span1>
           <span1>Max Accumulation</span1>   
           <span1>Monthly Rate</span1>   
           <p>
            <label for="quantity" ></label>
            <input style="height:35px; width: 200px;" type="number" placeholder="Enter Quantity" name="quantity" value="<?php echo $row['quantity'];?>" required>
        
            <label for="max_accumulation"></label>
            <input style="height:35px; width: 200px;" type="number" placeholder="Enter Max Accumulation" name="max_accumulation" value="<?php echo $row['max_accumulation'];?>" required>

            <label for="monthly_rate"></label>
            <input type="text" name="monthly_rate" value="<?php echo $row['monthly_rate'];?>" readonly>

            </p>

            <span >Leave Earn</span>
            <span >Start Date</span>
            <span >End Date</span>
         <p>

         
         <label for="leave_earn"></label>
            <input style="height:35px; width: 200px;" type="number"  name="leave_earn" value="<?php echo $row['leave_earn'] ?>" readonly>

            <label for="start_date"></label>
            <input type="date" name="start_date"  value="<?php echo $row['start_date'] ?>" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date"  value="<?php echo $row['end_date'] ?>" >
            </p>
        </div>
        <div style="height:30px;"></div>
        <div>
                <button type="submit" name="update_leav">Apply Changes</button>
            <a href="./Leaveentitlemt/Registration/Delete?id=<?php echo $row['id'];?>"> <button style = "background-color:#eb0b4e;"  name="delete_leav"> Delete</button></a> 
 
            </div> 
            <?php } ?>  
    </form>
    <div>
    <a href="./Leaveentitlemt" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
    include_once __DIR__."/footer.php";
?>