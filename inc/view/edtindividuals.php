<?php
    include __DIR__."/header.php";
    $individualscontroller = new IndividualsController();
    if(isset($_POST['update_indv'])){
        $cred = $individualscontroller->updateindv();
    }else if (isset($_POST['delete_indv'])){
        $cred = $individualscontroller->deleteindv();
    }
    $statement = $individualscontroller->viewindv();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $orgcontroller = new OrganizationsController();
    $orgs = $orgcontroller->orgList();
    $refcontroller = new ReferencesController();
    $sexes = $refcontroller->refList('SEX', $_SESSION['org_id']);
    $nationalities = $refcontroller->refList('NATIONALITY', $_SESSION['org_id']);
    $ethnicities = $refcontroller->refList('ETHNICITY', $_SESSION['org_id']);
    $pobs = $refcontroller->refList('HOSPITALS', $_SESSION['org_id']);

    $addresscontroller = new AddressController();
    $natidcontroller = new NationalidentifiersController();

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
        <h2>Create/Edit Individual</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </p>
            <span1>Organization</span1>                                                   
            <span1>First Name</span1>
            <span1>Surname</span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" <?php if($_SESSION['role'] != 'ADMIN'){ ?>disabled <?php } ?>required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"<?php if($row['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>

            <label for="first_name" ></label>
            <input type="text" placeholder="Enter First Name" name="first_name" value="<?php echo $row['first_name'];?>" required>
        
            <label for="surname"></label>
            <input type="text" placeholder="Enter Surname" name="surname" value="<?php echo $row['surname'];?>" required>
           </p>
           <span>Sex</span>
           <span>D.O.B</span>   
           <span>Place of Birth</span>   
           <p>
            <label for="sex" ></label>
            <select name="sex" required>
                <option value="">--Select Sex--</option>
                
                <?php while($sex = $sexes->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $sex['value_desc']; ?>"<?php if($row['sex'] == $sex['value_desc']){?> selected <?php } ?>><?php echo $sex['value_desc'];?></option>
                <?php } ?>
            </select>
        
            <label for="date_of_birth"></label>
            <input type="date" placeholder="Enter Position Name" name="date_of_birth" value="<?php echo $row['date_of_birth'];?>" required>

            <label for="place_of_birth"></label>
            <select name="place_of_birth" required>
                <option value="">--Select Place of Birth--</option>
                
                <?php while($pob = $pobs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $pob['value_desc']; ?>"<?php if($row['place_of_birth'] == $pob['value_desc']){?> selected <?php } ?>><?php echo $pob['value_desc'];?></option>
                <?php } ?>
            </select>
            </p>

            <span1>Email</span1>
           <span1>Nationality</span1>   
           <span1>Ethnicity</span1>   
           <p>
           <label for="email"></label>
            <input style="width: auto; height:35px" type="emial" placeholder="Enter Email" name="email" value="<?php echo $row['email'];?>" required>

            <label for="nationality"></label>
            <select name="nationality" required>
                <option value="">--Select Nationality--</option>
                
                <?php while($nationality = $nationalities->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $nationality['value_desc']; ?>"<?php if($row['nationality'] == $nationality['value_desc']){?> selected <?php } ?>><?php echo $nationality['value_desc'];?></option>
                <?php } ?>
            </select>
            <label for="ethnicity"></label>
            <select name="ethnicity" required>
                <option value="">--Select ethnicity--</option>
                
                <?php while($ethnicity = $ethnicities->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $ethnicity['value_desc']; ?>" <?php if($row['ethnicity'] == $ethnicity['value_desc']){?> selected <?php } ?>><?php echo $ethnicity['value_desc'];?></option>
                <?php } ?>
            </select>
    
            <span>Status</span>
            <p>
            <label for="status"></label>
            <select name="status" id="" required>
            <option value="KEYED" <?php if($row['status'] == 'KEYED'){?>selected <?php } ?>>Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY" <?php if($row['status'] == 'VERIFY'){?>selected <?php } ?>>Verify</option>
                <option value="UNVERIFY" <?php if($row['status'] == 'UNVERIFY'){?>selected <?php } ?>>Unverify</option> <?php } ?>
            </select>
            </p>
        </div>
        <div style="height:100px;"></div>
        <div>
                <button type="submit" name="update_indv">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Individuals/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_indv"> Delete</button></a> <?php } ?>
 
            </div>
  
        
    </form>
    <?php } ?>
    <div>
    <a href="./Individuals" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php

    include_once __DIR__."/footer.php";
?>