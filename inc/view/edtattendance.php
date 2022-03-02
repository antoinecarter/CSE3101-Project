

<?php
    include __DIR__."/header.php";
    $attendancecontroller = new AttendanceController();
    if(isset($_POST['update_attendance'])){
        $cred = $attendancecontroller->updateattendance();
    }else if (isset($_POST['delete_attendance'])){
        $cred = $attendancecontroller->deleteattendance();
    }
    $statement = $attendancecontroller->viewattendance();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<div class = "edit-usr">
    <div><?php if(isset($cred)){ echo $cred;}?></div>
        <?php if(isset($row['id'])){?>
            <div>
    <form method="post" action="">
        <h2>Update User</h2>
        <div>

            <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            </p>
            <span>Organization</span>
            <span>Employee No.</span>
            <p>
            <label for="org_id"></label>
            <input type="text" placeholder=" Enter Organization" name="org_id">

            <label for="emp_id"></label>
            <input type="text" placeholder=" Enter Employee No." name="emp_id">
            </p>
        </p>
           <span>Effective From</span>
            <span>Effective To</span>
           <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" value="<?php echo $row['start_date']; ?>" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
       
            <label for="end_date"></label>
            <input type="date" name="end_date" value="<?php echo $row['end_date']; ?>" <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
            </p>
            <span>Rule Option</span>
            <span>Rule Value</span>
            <p>
            <label for="rule_option"></label>
            <select name="rule_option" id="" required>
            <option value="1" <?php if($row['rule_option'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['rule_option'] == 0){?>selected <?php } ?>>No</option>
            </select>
 
            <label for="rule_value"></label>
            <select name="rule_value" id="" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
            <option value="1" <?php if($row['rule_value'] == 1){?>selected <?php } ?>>Yes</option>
                <option value="0" <?php if($row['rule_value'] == 0){?>selected <?php } ?>>No</option>
            </select>
        </div>
        </p>


        <div>
                <button type="submit" name="update_attendance">Apply Changes</button>
            <?php if($row['org_id'] != 'VERIFY'){ ?><a href="./Attendance/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_attendance"> Delete</button></a> <?php } ?>
 
 
            </div>
    </form>
    <?php } ?>
    <div>
                
    <a href="./Attendance" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
    </div>
    
    
    
</div>

<?php
    include_once __DIR__."/footer.php";
?>