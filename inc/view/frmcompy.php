<?php
include __DIR__ . "/header.php";
$compyearcontroller = new CompyearController();
if (isset($_POST['create_compyr'])) {
    $cred = $compyearcontroller->createcompyr();
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
        <h2>Create new Company Year</h2>
          
        </div>
        <div>
                 <p>
            <label for="id"></label>
            <input type="hidden" name="id">
            </p>
            <span>Organization Id</span>
            <span>Year</span>
        <p>
            <label for="org_id"></label>
            <input type="text" placeholder=" Enter Organization" name="org_id">

            <label for="year"></label>
            <input type="date" name="year" required>
            </p>
            <span>Start Year</span>
            <span>End Year</span>
            <p>
            <label for="start_year"></label>
            <input type="date" name="start_year" required>
        
            <label for="end_year"></label>
            <input type="date" name="end_year">
            </p>
            <span>Payment Frequency</span> 
            <p>
            <label for="payment_frequency"></label>
            <select name="payment_frequency" id="" required>
          
                <option value="1">Yes</option>
                <option value="0">No</option>
        
            </select>

            </p>
            </p>    
   

      <?php if($_SESSION['role']=='ADMIN'){ ?><button type="submit" name="create_compyr">Create</button> <?php } ?>

      </p>
  
        </div>
        
    </form>
    <div>
    <a href="./Compyear" > <button style = "background-color:#0b74eb; margin-top:0px;">Return</button></a>
        
    </div>
</div>

<?php
include_once __DIR__ . "/footer.php";
?>