<?php

include_once __DIR__ . "/../model/tables/lateness.php";
include_once __DIR__ . "/../alert.php";

class LatenessController extends Lateness
{
    private $latenessModel;
    public $message;

    public function __construct()
    {
        $this->latenessModel = new Lateness();
    }

    public function tbllateness()
    {
        include_once __DIR__ . "/../view/tbllateness.php";
    }

    public function frmlateness()
    {
        include_once __DIR__ . "/../view/frmlateness.php";
    }

    public function edtlateness()
    {
        include_once __DIR__ . "/../view/edtlateness.php";
    }

    public function dellateness(){
        include_once __DIR__ . "/../view/delete.php";
    }

    public function createlateness()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "GET") {
            include_once __DIR__ . "/../view/frmlateness.php";
        } else {
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
            if (empty($_POST['shift_id'])) {
                $message = 'Please input shift id';
                return $message;
            }

            if (empty($_POST['shift_hours'])) {
                $message = 'Please input shift hours';
                return $message;
            }

            if (empty($_POST['timeclock_id'])) {
                $message = 'Please input timeclock id';
                return $message;
            }

            if (empty($_POST['min_time_in'])) {
                $message = 'Please input min_time_in';
                return $message;
            }

            if (empty($_POST['hours_deducted'])) {
                $message = 'Please input hours deducted';
                return $message;
            }

            $new_lateness = new Lateness();
            $new_lateness->set_org_id($_POST['org_id']);
            $new_lateness->set_emp_id($_POST['emp_id']);
            $new_lateness->set_work_date($_POST['work_date']);
            $new_lateness->set_shift_id($_POST['shift_id']);
            $new_lateness->set_shift_hours($_POST['shift_hours']);
            $new_lateness->set_timeclock_id($_POST['timeclock_id']);
            $new_lateness->set_min_time_in($_POST['min_time_in']);
            $new_lateness->set_hours_deducted($_POST['hours_deducted']);
            $new_lateness->create();

            $message = 'lateness Created';
            return $message;

    }
    }

    public function deletelateness()
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
                $statement = $this->latenessModel->getLatenessById($id);
                $dellateness = $statement->fetch(PDO::FETCH_ASSOC);
                if ($dellateness['id'] != $_SESSION['id']) {
                    if (($dellateness['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                        $message = $this->latenessModel->delete($id);
                        $this->dellateness();
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

    public function viewlateness()
    {
        
        $url = $_SERVER['REQUEST_SCHEME'] . '://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];

        $url_components = parse_url($url);
        if(isset($url_components['query'])){
            parse_str($url_components['query'], $params);
        };
        $id = $params['id'];
        $lateness = $this->latenessModel->getLatenessById($id);
        return $lateness;
    }

    public function viewlatenesss()
    {
        $id =  $_SESSION['emp_no'];
        $role = $_SESSION['role'];
        $statement = $this->latenessModel->view($role, $id);
        return $statement;
    
    }

    public function updatelateness()
    {
    
            $update_lateness = new Lateness();
            $d = array(
                'id'            => $_REQUEST['id'],
                'org_id'        => $_REQUEST['org_id'],
                'work_date'    => $_REQUEST['work_date'],
                'shift_id'        => $_REQUEST['shift_id'],
                'shift_hours'            => $_REQUEST['shift_hours'],
                'emp_id'        => $_REQUEST['emp_id'],
                'timeclock_id'        => $_REQUEST['timeclock_id'],
                'min_time_in'        => $_REQUEST['min_time_in'],
                'hours_deducted'        => $_REQUEST['hours_deducted']

            );
            $message = $update_lateness->update($d['id'], $d);
            include_once __DIR__ . "/../view/edtlateness.php";
            return $message;
        }

        public function latenessAndAbsenceDashboard($role, $user){
            $list = $this->latenessModel->latenessAndAbsenceDash($role, $user);
            return $list;
        }
    
}
?>