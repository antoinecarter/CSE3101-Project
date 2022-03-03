<?php
include __DIR__ . "/header.php";
$shiftsModel = new ShiftsController();
if (isset($_POST['create_shift'])) {
    $cred = $shiftsModel->createshift();
}
$orgcontroller = new OrganizationsController();
$refcontroller = new ReferencesController();
$shifttype = $refcontroller->refList('TBLSHIFTTYPE', $_SESSION['org_id']);
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
        <h2>Create/Edit Shifts</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization </span1>                                                   
            <span1>Shift Type</span1>
            <span1>Shift Code </span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($orgs){ ?>
                    <option value="<?php echo $orgs['id']; ?>"><?php echo $orgs['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="shift_type" ></label>
            <select name="shift_type" required>
                <option value="">--Select Shift Type--</option>
                
                <?php while($shifttype){ ?>
                    <option value="<?php echo $shifttype['value_desc']; ?>"><?php echo $shifttype['value_desc'];?></option>
                <?php } ?>
            </select>

            <label for="shift_code" ></label>
            <input type="text" placeholder="Enter Shift Code" name="shift_code" required>
           </p>
            <span>Start Time</span>
            <span>End Time</span>
            <span>Shift Hrs</span>
            <p>
            <label for="start_time"></label>
            <input type="time" name="start_time" required>
        
            <label for="end_time"></label>
            <input type="time" name="end_time" required>

            <label for="shift_hours"></label>
            <input type="text" name="shift_hours" readonly>
            </p>

            <span>Lunch Start</span>
            <span>Lunch End</span>
            <span>Lunch Hrs</span>
            <p>
            <label for="lunch_start"></label>
            <input type="time" name="lunch_start" required>
        
            <label for="lunch_end"></label>
            <input type="time" name="lunch_end" required>

            <label for="lunch_hours"></label>
            <input type="text" name="lunch_hours" readonly>
            </p>

            <span>Start Date</span>
            <span>End Date</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date">
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
      <?php if($_SESSION['role']=='ADMIN' && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_shift">Create</button> <?php } ?>

      </p>
        
    </form>
    <div>
    <a href="./Shifts" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>