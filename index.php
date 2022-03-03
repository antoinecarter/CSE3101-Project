<?php
require_once __DIR__ . "/inc/model/Database.php";
$db = new Database();
$db->init();

require_once __DIR__ . "/inc/controller/Userscontroller.php";
require_once __DIR__ . "/inc/controller/absencecontroller.php";
require_once __DIR__ . "/inc/controller/addresscontroller.php";
require_once __DIR__ . "/inc/controller/attendancecontroller.php";
require_once __DIR__ . "/inc/controller/compyearcontroller.php";
require_once __DIR__ . "/inc/controller/departmentscontroller.php";
require_once __DIR__ . "/inc/controller/worklocationscontroller.php";
require_once __DIR__ . "/inc/controller/unitscontroller.php";
require_once __DIR__ . "/inc/controller/timeclockcontroller.php";
require_once __DIR__ . "/inc/controller/shiftscontroller.php";
require_once __DIR__ . "/inc/controller/referencescontroller.php";
require_once __DIR__ . "/inc/controller/natidentifierscontroller.php";
require_once __DIR__ . "/inc/controller/salarycontroller.php";
require_once __DIR__ . "/inc/controller/positionscontroller.php";
require_once __DIR__ . "/inc/controller/organizationcontroller.php";
require_once __DIR__ . "/inc/controller/orgstructurecontroller.php";
require_once __DIR__ . "/inc/controller/leavereqcontroller.php";
require_once __DIR__ . "/inc/controller/leavetrackcontroller.php";
require_once __DIR__ . "/inc/controller/leaveentcontroller.php";
require_once __DIR__ . "/inc/controller/latenesscontroller.php";
require_once __DIR__ . "/inc/controller/individualscontroller.php";
require_once __DIR__ . "/inc/controller/employeescontroller.php";

require_once __DIR__. "/inc/view/inc.php";

$params = ['parent_id' => '', 'id' => ''];

$path = $_SERVER["REQUEST_URI"];
$url = $_SERVER['REQUEST_SCHEME'] . '://';
$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];

$url_components = parse_url($url);
if(isset($url_components['query'])){
    parse_str($url_components['query'], $params);
}

