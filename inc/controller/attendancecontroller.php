<?php

include_once __DIR__ . "/../model/tables/attendance.php";
include_once __DIR__ . "/../alert.php";

class AttendanceController extends attendance
{
    private $attendanceModel;
    public $message;

    public function __construct()
    {
        $this->attendanceModel = new attendance();
    }

    public function tblattendance()
    {
        include_once __DIR__ . "/../view/tblattendance.php";
    }

    public function frmattendance()
    {
        include_once __DIR__ . "/../view/frmattendance.php";
    }

    public function edtattendance()
    {
        include_once __DIR__ . "/../view/edtattendance.php";
    }

    public function delattendance(){
        include_once __DIR__ . "/../view/delete.php";
    }

    public function createattendance()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "GET") {
            include_once __DIR__ . "/../view/frmattendance.php";
        } else {
            if (empty($_POST['first_name'])) {
                $message = 'Please enter First name';
                return $message;
            }

            if (empty($_POST['last_name'])) {
                $message = 'Please enter Last name';
                return $message;
            }

            if (empty($_POST['start_date'])) {
                $message = 'Please input date attented';
                return $message;
            }

            $new_attendance = new attendance();
            $new_attendance->set_fname($_POST['first_name']);
            $new_attendance->set_lname($_POST['last_name']);
            $new_attendance->set_start_date($_POST['start_date']);
            $new_attendance->create();
            $message = 'Attendance Created';
            return $message;
    }
    }

    public function deleteattendance()
    {
        {
            if ($_SERVER['REQUEST_METHOD'] = 'POST') {
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
    
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                }
                $id = $params['id'];
                $statement = $this->attendanceModel->getAttById($id);
                $delattendance = $statement->fetch(PDO::FETCH_ASSOC);
                if ($delattendance['id'] != $_SESSION['id']) {
                    if (($delattendance['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                        $message = $this->attendanceModel->delete($id);
                        $this->delattendance();
                        return $message;
                    } else {
                        $message = 'User is an Admin/You are not an Admin';
                        return $message;
                    }
                } else {
                    $message = 'Error! Cannot delete logged-in user';
                    return $message;
                }
            }
        }
    }

    public function viewattendance()
    {
        
        $url = $_SERVER['REQUEST_SCHEME'] . '://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];

        $url_components = parse_url($url);
        if(isset($url_components['query'])){
            parse_str($url_components['query'], $params);
        };
        $id = $params['id'];
        $attendance = $this->attendanceModel->getAttById($id);
        return $attendance;
    }

    public function viewattendances()
    {
        $id =  $_SESSION['id'];
        $role = $_SESSION['role'];
        $statement = $this->attendanceModel->view($role, $id);
        return $statement;
    
    }

    public function updateattendance()
    {
    
            $update_attendance = new attendance();
            $d = array(
                'id'            => $_REQUEST['id'],
                'org_id'        => $_REQUEST['org_id'],
                'first_name'     => $_REQUEST['first_name'],
                'last_name'     => $_REQUEST['last_name'],
                'start_date'    => $_REQUEST['start_date'],
                'role'            => $_REQUEST['role'],
                'emp_no'        => $_REQUEST['emp_no']

            );
            $message = $update_attendance->update($d['id'], $d);
            include_once __DIR__ . "/../view/edtattendance.php";
            return $message;
        }
    
}
?>