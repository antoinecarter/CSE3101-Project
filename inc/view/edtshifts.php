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
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </p>
            <span1>Organization </span1>                                                   
            <span1>Shift Type</span1>
            <span1>Shift Code </span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($orgs){ ?>
                    <option value="<?php echo $row['org_id']; ?>"<?php if($row['org_id'] == $orgs['id']){?> selected <?php } ?>><?php echo $orgs['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="shift_type" ></label>
            <select name="shift_type" required>
                <option value="">--Select Payment Frequency--</option>
                
                <?php while($shifttype){ ?>
                    <option value="<?php echo $row['value_desc']; ?>" <?php if($row['value_desc'] == $shifttype['value_desc']){ ?> selected <?php }?>><?php echo $shifttype['value_desc'];?></option>
                <?php } ?>
            </select>

            <label for="shift_code" ></label>
            <input type="text" placeholder="Enter Shift Code" name="shift_code" value="<?php echo $row['shift_codes'];?>" required>
           </p>
            <span>Start Time</span>
            <span>End Time</span>
            <span>Shift Hours</span>
            <p>
            <label for="start_time"></label>
            <input type="time" name="start_time" value="<?php echo $row['start_time'];?>" required>
        
            <label for="end_time"></label>
            <input type="time" name="end_time" value="<?php echo $row['end_time'];?>" required>

            <label for="shift_hours"></label>
            <input type="text" name="shift_hours" value="<?php echo $row['shift_hours'];?>" readonly>
            </p>

            <span>Lunch Start</span>
            <span>Lunch End</span>
            <span>Lunch Hours</span>
            <p>
            <label for="lunch_start"></label>
            <input type="time" name="lunch_start" value="<?php echo $row['lunch_start'];?>" required>
        
            <label for="lunch_end"></label>
            <input type="time" name="lunch_end" value="<?php echo $row['lunch_end'];?>"required>

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
                <option value="VERIFY" <?php if($row['status'] == 'VERIFY'){?>selected <?php } ?>>Verify</option>
                <option value="UNVERIFY" <?php if($row['status'] == 'UNVERIFY'){?>selected <?php } ?>>Unverify</option>
            </select>
            </p>

        </div>
        <div style="height:100px;"></div>
        <div>
                <button type="submit" name="update_shift">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Shifts/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_shift"> Delete</button></a> <?php } ?>
 
 
            </div>
        
    </form>
    <div>
    <a href="./Shifts" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
    include_once __DIR__."/footer.php";
?>