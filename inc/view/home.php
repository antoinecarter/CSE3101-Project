<?php
include __DIR__."/header.php";
?>


<div class="home" style = "margin-top: 100px;">
    <h1>Human Resources Dashboard</h1>

    <div class="wrapper">
        <a class="box-e" href ="./Individuals"><div><div class="title">Individual</div> <div class="content">Individuals lists all persons involved with the organization</div></div></a>
        <a class="box-e" href ="./Employees"><div><div class="title">Employee</div> <div class="content">Employees are the backbone of the organization. Ensure their details are kept up to date</div></div></a>
        <a class="box-e" href ="./Address"><div><div class="title"> Address</div> <div class="content">See listing of addresses</div></div></a>
        <a class="box-e" href ="./NationalIdentifier"><div><div class="title">National Identifiers</div> <div class="content">Set up your PINs. Eg. TIN, National ID, NIS, etc</div></div></a>
        <a class="box-e" href ="./Leaveentitlemt"><div><div class="title">Leave Entitlement</div> <div class="content">See what leaves are attached to employees, and their corresponding entitled days(if eligible)</div></div></a>
        <a class="box-e" href ="./Leavetrack"><div><div class="title">Leave</div> <div class="content">See the leave available to the employees</div></div></a>
        <a class="box-e" href ="./Leaverequests"><div><div class="title">Leave Request</div> <div class="content">Place a request for leave to be taken.</div></div></a>
        <a class="box-e" href ="./Timeclocks"><div><div class="title">Timeclock</div> <div class="content">Clock in and Clock out your daily timings</div></div></a>
        <a class="box-e" href ="./Absence"><div><div class="title">Absence</div> <div class="content">See listing of occurrences of Employee Absenteeism</div></div></a>
        <a class="box-e" href ="./Lateness"><div><div class="title">Lateness</div> <div class="content">See listing of occurrences of Employee Lateness</div></div></a>
        <?php if($_SESSION['role']=='ADMIN'){ ?>
        <a class="box-e" href ="./Units"><div><div class="title">Units</div> <div class="content">Derive your units from the departments</div></div></a>
        <a class="box-e" href ="./Positions"><div><div class="title">Positions</div> <div class="content">Create positions and attach them to units</div></div></a>
        <a class="box-e" href ="./Shifts"><div><div class="title">Shifts</div> <div class="content">View shifts configured in the system</div></div></a>
        <a class="box-e" href ="./Departments"><div><div class="title">Departments</div> <div class="content">Outline the departments that your organization is split into</div></div></a>
        <a class="box-e" href ="./References"><div><div class="title">References</div> <div class="content">Create tables that are a point of reference for many List of Values</div></div></a>
            <?php } ?>

    </div>
</div>

<?php
    include __DIR__."/footer.php";
?>

