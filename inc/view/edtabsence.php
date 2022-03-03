
<?php
    include __DIR__."/header.php";
    $absencecontroller = new AbsenceController();
    if(isset($_POST['update_absence'])){
        $cred = $absencecontroller->updateabsence();
    }else if (isset($_POST['delete_absence'])){
        $cred = $absencecontroller->deleteabsence();
    }
    $statement = $absencecontroller->viewabsence();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
?>