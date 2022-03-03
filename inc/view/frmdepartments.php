<?php
include __DIR__ . "/header.php";
$departmentscontroller = new DepartmentsController();
if (isset($_POST['create_dpt'])) {
    $cred = $departmentscontroller->createdpt();
}

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
        <h2>Create/Edit Department</h2>
          
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
                    <option value="<?php echo $orgs['id']; ?>"><?php echo $orgs['full_name'];?></option>
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
           <span>Dept. Code</span>
           <span>Dept. Name</span>   
           <span>Dept. Level</span>   
           <p>
            <label for="dept_code" ></label>
            <input type="text" placeholder="Enter Department Code" name="dept_code" required>
        
            <label for="dept_name"></label>
            <input type="text" placeholder="Enter Department Name" name="dept_name" required>

            <label for="dept_level"></label>
            <input type="text" placeholder="Enter Department Level" name="dept_level" required>
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
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_dpt">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Departments" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>