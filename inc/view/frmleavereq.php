<?php
include __DIR__ . "/header.php";
$leaverequestsModel = new LeaverequestsController();
if (isset($_POST['create_leavreq'])) {
    $cred = $leaverequestsModel->createleavreq();
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
        <h2>Create/Edit Leave Requests</h2>
          
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
           <span style=" padding-left: 60px;">From Date</span>
           <span>To Date</span>   
           <span>Resumption Date</span>   
           <p>
    
           <label for="from_date"></label>
            <input type="date" name="from_date" required>
    
           <label for="to_date"></label>
            <input type="date" name="to_date" required>
    
           <label for="resumption_date"></label>
            <input type="date" name="resumption_date" required>

            </p>

            <span  style=" padding-left: 60px;">Approved By</span>
            <span >Approved Date</span>
            <span >Status</span>
         <p>

         <label for="approved_by"></label>
            <input type="text" placeholder="Enter Approved By" name="approved_by" required>

            <label for="approved_date"></label>
            <input type="date" name="approved_date" required>

            <label for="status"></label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option>
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