<?php
include __DIR__ . "/header.php";
$unitscontroller = new UnitsController();
if (isset($_POST['create_units'])) {
    $cred = $unitscontroller->createunits();
}

$departmentscontroller = new DepartmentsController();
$orgcontroller = new OrganizationsController();
$orgs = $orgcontroller->orgList();
$orgstructcontroller = new OrgstructureController();
$orgstruct = $orgstructcontroller->orgstructList($_SESSION['org_id']);
$depts= $departmentscontroller->deptList($_SESSION['org_id']);
?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit Units</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Org Structure Name</span1>
            <span1>Parent Dept.</span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($orgs){ ?>
                    <option value="<?php echo $orgs['id']; ?>"<?php if($row['org_id'] == $orgs['id']){?> selected <?php } ?>><?php echo $orgs['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="org_struct_id" ></label>
            <select name="org_struct_id" required>
                <option value="">--Select Organization Structure--</option>

                <?php while($orgstruct){ ?>
                    <option value="<?php echo $orgstruct['id']; ?>"><?php echo $orgstruct['org_struct_name'];?></option>
                <?php } ?>
            </select>

            <label for="Parent Department" ></label>
            <select name="parent_dept_id">
                <option value="">--Select Parent Department--</option>

                <?php while($depts){ ?>
                    <option value="<?php echo $depts['id']; ?>"><?php echo $depts['department'];?></option>
                <?php } ?>
            </select>
           </p>
           <span>Unit Code</span>
           <span>Unit Name</span>   
           <span>Unit Level</span>   
           <p>
            <label for="unit_code" ></label>
            <input type="text" placeholder="Enter Unit Code" name="unit_code" required>
        
            <label for="unit_name"></label>
            <input type="text" placeholder="Enter Unit Name" name="unit_name" required>

            <label for="unit_level"></label>
            <input type="text" placeholder="Enter Unit Level" name="unit_level" required>
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
        </div>
        <div style="height:100px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_units">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Units" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>