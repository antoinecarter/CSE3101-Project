<?php
include __DIR__ . "/header.php";
$orgstructModel = new OrgstructureController();
if (isset($_POST['create_org_struct'])) {
    $cred = $orgstructModel->createorgstructure();
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
        <h2>Create/Edit Organization Structure</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization </span1>                                                   
            <span1>Organization Structure Name </span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($orgs){ ?>
                    <option value="<?php echo $orgs['id']; ?>"><?php echo $orgs['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="org_struct_name" ></label>
            <input type="text" placeholder="Enter Shift Code" name="org_struct_name" required>
           </p>

            <span>Start Date</span>
            <span>End Date</span>
            <span>Status</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date">
            
            <label for="status"></label>
            <select name="status" id="" required>
                <option value="KEYED">Keyed</option>
                <option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option>
            </select>
            </p>

        </div>
        <div style="height:100px;"></div>
           <p>
      <?php if($_SESSION['role']=='ADMIN' && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_org_struct">Create</button> <?php } ?>

      </p>
        
    </form>
    <div>
    <a href="./Orgstructure" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>