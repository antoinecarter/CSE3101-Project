
<?php
    include __DIR__."/header.php";
    $addresscontroller = new AddressController();
    if(isset($_POST['update_address'])){
        $cred = $addresscontroller->updateaddress();
    }else if (isset($_POST['delete_address'])){
        $cred = $addresscontroller->deleteaddress();
    }
    $statement = $addresscontroller->viewaddress();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
?>