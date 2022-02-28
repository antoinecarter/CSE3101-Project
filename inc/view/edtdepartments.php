<?php
    include __DIR__."/header.php";
    $departmentscontroller = new DepartmentsController();
    if(isset($_POST['update_dpt'])){
        $cred = $departmentscontroller->updatedpt();
    }else if (isset($_POST['delete_dpt'])){
        $cred = $departmentscontroller->deletedpt();
    }
    $statement = $departmentscontroller->viewdpt();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<div class = "edit-usr">
    <div><?php if(isset($cred)){ echo $cred;}?></div>
        <?php if(isset($row['id'])){?>
            <div>
            <form method="post" action="">
        <h2>Update Department</h2>
        <div>
            <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            </p>
           <p>
            <label for="department_name">Department Name</label>
            <input type="text" name="department_name" value="<?php echo $row['department_name']; ?>" required>
            </p>
           <p>
            <label for="start_date">Effective From</label>
            <input type="date" name="start_date" value="<?php echo $row['start_date']; ?>" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
            </p>
           <p>
            <label for="end_date">Effective To</label>
            <input type="date" name="end_date" value="<?php echo $row['end_date']; ?>" <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
            </p>
           <p>
        <div style="height:100px;"></div>
        <?php if($_SESSION['role'] == 'ADMIN'){ ?>
        <div>
            <p>
            <label for="org_id">Organization</label>
            <input type="text" name="org_id">
            </p>
           <p>
            <label for="emp_no">Employee No.</label>
            <input type="text" name="emp_no">
            </p>

           
        </div>
        <?php } ?>
        <div>
                <button type="submit" name="update_dpt">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Users/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_dpt"> Delete</button></a> <?php } ?>
 
 
            </div>
    </form>
    <?php } ?>
    <div>
                
        <a href="./Users"> <button style = "background-color:#0b74eb;">Return</button></a>
        
    </div>
    </div>
    
    
    
</div>

<?php
    include_once __DIR__."/footer.php";
?>