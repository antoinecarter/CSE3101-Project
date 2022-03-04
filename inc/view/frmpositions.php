<?php
include __DIR__ . "/header.php";
$positioncontroller = new PositionsController();
if (isset($_POST['create_pos'])) {
    $cred = $positioncontroller->createpos();
}

$orgcontroller = new OrganizationsController();
$refcontroller = new ReferencesController();
$shifttype = $refcontroller->refList('SHIFTTYPE', $_SESSION['org_id']);

$orgs = $orgcontroller->orgList();
$orgstructcontroller = new OrgstructureController();
$orgstructs = $orgstructcontroller->orgstructList($_SESSION['org_id']);

$unitcontroller = new UnitsController();
$units = $unitcontroller->unitsList($_SESSION['org_id']);

$wkloccontroller = new WorklocationsController();
$wklocs = $wkloccontroller->wklocationsList($_SESSION['org_id']);

$placements = $positioncontroller->placementList($_SESSION['org_id'])
?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create/Edit Position</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span1>Organization</span1>                                                   
            <span1>Org Struct. Name</span1>
            <span1>Placement</span1>  
           <p>
            <label for="org_id" ></label>
            <select name="org_id" required>
                <option value="">--Select Organization--</option>

                <?php while($org = $orgs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $org['id']; ?>"><?php echo $org['full_name'];?></option>
                <?php } ?>
            </select>

            <label for="org_struct_id" ></label>
            <select name="org_struct_id" required>
                <option value="">--Select Organization Structure--</option>

                <?php while($orgstruct = $orgstructs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $orgstruct['id']; ?>"><?php echo $orgstruct['org_struct_name'];?></option>
                <?php } ?>
            </select>

            <label for="Parent Unit" ></label>
            <select name="parent_unit_id">
                <option value="">--Select Parent Unit--</option>

                <?php while($placement = $placements->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $placement['id']; ?>"><?php echo $placement['PLACEMENT'];?></option>
                <?php } ?>
            </select>
           </p>
           <span>Code</span>
           <span>Position Name</span>   
           <span>Level</span>   
           <p>
            <label for="pos_code" ></label>
            <input type="text" placeholder="Enter Position Code" name="pos_code" required>
        
            <label for="pos_name"></label>
            <input type="text" placeholder="Enter Position Name" name="pos_name" required>

            <label for="pos_level"></label>
            <input style="width: 100px;" type="number" placeholder="#" name="pos_level" required>
            </p>
            <span>Overview</span>
            <p>
            <label for="overview" ></label>
            <textarea name="overview" id="" placeholder="Overview/Purpose" style="width: 800px; height: 100px; padding: 0; margin: 0;"></textarea>
            </p>

            <span1>Work Location</span1>
           <span1>Lower Limit</span1>   
           <span1>Upper Limit</span1>   
           <p>
            <label for="wk_loc_id" ></label>
            <select name="wk_loc_id">
                <option value="">--Select Work Location--</option>

                <?php while($wkloc = $wklocs->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $wkloc['id']; ?>"><?php echo $wkloc['worklocation'];?></option>
                <?php } ?>
            </select>
        
            <label for="lower_sal"></label>
            <input type="text" placeholder="Enter Lower Salary Limit" name="lower_sal" required>

            <label for="upper_sal"></label>
            <input type="text" placeholder="Enter Upper Salary Limit" name="upper_sal" required>
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
                <?php if($_SESSION['can_verify'] ==  1){?><?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY">Verify</option>
                <option value="UNVERIFY">Unverify</option> <?php } ?> <?php } ?>
            </select>
            </p>
        </div>
        <div style="height:100px;"></div>
        
           <p>
      <?php if($_SESSION['role']=='ADMIN'  && $_SESSION['can_create'] == 1){ ?><button type="submit" name="create_pos">Create</button> <?php } ?>

      </p>
  
        
    </form>
    <div>
    <a href="./Positions" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>
<?php
include_once __DIR__ . "/footer.php";
?>