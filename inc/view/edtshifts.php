<?php
    include __DIR__."/header.php";
    $shiftsModel = new ShiftsController();
    if(isset($_POST['update_shift'])){
        $cred = $shiftsModel->updateshift();
    }else if (isset($_POST['delete_shift'])){
        $cred = $shiftsModel->deleteshift();
    }
    $statement = $shiftsModel->viewshift();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $orgcontroller = new OrganizationsController();
    $refcontroller = new ReferencesController();
    $shifttype = $refcontroller->refList('SHIFTTYPE', $_SESSION['org_id']);
    $orgs = $orgcontroller->orgList();
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
        <h2>Create/Edit Shifts</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </p>
            <span1>Organization </span1>                                                   
            <span1>Shift Type</span1>
            <span1>Shift Code </span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>" <?php if($row['org_id'] == $org['id']){ ?> selected <?php } ?>><?php echo $org['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="shift_type" ></label>
            <select name="shift_type" required>
                <option value="">--Select Payment Frequency--</option>
                
                <?php while($shift = $shifttype->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $shift['value_desc']; ?>"<?php if($row['shift_type'] == $shift['value_desc']){?>selected <?php } ?>><?php echo $shift['value_desc'];?></option>
                <?php } ?>
            </select>

            <label for="shift_code" ></label>
            <input type="text" placeholder="Enter Shift Code" name="shift_code" value="<?php echo $row['shift_code'];?>" required>
           </p>
            <span1>Start Time</span1>
            <span1>End Time</span1>
            <span1>Shift Hours</span1>
            <p>
            <label for="start_time"></label>
            <input type="time" name="start_time" value="<?php echo $row['start_time'];?>" required>
        
            <label for="end_time"></label>
            <input type="time" name="end_time" value="<?php echo $row['end_time'];?>" required>

            <label for="shift_hours"></label>
            <input type="text" name="shift_hours" value="<?php echo $row['shift_hours'];?>" readonly>
            </p>

            <span1>Lunch Start</span1>
            <span1>Lunch End</span1>
            <span1>Lunch Hours</span1>
            <p>
            <label for="lunch_start"></label>
            <input type="time" name="lunch_start" value="<?php echo $row['lunch_start'];?>">
        
            <label for="lunch_end"></label>
            <input type="time" name="lunch_end" value="<?php echo $row['lunch_end'];?>">

            <label for="lunch_hours"></label>
            <input type="text" name="lunch_hours" value="<?php echo $row['lunch_hours'];?>"readonly>
            </p>

            <span>Start Date</span>
            <span>End Date</span>
            <span>Status</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" value="<?php echo $row['start_date'];?>" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date" value="<?php echo $row['end_date'];?>">
            
            <label for="status"></label>
            <select name="status" id="" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
                            <option value="KEYED" <?php if($row['status'] == 'KEYED'){?>selected <?php } ?>>Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY" <?php if($row['status'] == 'VERIFY'){?>selected <?php } ?>>Verify</option>
                <option value="UNVERIFY" <?php if($row['status'] == 'UNVERIFY'){?>selected <?php } ?>>Unverify</option> <?php } ?>
            </select>
            </p>

        </div>
        <div style="height:100px;"></div>
        <div>
        <?php if($_SESSION['can_update'] == 1){ ?> <button type="submit" name="update_shift">Apply Changes</button> <?php } ?>
        <?php if($_SESSION['can_delete'] == 1){ ?>   <?php if($row['status'] != 'VERIFY'){ ?><a href="./Shifts/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_shift"> Delete</button></a> <?php } ?> <?php } ?>
 
 
            </div>
        
    </form>
    <?php } ?>
    <div>
    <a href="./Shifts" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
    include_once __DIR__."/footer.php";
?>