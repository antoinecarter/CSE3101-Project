<?php
include __DIR__ . "/header.php";
$addresscontroller = new AddressController();
if (isset($_POST['update_address'])) {
    $cred = $addresscontroller->updateaddress();
}else if(isset($_POST['delete_address'])){
    $cred = $addresscontroller->deleteaddress();
}

$statement = $addresscontroller->viewaddress();
$row = $statement->fetch(PDO::FETCH_ASSOC);

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
        <?php if(isset($row['id'])){?>

    <form method="post" action="">
        <div>
        <h2>Create/Edit Address</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            <label for="ind_id"></label>
            <input type="hidden" name="ind_id" value="<?php echo $row['ind_id'];?>">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Individual</span1>
            <span1>Address Type</span1> 
           <p>
            <label for="org_id" ></label>
            <select name="org_id" <?php if($_SESSION['role'] != 'ADMIN'){ ?>disabled <?php } ?>required>
                    <option value="">--Select Organization--</option>
    
                    <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"<?php if($_SESSION['org_id'] == $org['id']){?>selected<?php }?>><?php echo $org['full_name'];?></option>
                <?php } ?>
                </select>
            
                <label for="ind_id"></label>
                <select name="ind_id" disabled required>
                    <option value="">--Select Individual--</option>
    
                    <?php while($individual = $individuals->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $individual['id']; ?>"<?php if($row['ind_id'] == $individual['id']){?>selected<?php }?>><?php echo $individual['individual'];?></option>
                <?php } ?>
                </select>
            <select name="address_type" id="" required>
                <option value="">--Select Address Type--</option>
                <option value="HOME" <?php if($row['address_type'] == "HOME"){ ?> selected <?php }?>>HOME</option>
                <option value="WORK" <?php if($row['address_type'] == "WORK"){ ?> selected <?php } ?>>WORK</option>
            </select>
            
           </p>
           <span>Country</span>
           <span>Lot</span>       
           <p>
           <label for="country" ></label>
            <select name="country" required>
                <option value="">--Select Country--</option>
                
                <?php while($country = $countries->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $country['value_desc']; ?>"<?php if($row['country'] == $country['value_desc']){ ?>selected <?php }?>><?php echo $country['value_desc'];?></option>
                <?php } ?>
            </select>
           <label for="lot" ></label>
            <input  style="width: 100px; height:35px" type="number" placeholder="Enter Lot" name="lot" value="<?php echo $row['lot'];?>"required>
           </p>
           <span>Add. Line 1</span>
           <span>Add. Line 2</span>
           <span>Add. Line 3</span>
           <p>
           <label for="address_line1"></label>
            <input type="text" placeholder="Enter Address Line 1" name="address_line1" value="<?php echo $row['address_line1'];?>" required>

            <label for="address_line2"></label>
            <input type="text" placeholder="Enter Address Line 2" name="address_line2" value="<?php echo $row['address_line2'];?>" required>

            <label for="address_line3"></label>
            <input type="text" placeholder="Enter Address Line 3" name="address_line3" value="<?php echo $row['address_line3'];?>">
           </p>

           <span>Start Date</span>   
           <span>End Date</span>   
           <p>
            

            <label for="start_date"></label>
            <input type="date" name="start_date" value="<?php echo $row['start_date'];?>" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date" value="<?php echo $row['end_date'];?>">
            </p>
        </div>
        <div style="height:100px;"></div>
        
        <div>
        <?php if($_SESSION['can_update'] == 1){ ?> <button type="submit" name="update_address">Apply Changes</button> <?php } ?>
        <?php if($_SESSION['can_delete'] == 1){ ?> <a href="./Address/Registration/Delete?id=<?php echo $row['id'];?>"> <button style = "background-color:#eb0b4e;"  name="delete_address"> Delete</button></a> <?php } ?>
 
            </div>
  
        
    </form>
    <?php } ?>
    <div>
    <a href="./Address" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>