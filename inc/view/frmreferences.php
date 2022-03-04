<?php
include __DIR__ . "/header.php";
$refcontroller = new ReferencesController();
if (isset($_POST['create_reference'])) {
    $cred = $refcontroller->createref();
    header('Location: /CSE3101-Project/References');
}
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
        <h2>Create/Edit Reference</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Table Name</span1>
            <span1>Table Description</span1>  
           <p>
            <label for="org_id"></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id'];?>"><?php echo $org['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="table_name" ></label>
            <input type="text" placeholder="..." name="table_name" required>

            <label for="table_desc" ></label>
            <input type="text" placeholder="Listing of..." name="table_desc" required>
           </p>
           <span>Table Value</span>
           <span>Value Description</span>   
           <p>
            <label for="table_value" ></label>
            <input type="text" placeholder="Enter Table Value" name="table_value" required>
        
            <label for="value_desc"></label>
            <input type="text" placeholder="Enter Value Description" name="value_desc" required>
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
      <?php if($_SESSION['role']=='ADMIN'){ ?><button type="submit" name="create_reference">Create</button> <?php } ?>
        
    </form>
    <div>
    <a href="./References" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>