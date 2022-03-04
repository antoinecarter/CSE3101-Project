<?php
include __DIR__ . "/header.php";
$nationalidentifierscontroller = new NationalidentifiersController();
if (isset($_POST['create_nationalidentifiers'])) {
    $cred = $nationalidentifierscontroller->createnationalidentifiers();
}

$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();
$refcontroller = new ReferencesController();
$natids = $refcontroller->refList('IDENTIFIERS', $_SESSION['org_id']);
$indcontroller = new IndividualsController();
$empcontroller = new  EmployeesController();
$usercontroller = new UsersController();
$individuals = $indcontroller->individualsList($_SESSION['org_id']);
$employees = $empcontroller->empList($_SESSION['org_id']);
$users = $usercontroller->userList();
?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit National Identifier</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span>Organization</span>
            <span>Individual</span>
        <p>
            <label for="org_id"></label>
            <select name="org_id" required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"<?php if($_SESSION['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>
           
            <label for="ind_id"></label>
            <select name="ind_id" required>
                    <option value="">--Select Individual--</option>
    
                    <?php while($individual = $individuals->fetch(PDO::FETCH_ASSOC)){ ?>
                        <option value="<?php echo $individual['id']; ?>"><?php echo $individual['individual'];?></option>
                    <?php } ?>
                </select>
            </p>
            <span>Identifier</span>
            <span>Identifier No.</span> 
            <p>
            <label for="identifier"></label>
            <select name="identifier" required>
                <option value="">--Select Identifier--</option>
                
                <?php while($natid = $natids->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $natid['value_desc']; ?>"><?php echo $natid['value_desc'];?></option>
                <?php } ?>
            </select>

        
            <label for="identifier_num"></label>
            <input type="text" placeholder=" Enter Identifier No." name="identifier_num">
            </p>
            <span>Start Date</span>
            <span>End Date</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date">
            </p>

            </p>
        
   

            <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_nationalidentifiers">Create</button> <?php } ?>

      </p>
  
        </div>
        
    </form>
    <div>
    <a href="./NationalIdentifier" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>