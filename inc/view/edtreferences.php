<?php
include __DIR__ . "/header.php";
$refcontroller = new ReferencesController();
if (isset($_POST['update_reference'])) {
    $cred = $refcontroller->updateref();
}else if(isset($_POST['delete_reference'])){
    $cred = $refcontroller->deleteref();
}
$statement = $refcontroller->viewref();
$row = $statement->fetch(PDO::FETCH_ASSOC);
$orgcontroller = new OrganizationsController();

$orgs = $orgcontroller->orgList();

?>
<div class = "form-usr">
<?php if(isset($cred)){ ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } ?>
  <?php if(isset($row['id'])){?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit Reference</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Table Name</span1>
            <span1>Table Description</span1>  
           <p>
            <label for="org_id"></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>" <?php if($row['org_id'] == $org['id']){ ?> selected <?php } ?>><?php echo $org['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="table_name" ></label>
            <input type="text" placeholder="..." name="table_name" value="<?php echo $row['table_name']; ?>" required>

            <label for="table_desc" ></label>
            <input type="text" placeholder="Listing of ..." name="table_desc" value="<?php echo $row['table_desc']; ?>" required>
           </p>
           <span>Table Value</span>
           <span>Value Description</span>   
           <p>
            <label for="table_value" ></label>
            <input type="text" placeholder="Enter Table Value" name="table_value" value="<?php echo $row['table_value']; ?>"required>
        
            <label for="value_desc"></label>
            <input type="text" placeholder="Enter Value Description" name="value_desc" value="<?php echo $row['value_desc']; ?>" required>
            </p>
            <span>Start Date</span>
            <span>End Date</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" value="<?php echo $row['start_date']; ?>"required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date" value="<?php echo $row['end_date']; ?>">
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

           <p>
        </div>
        <div style="height:100px;"></div>
        <div>
        <?php if($_SESSION['can_update'] == 1){ ?> <button type="submit" name="update_reference">Apply Changes</button> <?php } ?>
        <?php if($_SESSION['can_delete'] == 1){ ?>  <?php if($row['status'] != 'VERIFY'){ ?><a href="./References/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_reference"> Delete</button></a> <?php } ?> <?php } ?>
 
 
            </div>      
        
    </form>
    <?php } ?>
    <div>
    <a href="./References" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>