<?php
include __DIR__ . "/header.php";
$orgstructModel = new OrgstructureController();
if (isset($_POST['update_org_struct'])) {
    $cred = $orgstructModel->createorgstructure();
}else if (isset($_POST['delete_org_struct'])){
    $cred = $orgstructModel->deleteorgstructure();
}
$statement = $orgstructModel->vieworgstructure();
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
    <form method="post" action="">
        <div>
        <h2>Create/Edit Organization Structure</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </p>
            <span1>Organization </span1>                                                   
            <span1>Organization Structure Name </span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($orgs){ ?>
                    <option value="<?php echo $row['org_id']; ?>"<?php if($row['org_id'] == $orgs['id']){?> selected <?php } ?>><?php echo $orgs['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="org_struct_name" ></label>
            <input type="text" placeholder="Enter Shift Code" name="org_struct_name" value="<?php echo $row['org_struct_name'];?>" required>
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
                <button type="submit" name="update_org_struct">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Orgstructure/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_org_struct"> Delete</button></a> <?php } ?>
 
 
            </div>
        
    </form>
    <div>
    <a href="./Orgstructure" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>