if ($path == "/CSE3101-Project/"){
    $usercontroller->log();
} else if ($path == "/CSE3101-Project/home"){
    if(isset($_SESSION['id'])){
        $usercontroller->home();
    }
} else if ($path == "/CSE3101-Project/Users"){
    if(isset($_SESSION['id'])){
        $usercontroller->tblusers();
    }
} else if ($path == "/CSE3101-Project/Users/Registration"){
    if(isset($_SESSION['id'])){
        $usercontroller->frmusers();
    }
} else if($path == ('/CSE3101-Project/Users/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if(($_SESSION['id'] == $params['id']) || ($_SESSION['role'] == 'ADMIN')){
            $usercontroller->edtusers();
        }
    }


} else if($path == "/CSE3101-Project/Attendance"){
    if(isset($_SESSION['id'])){
        $attendancecontroller->tblattendance();
    }
} else if ($path == "/CSE3101-Project/Attendance/Registration"){
    if(isset($_SESSION['id'])){
        $attendancecontroller->frmattendance();
    }
} else if($path == ('/CSE3101-Project/Attendance/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if(($_SESSION['role'] == 'ADMIN')){
            $attendancecontroller->edtattendance();
        }
    }

} else if($path == "/CSE3101-Project/Absence"){
    if(isset($_SESSION['id'])){
        $absencecontroller->tblabsence();
    }
} else if ($path == "/CSE3101-Project/Absence/Registration"){
    if(isset($_SESSION['id'])){
        $absencecontroller->frmabsence();
    }
} else if($path == ('/CSE3101-Project/Absence/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $absencecontroller->edtabsence();
        }
    }

} else if($path == "/CSE3101-Project/Address"){
    if(isset($_SESSION['id'])){
        $addresscontroller->tbladdress();
    }
} else if ($path == "/CSE3101-Project/Address/Registration"){
    if(isset($_SESSION['id'])){
        $addresscontroller->frmaddress();
    }
} else if($path == ("/CSE3101-Project/Address/Registration/Edit?parent_id=".$params['parent_id']."&id=".$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $addresscontroller->edtaddress();
        }
    }


} else if($path == "/CSE3101-Project/Compyear"){
    if(isset($_SESSION['id'])){
        $compyearcontroller->tblcompy();
    }
} else if ($path == "/CSE3101-Project/Compyear/Registration"){
    if(isset($_SESSION['id'])){
        $compyearcontroller->frmcompy();
    }
} else if($path == ('/CSE3101-Project/Compyear/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $compyearcontroller->edtcompy();
        }
    }

    

} else if($path == "/CSE3101-Project/Individuals"){
    if(isset($_SESSION['id'])){
        $individualscontroller->tblindividuals();
    }
} else if ($path == "/CSE3101-Project/Individuals/Registration"){
    if(isset($_SESSION['id'])){
        $individualscontroller->frmindividuals();
    }
} else if($path == ('/CSE3101-Project/Individuals/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $individualscontroller->edtindividuals();
        }
    }

} else if($path == "/CSE3101-Project/Lateness"){
    if(isset($_SESSION['id'])){
        $latenesscontroller->tbllateness();
    }
} else if ($path == "/CSE3101-Project/Lateness/Registration"){
    if(isset($_SESSION['id'])){
        $latenesscontroller->frmlateness();
    }
} else if($path == ('/CSE3101-Project/Lateness/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $latenesscontroller->edtlateness();
        }
    }
    

} else if($path == "/CSE3101-Project/Leavetrack"){
    if(isset($_SESSION['id'])){
        $leavetrackcontroller->tblleavetrack();
    }
} else if ($path == "/CSE3101-Project/Leavetrack/Registration"){
    if(isset($_SESSION['id'])){
        $leavetrackcontroller->frmleavetrack();
    }
} else if($path == ('/CSE3101-Project/Leavetrack/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $leavetrackcontroller->edtleavetrack();
        }
    }


} else if($path == "/CSE3101-Project/NationalIdentifier"){
    if(isset($_SESSION['id'])){
        $nationalidentifierscontroller->tblnationalidentifiers();
    }
} else if ($path == "/CSE3101-Project/NationalIdentifier/Registration"){
    if(isset($_SESSION['id'])){
        $nationalidentifierscontroller->frmnationalidentifiers();
    }
} else if($path == ('/CSE3101-Project/NationalIdentifier/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $nationalidentifierscontroller->edtnationalidentifiers();
        }
    }


} else if($path == "/CSE3101-Project/Orgstructure"){
    if(isset($_SESSION['id'])){
        $orgstructurecontroller->tblorgstructure();
    }
} else if ($path == "/CSE3101-Project/Orgstructure/Registration"){
    if(isset($_SESSION['id'])){
        $orgstructurecontroller->frmorgstructure();
    }
} else if($path == ('/CSE3101-Project/Orgstructure/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $orgstructurecontroller->edtorgstructure();
        }
    }

    

} else if($path == "/CSE3101-Project/Units"){
    if(isset($_SESSION['id'])){
        $unitscontroller->tblunits();
    }
} else if ($path == "/CSE3101-Project/Units/Registration"){
    if(isset($_SESSION['id'])){
        $unitscontroller->frmunits();
    }
} else if($path == ('/CSE3101-Project/Units/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $unitscontroller->edtunits();
        }
    }

    

} else if($path == "/CSE3101-Project/Timeclocks"){
    if(isset($_SESSION['id'])){
        $timeclockscontroller->tbltimeclocks();
    }
} else if ($path == "/CSE3101-Project/Timeclocks/Registration"){
    if(isset($_SESSION['id'])){
        $timeclockscontroller->frmtimeclocks();
    }
} else if($path == ('/CSE3101-Project/Timeclocks/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $timeclockscontroller->edttimeclocks();
        }
    }

    

} else if($path == "/CSE3101-Project/Organizations"){
    if(isset($_SESSION['id'])){
        $organizationscontroller->tblorganizations();
    }
} else if ($path == "/CSE3101-Project/Organizations/Registration"){
    if(isset($_SESSION['id'])){
        $organizationscontroller->frmorganizations();
    }
} else if($path == ('/CSE3101-Project/Organizations/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $organizationscontroller->edtorganizations();
        }
    }

    

} else if($path == "/CSE3101-Project/Positions"){
    if(isset($_SESSION['id'])){
        $positionscontroller->tblpositions();
    }
} else if ($path == "/CSE3101-Project/Positions/Registration"){
    if(isset($_SESSION['id'])){
        $positionscontroller->frmpositions();
    }
} else if($path == ('/CSE3101-Project/Positions/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $positionscontroller->edtpositions();
        }
    }

    

} else if($path == "/CSE3101-Project/References"){
    if(isset($_SESSION['id'])){
        $referencescontroller->tblreferences();
    }
} else if ($path == "/CSE3101-Project/References/Registration"){
    if(isset($_SESSION['id'])){
        $referencescontroller->frmreferences();
    }
} else if($path == ('/CSE3101-Project/References/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $referencescontroller->edtreferences();
        }
    }

    

} else if($path == "/CSE3101-Project/Salary"){
    if(isset($_SESSION['id'])){
        $salarycontroller->tblsalary();
    }
} else if ($path == "/CSE3101-Project/Salary/Registration"){
    if(isset($_SESSION['id'])){
        $salarycontroller->frmsalary();
    }
} else if($path == ('/CSE3101-Project/Salary/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $salarycontroller->edtsalary();
        }
    }

    

} else if($path == "/CSE3101-Project/Shifts"){
    if(isset($_SESSION['id'])){
        $shiftscontroller->tblshifts();
    }
} else if ($path == "/CSE3101-Project/Shifts/Registration"){
    if(isset($_SESSION['id'])){
        $shiftscontroller->frmshifts();
    }
} else if($path == ('/CSE3101-Project/Shifts/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $shiftscontroller->edtshifts();
        }
    }

    

} else if($path == "/CSE3101-Project/Worklocations"){
    if(isset($_SESSION['id'])){
        $worklocationscontroller->tblworklocations();
    }
} else if ($path == "/CSE3101-Project/Worklocations/Registration"){
    if(isset($_SESSION['id'])){
        $worklocationscontroller->frmworklocations();
    }
} else if($path == ('/CSE3101-Project/Worklocations/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $worklocationscontroller->edtworklocations();
        }
    }

    

} else if($path == "/CSE3101-Project/Leaverequests"){
    if(isset($_SESSION['id'])){
        $leaverequestscontroller->tblleaverequests();
    }
} else if ($path == "/CSE3101-Project/Leaverequests/Registration"){
    if(isset($_SESSION['id'])){
        $leaverequestscontroller->frmleaverequests();
    }
} else if($path == ('/CSE3101-Project/Leaverequests/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $leaverequestscontroller->edtleaverequests();
        }
    }

    

} else if($path == "/CSE3101-Project/Leaveentitlemt"){
    if(isset($_SESSION['id'])){
        $leaveentitlemtcontroller->tblleaveentitlemt();
    }
} else if ($path == "/CSE3101-Project/Leaveentitlemt/Registration"){
    if(isset($_SESSION['id'])){
        $leaveentitlemtcontroller->frmleaveentitlemt();
    }
} else if($path == ('/CSE3101-Project/Leaveentitlemt/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $leaveentitlemtcontroller->edtleaveentitlemt();
        }
    }

    
    

} else if($path == "/CSE3101-Project/Employees"){
    if(isset($_SESSION['id'])){
        $employeescontroller->tblemployees();
    }
} else if ($path == "/CSE3101-Project/Employees/Registration"){
    if(isset($_SESSION['id'])){
        $employeescontroller->frmemployees();
    }
} else if($path == ('/CSE3101-Project/Employees/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $employeescontroller->edtemployees();
        }
    }
    
    

} else if($path == "/CSE3101-Project/Departments"){
    if(isset($_SESSION['id'])){
        $departmentscontroller->tbldepartments();
    }
} else if ($path == "/CSE3101-Project/Departments/Registration"){
    if(isset($_SESSION['id'])){
        $departmentscontroller->frmdepartments();
    }
} else if($path == ('/CSE3101-Project/Departments/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if( ($_SESSION['role'] == 'ADMIN')){
            $departmentscontroller->edtdepartments();
        }
    }
} else if($path == ('')){
    
}
?>
