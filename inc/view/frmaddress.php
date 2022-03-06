<?php
include __DIR__ . "/header.php";
$addresscontroller = new AddressController();
if (isset($_POST['create_address'])) {
    $cred = $addresscontroller->createaddress();
}

$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();
$refcontroller = new ReferencesController();
$countries = $refcontroller->refList('COUNTRIES', $_SESSION['org_id']);
$indcontroller = new IndividualsController();
$empcontroller = new  EmployeesController();

$individuals = $indcontroller->individualsList($_SESSION['org_id']);
$employees = $empcontroller->empList($_SESSION['org_id'], $_SESSION['role'], $_SESSION['emp_no']);

?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit Address</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Individual</span1> 
           <span>Address Type</span>
           <p>
            <label for="org_id" ></label>
            <select name="org_id" readonly required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"<?php if($_SESSION['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>
                <select name="ind_id" required>
                    <option value="">--Select Individual--</option>
    
                    <?php while($individual = $individuals->fetch(PDO::FETCH_ASSOC)){ ?>
                        <option value="<?php echo $individual['id']; ?>"><?php echo $individual['individual'];?></option>
                    <?php } ?>
                </select>
                <select name="address_type" id="">
                <option value="HOME">HOME</option>
                <option value="WORK">WORK</option>
            </select>
           </p>
           
           <span>Country</span>
           <span>Lot</span>       
           <p>
           <label for="country" ></label>
            <select name="country" required>
                <option value="">--Select Country--</option>
                
                <?php while($country = $countries->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $country['value_desc']; ?>"><?php echo $country['value_desc'];?></option>
                <?php } ?>
            </select>

           <label for="lot" ></label>
            <input style="width: 100px; height:35px" type="number" placeholder="Enter Lot" name="lot" required>
           </p>
           <span>Add. Line 1</span>
           <span>Add. Line 2</span>
           <span>Add. Line 3</span>
           <p>
           <label for="address_line1"></label>
            <input type="text" placeholder="Enter Address Line 1" name="address_line1" required>

            <label for="address_line2"></label>
            <input type="text" placeholder="Enter Address Line 2" name="address_line2" required>

            <label for="address_line3"></label>
            <input type="text" placeholder="Enter Address Line 3" name="address_line3">
                    </p>
           <span>Start Date</span>   
           <span>End Date</span>   
           <p>


            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date">
            </p>
        </div>
        <div style="height:30px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_address">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Address" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>