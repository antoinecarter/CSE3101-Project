<?php
include __DIR__ . "/header.php";
$individualscontroller = new IndividualsController();
if (isset($_POST['create_indv'])) {
    $cred = $individualscontroller->createindv();
}


$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();
$refcontroller = new ReferencesController();
$sex = $refcontroller->refList('TBLSEX', $_SESSION['org_id']);
$nationality = $refcontroller->refList('TBLNATIONALITY', $_SESSION['org_id']);
$ethnicity = $refcontroller->refList('TBLETHNICITY', $_SESSION['org_id']);
$pob = $refcontroller->refList('TBLPLACEOFBIRTH', $_SESSION['org_id']);

?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit Individual</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization</span1>                                                   
            <span1>First Name</span1>
            <span1>Surname</span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" readonly required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($orgs){ ?>
                        <option value="<?php echo $orgs['id']; ?>"<?php if($_SESSION['org_id'] == $orgs['id']){?> selected <?php } ?>><?php echo $orgs['full_name'];?></option>
                    <?php } ?>
                </select>

            <label for="first_name" ></label>
            <input type="text" placeholder="Enter First Name" name="first_name" required>
        
            <label for="surname"></label>
            <input type="text" placeholder="Enter Surname" name="surname" required>
           </p>
           <span>Sex</span>
           <span>D.O.B</span>   
           <span>Place of Birth</span>   
           <p>
            <label for="sex" ></label>
            <select name="sex" required>
                <option value="">--Select Sex--</option>
                
                <?php while($sex){ ?>
                    <option value="<?php echo $sex['value_desc']; ?>"><?php echo $sex['value_desc'];?></option>
                <?php } ?>
            </select>
        
            <label for="date_of_birth"></label>
            <input type="date" placeholder="Enter Position Name" name="date_of_birth" required>

            <label for="place_of_birth"></label>
            <select name="place_of_birth" required>
                <option value="">--Select Place of Birth--</option>
                
                <?php while($pob){ ?>
                    <option value="<?php echo $pob['value_desc']; ?>"><?php echo $pob['value_desc'];?></option>
                <?php } ?>
            </select>
            </p>

            <span>Email</span>
           <span>Nationality</span>   
           <span>Ethnicity</span>   
           <p>
           <label for="email"></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="nationality"></label>
            <select name="nationality" required>
                <option value="">--Select Nationality--</option>
                
                <?php while($nationality){ ?>
                    <option value="<?php echo $nationality['value_desc']; ?>"><?php echo $nationality['value_desc'];?></option>
                <?php } ?>
            </select>
            <label for="ethnicity"></label>
            <select name="ethnicity" required>
                <option value="">--Select Ethnicity--</option>
                
                <?php while($ethnicity){ ?>
                    <option value="<?php echo $ethnicity['value_desc']; ?>"><?php echo $ethnicity['value_desc'];?></option>
                <?php } ?>
            </select>
    
            <span>Status</span>
            <p>
            <label for="status"></label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option> <?php } ?> <?php } ?>
            </select>
            </p>
        </div>
        <div style="height:100px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_indv">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Individuals" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>


<?php
include_once __DIR__ . "/footer.php";
?>