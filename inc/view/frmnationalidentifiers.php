<?php
include __DIR__ . "/header.php";
$nationalidentifierscontroller = new NationalidentifiersController();
if (isset($_POST['create_nationalidentifiers'])) {
    $cred = $nationalidentifierscontroller->createnationalidentifiers();
}
?>
<div class = "form-usr">
<?php if(isset($cred)){ 
  ?>
  <div class = "exist" > <?php echo $cred; ?> </div>
  <?php } 
  ?>
    <form method="post" action="">
        <div>
        <h2>Create new National Identifier</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span>Organization Id</span>
            <span>Individual Id</span>
        <p>
            <label for="org_id"></label>
            <input type="text" placeholder=" Enter Organization" name="org_id">
           
            <label for="ind_id"></label>
            <input type="text" placeholder=" Enter Individual No." name="ind_id">
            </p>
            <span>Identifier</span>
            <span>Identifier No.</span> 
            <p>
            <label for="identifier"></label>
            <input type="text" placeholder=" Enter Identifier" name="identifier">
        
            <label for="identifier_num"></label>
            <input type="text" placeholder=" Enter Identifier No." name="identifier_num">
            </p>
            <span>Start Date</span>
            <span>End Date</span>
            <p>
            <label for="start_date"></label>
            <input type="date" name="start_date" required>
        
            <label for="end_date"></label>
            <input type="date" name="end_date">
            </p>

            </p>
        
   

      <?php if($_SESSION['role']=='ADMIN'){ ?><button type="submit" name="create_nationalidentifiers">Create</button> <?php } ?>

      </p>
  
        </div>
        
    </form>
    <div>
    <a href="./NationalIdentifier" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>