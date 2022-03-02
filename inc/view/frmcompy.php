<?php
include __DIR__ . "/header.php";
$compyearcontroller = new CompyearController();
if (isset($_POST['create_compyr'])) {
    $cred = $compyearcontroller->createcompyr();
}

$orgcontroller = new OrganizationsController();
$refcontroller = new ReferencesController();
$payfreq = $refcontroller->refList('TBLPAYMENTFREQUENCY', $_SESSION['org_id']);
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
        <h2>Create/Edit Company Year</h2>
          
        </div>
        <div>
            <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Year</span1>
            <span1>Payment Frequency</span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($orgs){ ?>
                    <option value="<?php echo $orgs['id']; ?>"><?php echo $orgs['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="year" ></label>
            <input type="text" placeholder="Enter Company Year" name="year" required>

            <label for="payment_frequency" ></label>
            <select name="payment_frequency" required>
                <option value="">--Select Payment Frequency--</option>
                
                <?php while($payfreq){ ?>
                    <option value="<?php echo $payfreq['value_desc']; ?>"><?php echo $payfreq['value_desc'];?></option>
                <?php } ?>
            </select>
           </p>
            <span>Start Year</span>
            <span>End Year</span>
            <p>
            <label for="start_year"></label>
            <input type="date" name="start_year" required>
        
            <label for="end_year"></label>
            <input type="date" name="end_year" required>
            </p>

           <p>
        </div>
        <div style="height:100px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN' && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_user">Create</button> <?php } ?>

      </p>
  
        </div>
        
    </form>
    <div>
    <a href="./Users" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>