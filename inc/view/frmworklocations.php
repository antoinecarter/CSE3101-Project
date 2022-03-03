<?php
include __DIR__ . "/header.php";
$worklocationsModel = new WorklocationsController();
if (isset($_POST['create_workl'])) {
    $cred = $worklocationsModel->createworkl();
}

$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();
?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit Work Locations</h2>
          
        </div>
        <div>
            <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Location Code</span1>
            <span1>Location Description</span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($orgs){ ?>
                    <option value="<?php echo $orgs['id']; ?>"><?php echo $orgs['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="location_code" ></label>
            <input type="text" placeholder="Enter Location Code" name="location_code" required>

            <label for="location_desc" ></label>
            <input type="text" placeholder="Enter Location Description" name="location_desc" required>
            
           </p>
           <span>Address</span>
           <span>Telephone</span>   
           <p>
            <label for="address" ></label>
            <textarea name="address" id="" cols="30" rows="10" placeholder="Enter Address"></textarea>

            <label for="telephone"></label>
            <input type="text" placeholder="Enter Telephone #" name="telephone" required>

            </p>
            <span>Start Date</span>
            <span>End Date</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date" required>
            </p>
            <span>Status</span>
           <p>
            <label for="status"></label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option> <?php } ?>
            </select>
            </p>
        </div>
        <div style="height:100px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN' && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_workl">Create</button> <?php } ?>

      </p>
        
    </form>
    <div>
    <a href="./Worklocations" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>