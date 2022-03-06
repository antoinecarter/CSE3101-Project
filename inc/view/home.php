<?php
include __DIR__."/header.php";
?>


<div class="home" style = "margin-top: 100px;">
    <h1>Human Resources Dashboard</h1>

    <div class="wrapper">
        <a class="box-e" href ="./Individuals"><div><div>Individual</div> <div>Individuals lists all persons involved with the organization</div></div></a>
        <a class="box-e" href ="./Employees"><div><div>Employee</div> <div>Employees are the backbone of the organization. Ensure their details are kept up to date</div></div></a>
        <a class="box-e" href ="./Address"><div><div> Address</div> <div>See listing of addresses</div></div></a>
        <a class="box-e" href ="./NationalIdentifier"><div><div>National Identifiers</div> <div>Set up your PINs. Eg. TIN, National ID, NIS, etc</div></div></a>
        <a class="box-e" href ="./Leaveentitlemt"><div><div>Leave Entitlement</div> <div>Clock in and Clock out your daily timings</div></div></a>
        <a class="box-e" href ="./Leavetrack"><div><div>Leave</div> <div>See the leave available to the employees</div></div></a>
        <a class="box-e" href ="./Leaverequests"><div><div>Leave Request</div> <div>Clock in and Clock out your daily timings</div></div></a>
        <a class="box-e" href ="./Timeclocks"><div><div>Timeclock</div> <div>Clock in and Clock out your daily timings</div></div></a>
        <a class="box-e" href ="./Absence"><div><div>Absence</div> <div>See listing of employee absences</div></div></a>
        <a class="box-e" href ="./Lateness"><div><div>Lateness</div> <div>Clock in and Clock out your daily timings</div></div></a>
        <?php if($_SESSION['role']=='ADMIN'){ ?>
        <a class="box-e" href ="./Units"><div><div>Units</div> <div>Derive your units from the departments</div></div></a>
        <a class="box-e" href ="./Positions"><div><div>Positions</div> <div>Create positions and attach them to units</div></div></a>
        <a class="box-e" href ="./Shifts"><div><div>Shifts</div> <div>View shifts configured in the system</div></div></a>
        <a class="box-e" href ="./Departments"><div><div>Departments</div> <div>Outline the departments that your organization is split into</div></div></a>
        <a class="box-e" href ="./References"><div><div>References</div> <div>Create tables that are a point of reference for many List of Values</div></div></a>
            <?php } ?>

    </div>
</div>

<?php
    include __DIR__."/footer.php";
?>

