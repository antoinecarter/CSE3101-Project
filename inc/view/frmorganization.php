<?php
include __DIR__ . "/header.php";
$orgcontroller = new OrganizationsController();
if (isset($_POST['create_organization'])) {
    $cred = $orgcontroller->createorg();
    header('Location: /CSE3101-Project/Organizations');
}

$refcontroller = new ReferencesController();
$countries = $refcontroller->refList('TBLCOUNTRIES', $_SESSION['org_id']);
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
            <input type="hidden" name="id">
            </p>
            <span1>Organization Type</span1>                                                   
            <span1>Short Name</span1>
            <span1>Full Name</span1>  
           <p>
            <label for="org_type"></label>
            <select name="org_type" required>
                <option value="">--Select Organization Type--</option>
                <option value="APP_USER">APP USER</option>
                <option value="REMITTANCE">REMITTANCE</option>
                <option value="BANK">BANK</option>
                <option value="OTHER">OTHER</option>
            </select>

            <label for="short_name" ></label>
            <input type="text" placeholder="Enter Short Name" name="short_name" required>

            <label for="full_name" ></label>
            <input type="text" placeholder="Enter Full Name" name="full_name" required>
           </p>
           <span>Address</span>
           <p>
            <label for="address" ></label>
            <textarea name="address" id="" placeholder="Enter Address"></textarea>
           </p>
           
           <span>Country</span>   
           <p>
            <label for="country"></label>
            <select name="country" required>
                <option value="">--Select Country--</option>
                
                <?php while($country = $countries->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $country['value_desc']; ?>"><?php echo $country['value_desc'];?></option>
                <?php } ?>
            </select>
            </p>
            <span1>Telephone</span1>                                                   
            <span1>Fax</span1>
            <span1>Email</span1>  
           <p>
            <label for="telephone"></label>
            <input type="text" placeholder="Enter Telephone Number" name="telephone" required>

            <label for="fax" ></label>
            <input type="text" placeholder="Enter Fax Number" name="fax" required>

            <label for="email" ></label>
            <input type="text" placeholder="Enter Email" name="email" required>
           </p>
            <span>Start Date</span>
            <span>End Date</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date">
            </p>
            <span>Status</span>
           <p>
            <label for="status"></label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option> <?php } ?>
            </select>
            </p>

           <p>
        </div>
        <div style="height:100px;"></div>
      <?php if($_SESSION['role']=='ADMIN'){ ?><button type="submit" name="create_organization">Create</button> <?php } ?>
        
    </form>
    <div>
    <a href="./Organizations" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>