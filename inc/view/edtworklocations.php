<?php
    include __DIR__."/header.php";
    $worklocationsModel = new WorklocationsController();
    if(isset($_POST['update_workl'])){
        $cred = $worklocationsModel->updateworkl();
    }else if (isset($_POST['delete_workl'])){
        $cred = $worklocationsModel->deleteworkl();
    }
    $statement = $worklocationsModel->viewworkl();
    
$row = $statement->fetch(PDO::FETCH_ASSOC);
$orgcontroller = new OrganizationsController();
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
        <h2>Create/Edit Work Locations</h2>
          
        </div>
        <div>
            <p>
            <label for="id"></label>
            <input type="hidden" name="id" value= "<?php echo $row['id'];?>">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Location Code</span1>
            <span1>Location Descript.</span1>  
           <p>
           <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>" <?php if($row['org_id'] == $org['id']){ ?> selected <?php } ?>><?php echo $org['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="location_code" ></label>
            <input type="text" placeholder="Enter Location Code" name="location_code" value= "<?php echo $row['location_code'];?>" required>

            <label for="location_desc" ></label>
            <input type="text" placeholder="Enter Location Description" name="location_desc" value= "<?php echo $row['location_desc'];?>"required>
            
           </p>
           <span>Address</span>
           <span>Telephone</span>   
           <p>
            <label for="address" ></label>
            <textarea name="address" id="" placeholder="Enter Address" style="width: 800px; height: 100px; padding: 0; margin: 0;" ><?php echo $row['address'];?></textarea>

            <label for="telephone"></label>
            <input type="number" placeholder="Enter Telephone #" name="telephone" value= "<?php echo $row['telephone'];?>" required>

            </p>
            <span>Start Date</span>
            <span>End Date</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" value= "<?php echo $row['start_date'];?>" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date" value= "<?php echo $row['end_date'];?>">
            </p>
            <span>Status</span>
           <p>
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
                <button type="submit" name="update_workl">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Worklocations/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_workl">Delete</button></a> <?php } ?>
 
 
            </div> 
        
    </form>
    <?php } ?>
    <div>
    <a href="./Worklocations" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
    include_once __DIR__."/footer.php";
?>