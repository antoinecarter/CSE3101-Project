<?php
    include __DIR__."/header.php";
    $positionsModel = new PositionsController();
    if(isset($_POST['update_pos'])){
        $cred = $positionsModel->updatepos();
    }else if (isset($_POST['delete_pos'])){
        $cred = $positionsModel->deletepos();
    }
    $statement = $positionsModel->viewpos();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
?>
    <div class = "form-usr">
    <?php if(isset($cred)){ 
      ?>
      <div class = "exist" > <?php echo $cred; ?> </div>
      <?php } 
      ?>
        <form method="post" action="">
            <div>
            <h2>Create/Edit Positions</h2>
              
            </div>
            <div>
                     <p>
                <label for="id"></label>
                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                </p>
                <span1>Organization</span1>                                                   
                <span1>Org Structure Name</span1>
                <span1>Parent Unit</span1>  
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
                    <option value="<?php echo $orgstruct['id']; ?>" <?php if($row['org_struct_id'] == $orgstruct['id']){?> selected <?php } ?>><?php echo $orgstruct['org_struct_name'];?></option>
                <?php } ?>
                </select>
    
                <label for="Parent Unit" ></label>
                <select name="parent_unit_id">
                    <option value="">--Select Parent Unit--</option>
    
                    <?php while($units){ ?>
                        <option value="<?php echo $units['id']; ?>" <?php if($row['parent_unit_id'] == $units['id']){ ?> selected <?php }?>><?php echo $units['unit'];?></option>
                    <?php } ?>
                </select>
               </p>
               <span>Position Code</span>
               <span>Position Name</span>   
               <span>Position Level</span>   
               <p>
                <label for="pos_code" ></label>
                <input type="text" placeholder="Enter Position Code" name="pos_code" value="<?php echo $row['pos_code'];?>" required>
            
                <label for="pos_name"></label>
                <input type="text" placeholder="Enter Position Name" name="pos_name" value="<?php echo $row['pos_name'];?>" required>
    
                <label for="pos_level"></label>
                <input type="text" placeholder="Enter Position Level" name="pos_level" value="<?php echo $row['pos_level'];?>" required>
                </p>
                <span>Overview</span>
                <p>
                <label for="overview" ></label>
                <textarea name="overview" id="" cols="70" rows="1" placeholder="Overview/Purpose" style="width: 800px; height: 100px; padding: 0; margin: 0;"><?php echo $row['overview'];?></textarea>
                </p>
    
                <span>Work Location</span>
               <span>Lower Salary Limit</span>   
               <span>Upper Salary Limit</span>   
               <p>
                <label for="wk_loc_id" ></label>
                <select name="wk_loc_id">
                    <option value="">--Select Work Location--</option>
    
                    <?php while($wkloc){ ?>
                        <option value="<?php echo $wkloc['id']; ?>" <?php if($row['wk_loc_id'] == $wkloc['id']){?> selected <?php } ?> ><?php echo $wkloc['worklocation'];?></option>
                    <?php } ?>
                </select>
            
                <label for="lower_sal"></label>
                <input type="text" placeholder="Enter Lower Salary Limit" name="lower_sal" value="<?php echo $row['lower_sal'];?>" required>
    
                <label for="upper_sal"></label>
                <input type="text" placeholder="Enter Upper Salary Limit" name="upper_sal" value="<?php echo $row['upper_sa;'];?>"required>
                </p>
    
                <span>Start Date</span>
                <span>End Date</span>
                <span>Status</span>
                <p>
                <label for="start_date"></label>
                <input type="date" name="start_date" value="<?php echo $row['start_date'];?>" required>
            
                <label for="end_date"></label>
                <input type="date" name="end_date" value="<?php echo $row['end_date'];?>">
    
                <label for="status"></label>
                <select name="status" id="" required <?php if($_SESSION['role'] != 'ADMIN'){ ?> readonly <?php } ?>>
                            <option value="KEYED" <?php if($row['status'] == 'KEYED'){?>selected <?php } ?>>Keyed</option>
                <?php if($_SESSION['can_verify'] ==  1){?><option value="VERIFY" <?php if($row['status'] == 'VERIFY'){?>selected <?php } ?>>Verify</option>
                <option value="UNVERIFY" <?php if($row['status'] == 'UNVERIFY'){?>selected <?php } ?>>Unverify</option> <?php } ?>
            </select>
                </p>
            </div>
            <div style="height:100px;"></div>
            <div>
                <button type="submit" name="update_pos">Apply Changes</button>
            <?php if($row['status'] != 'VERIFY'){ ?><a href="./Positions/Registration/Delete?id="<?php echo $row['id']?>> <button style = "background-color:#eb0b4e;"  name="delete_pos"> Delete</button></a> <?php } ?>
 
            </div>
        </form>
        <div>
        <a href="./Positions" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
            
        </div>
    </div>

<?php
    include_once __DIR__."/footer.php";
?>