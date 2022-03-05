<?php
    include __DIR__."/header.php";
    $salarycontroller = new SalaryController();
    if(isset($_POST['update_sal'])){
        $cred = $salarycontroller->updatesal();
    }else if (isset($_POST['delete_sal'])){
        $cred = $salarycontroller->deletesal();
    }
    $statement = $salarycontroller->viewsal();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $orgcontroller = new OrganizationsController();
    $orgs = $orgcontroller->orgList();

    $empcontroller = new EmployeesController();
    $emps = $empcontroller->empList($_SESSION['org_id']);
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
        <h2>Create/Edit Salary</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id']?>">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Employee</span1>
            <span1>Salary</span1>  
           <p>
           <label for="org_id"></label>
           <select name="org_id" <?php if($_SESSION['role'] != 'ADMIN'){ ?>disabled <?php } ?>required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"<?php if($row['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>
           <label for="emp_id"></label>
           <select name="emp_id" required>
                    <option value="">--Select Employee--</option>
    
                    <?php while($emp = $emps->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $emp['id']; ?>" <?php if($row['emp_id'] == $emp['id']){?> selected <?php } ?> ><?php echo $emp['employee'];?></option>
                <?php } ?>
                </select>

           <label for="salary"></label>
            <input type="text" placeholder="Enter Salary" name="salary" value="<?php echo $row['salary']?>" required>

           </p>

            <span1>Monthly Basic</span1>   
            <span1 >Daily Rate</span1>
            <span1 >Hourly Rate</span1>
         <p>
         
         <label for="monthly_basic"></label>
            <input type="text" placeholder="Enter Monthly Basic" name="monthly_basic" value="<?php echo $row['monthly_basic']?>" readonly>

         <label for="daily_rate"></label>
            <input type="text" placeholder="Enter Daily Rate" name="daily_rate" value="<?php echo $row['daily_rate']?>" readonly>

            <label for="hourly_rate"></label>
            <input type="text" placeholder="Enter Hourly Rate" name="hourly_rate" value="<?php echo $row['hourly_rate']?>" readonly>

         </p>
            <span >Start Date</span>
            <span >End Date</span>
         <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" value="<?php echo $row['start_date']?>" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date" value="<?php echo $row['end_date']?>">
            </p>
            </p>
        </div>
        <div style="height:30px;"></div>
        
        <div>
                <button type="submit" name="update_sal">Apply Changes</button>
            <a href="./Address/Registration/Delete?id=<?php echo $row['id'];?>"> <button style = "background-color:#eb0b4e;"  name="delete_sal"> Delete</button></a> 
 
            </div>
  
        
    </form>
    <?php } ?>
    <div>
    <a href="./Salary" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
    include_once __DIR__."/footer.php";
?>