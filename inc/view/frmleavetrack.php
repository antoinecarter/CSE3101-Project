<?php
include __DIR__ . "/header.php";
$leavetrackcontroller = new LeavetrackController();
if (isset($_POST['create_leavetrack'])) {
    $cred = $leavetrackcontroller->createleavetrack();
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
        <h2>Create/Edit Leave Track</h2>
          
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
           <span style=" padding-left: 27px;">Company Iear Id</span>
           <span>Leave Entit. Id</span>   
           <span>Leave Request Id</span>   
           <p>
            <label for="comp_year_id" ></label>
            <input type="text" placeholder="Enter Company Iear Id" name="comp_year_id" required>
        
            <label for="leave_ent_id"></label>
            <input type="text" placeholder="Leave Entitlement Id" name="leave_ent_id" required>

            <label for="leave_req_id"></label>
            <input type="text" placeholder="Enter Leave Request Id" name="leave_req_id" required>

            </p>

            <span  style=" padding-left: 27px;">Entitled Days</span>
            <span >Leave Earned</span>
            <span >Leave Used</span>
         <p>

         <label for="entitled_days"></label>
            <input type="text" placeholder="Enter Entitled Days" name="entitled_days" required>

         <label for="leave_earned"></label>
            <input type="text" placeholder="Enter Leave Earned" name="leave_earned" required>

         <label for="leave_used"></label>
            <input type="text" placeholder="Enter Leave Used" name="leave_used" required>

            </p>
            </p>
        </div>
        <div style="height:30px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_leavetrack">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Leavetrack" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>