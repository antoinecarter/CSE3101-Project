<?php

include_once __DIR__ . "/../model/tables/absence.php";
include_once __DIR__ . "/../model/tables/employees.php";
include_once __DIR__ . "/../model/tables/shifts.php";

include_once __DIR__ . "/../alert.php";

class AbsenceController extends Absence
{
    private $absenceModel;
    public $message;

    public function __construct()
    {
        $this->absenceModel = new Absence();
    }

    public function tblabsence()
    {
        include_once __DIR__ . "/../view/tblabsence.php";
    }

    public function frmabsence()
    {
        include_once __DIR__ . "/../view/frmabsence.php";
    }

    public function edtabsence()
    {
        include_once __DIR__ . "/../view/edtabsence.php";
    }

    public function delabsence(){
        include_once __DIR__ . "/../view/delete.php";
    }

    public function createabsence()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "GET") {
            include_once __DIR__ . "/../view/frmabsence.php";
        } else {

            if($this->absenceModel->verify($_POST['emp_id'], $_POST['work_date'])){
                $message = 'Existing absence record for employee at this date detected!';
                return $message;
            }
            
            if (empty($_POST['org_id'])) {
                $message = 'Please enter Organization ID';
                return $message;
            } 

            if (empty($_POST['emp_id'])) {
                $message = 'Please enter Employee ID';
                return $message;
            }

            if (empty($_POST['work_date'])) {
                $message = 'Please input work date';
                return $message;
            }

            if (empty($_POST['status'])) {
                $message = 'Please input status';
                return $message;
            }
            try{
            $emp = new Employee();
            $d = $emp->getEmpById($_POST['emp_id']);
            $data = $d->fetch(PDO::FETCH_ASSOC);

            $shift = new Shift();
            $d2 = $shift->getShiftById($data['shift_id']);
            $data2 = $d2->fetch(PDO::FETCH_ASSOC);
            $new_absence = new Absence();
            $new_absence->set_org_id($_POST['org_id']);
            $new_absence->set_emp_id($_POST['emp_id']);
            $new_absence->set_work_date($_POST['work_date']);
            $new_absence->set_shift_id($data['shift_id']);
            $new_absence->set_shift_hours($data2['shift_hours']);
            $new_absence->set_status($_POST['status']);
            $new_absence->create();
            }catch(PDOException $message){
                echo $message->getMessage();
            }
            $message = 'absence Created';
            return $message;
    }
    }

    public function deleteabsence()
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
                $statement = $this->absenceModel->getAbsenceById($id);
                $delabsence = $statement->fetch(PDO::FETCH_ASSOC);
                if ($delabsence['id'] != $_SESSION['id']) {
                    if (($delabsence['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                        $message = $this->absenceModel->delete($id);
                        $this->delabsence();
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

    public function viewabsence()
    {
        
        $url = $_SERVER['REQUEST_SCHEME'] . '://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];

        $url_components = parse_url($url);
        if(isset($url_components['query'])){
            parse_str($url_components['query'], $params);
        };
        $id = $params['id'];
        $absence = $this->absenceModel->getAbsenceById($id);
        return $absence;
    }

    public function viewabsences()
    {
        $id =  $_SESSION['emp_no'];
        $role = $_SESSION['role'];
        $statement = $this->absenceModel->view($role, $id);
        return $statement;
    
    }

    public function updateabsence()
    {
    
            $update_absence = new Absence();
            $d = array(
                'id'            => $_REQUEST['id'],
                'org_id'        => $_REQUEST['org_id'],
                'emp_id'    => $_REQUEST['emp_id'],
                'work_date'        => $_REQUEST['work_date'],
                'shift_id'            => $_REQUEST['shift_id'],
                'shift_hours'        => $_REQUEST['shift_hours'],
                'status'        => $_REQUEST['status']

            );
            $message = $update_absence->update($d['id'], $d);
            include_once __DIR__ . "/../view/edtabsence.php";
            return $message;
        }
    
}
?>