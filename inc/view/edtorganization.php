<?php
include __DIR__ . "/header.php";
$orgcontroller = new OrganizationsController();
if (isset($_POST['update_organization'])) {
    $cred = $orgcontroller->updateorg();
}else if (isset($_POST['delete_organization'])){
    $cred = $orgcontroller->deleteorg();
}
$refcontroller = new ReferencesController();
$countries = $refcontroller->refList('COUNTRIES', $_SESSION['org_id']);
$statement = $orgcontroller->vieworg();
$row = $statement->fetch(PDO::FETCH_ASSOC);

?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit Organization</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            </p>
            <span1>Organization Type</span1>                                                   
            <span1>Short Name</span1>
            <span1>Full Name</span1>  
           <p>
            <label for="org_type"></label>
            <select name="org_type" required>
                <option value="">--Select Organization Type--</option>
                <option value="APP_USER" <?php if($row['org_type'] == 'APP_USER'){?>selected <?php } ?>>APP USER</option>
                <option value="REMITTANCE" <?php if($row['org_type'] == 'REMITTANCE'){?>selected <?php } ?>>REMITTANCE</option>
                <option value="BANK" <?php if($row['org_type'] == 'BANK'){?>selected <?php } ?>>BANK</option>
                <option value="OTHER" <?php if($row['org_type'] == 'OTHER'){?>selected <?php } ?>>OTHER</option>
            </select>

            <label for="short_name" ></label>
            <input type="text" placeholder="Enter Short Name" name="short_name" value="<?php echo $row['short_name']; ?>" required>

            <label for="full_name" ></label>
            <input type="text" placeholder="Enter Full Name" name="full_name" value="<?php echo $row['full_name']; ?>"required>
           </p>
           <span>Address</span>   
           <p>
            <label for="address" ></label>
            <textarea name="address" id="" placeholder="Enter Address" style="width: 800px; height: 100px; padding: 0; margin: 0;"><?php echo $row['address'];?></textarea>
           </p>
            <span>Country</span>
            <p>
            <label for="country"></label>
            <select name="country" required>
                <option value="">--Select Country--</option>
                
                <?php while($country = $countries->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $country['value_desc']; ?>"<?php if($row['country'] == $country['value_desc']){?>selected <?php } ?>><?php echo $country['value_desc'];?></option>
                <?php } ?>
            </select>
            </p>
            <span1>Telephone</span1>                                                   
            <span1>Fax</span1>
            <span1>Email</span1>  
           <p>
            <label for="telephone"></label>
            <input type="number" placeholder="Enter Telephone Number" name="telephone" value="<?php echo $row['telephone']; ?>" required>

            <label for="fax" ></label>
            <input type="number" placeholder="Enter Fax Number" name="fax" value="<?php echo $row['fax']; ?>" required>

            <label for="email" ></label>
            <input style="width: auto; height:35px" type="email" placeholder="Enter Email" name="email" value="<?php echo $row['email']; ?>" required>
           </p>
            <span>Start Date</span>
            <span>End Date</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" value="<?php echo $row['start_date']; ?>" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date" value="<?php echo $row['end_date']; ?>" >
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
        <?php if($_SESSION['can_update'] == 1){ ?> <button type="submit" name="update_organization">Apply Changes</button> <?php } ?>
        <?php if($_SESSION['can_delete'] == 1){ ?>  <?php if($row['status'] != 'VERIFY'){ ?><a href="./Organizations/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_organization">Delete</button></a> <?php } ?> <?php } ?>
 
 
            </div> 
    </form>
    <div>
    <a href="./Organizations" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>