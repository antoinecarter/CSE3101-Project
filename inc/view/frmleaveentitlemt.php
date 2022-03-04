<?php
include __DIR__ . "/header.php";
$leaveentitlemtModel = new LeaveentitlemtController();
if (isset($_POST['create_leav'])) {
    $cred = $leaveentitlemtModel->createleav();
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
        <h2>Create/Edit Leave Entitlemt</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization Id</span1>                                                   
            <span1>Employee Id</span1>
            <span1>Leave Type</span1>  
           <p>
           <label for="org_id"></label>
            <input type="text" placeholder="Enter Organization Id" name="org_id" required>

           <label for="emp_id"></label>
            <input type="text" placeholder="Enter Employee Id" name="emp_id" required>
            
            <select name="leave_type">
                <option value="">--Select Parent Unit--</option>

                <?php while($units){ ?>
                    <option value="<?php echo $units['id']; ?>"><?php echo $units['unit'];?></option>
                <?php } ?>
            </select>

           </p>
           <span style=" padding-left: 80px;">Quantity</span>
           <span>Max Accumulation</span>   
           <span>Monthly Rate</span>   
           <p>
            <label for="quantity" ></label>
            <input type="text" placeholder="Enter Quantity" name="quantity" required>
        
            <label for="max_accumulation"></label>
            <input type="text" placeholder="Enter Max Accumulation" name="max_accumulation" required>

            <label for="monthly_rate"></label>
            <input type="text" placeholder="Enter Monthly Rate" name="monthly_rate" required>

            </p>

            <span >Leave Earn</span>
            <span >Start Date</span>
            <span >End Date</span>
         <p>

         
         <label for="leave_earn"></label>
            <input type="text" placeholder="Enter Leave Earn" name="leave_earn" required>

            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date">
            </p>
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