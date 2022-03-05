<?php

include_once __DIR__ . "/../model/tables/leavetrack.php";
include_once __DIR__ . "/../alert.php";

class LeavetrackController extends LeaveTrack
{
    private $leavetrackModel;
    public $message;

    public function __construct()
    {
        $this->leavetrackModel = new LeaveTrack();
    }

    public function tblleavetrack()
    {
        include_once __DIR__ . "/../view/tblleavetrack.php";
    }

    public function frmleavetrack()
    {
        include_once __DIR__ . "/../view/frmleavetrack.php";
    }

    public function edtleavetrack()
    {
        include_once __DIR__ . "/../view/edtleavetrack.php";
    }

    public function delleavetrack(){
        include_once __DIR__ . "/../view/delete.php";
    }

    public function createleavetrack()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "GET") {
            include_once __DIR__ . "/../view/frmleavetrack.php";
        } else {
            if (empty($_POST['org_id'])) {
                $message = 'Please enter Organization ID';
                return $message;
            } 

            if (empty($_POST['emp_id'])) {
                $message = 'Please enter Employee ID';
                return $message;
            }

            if (empty($_POST['comp_year_id'])) {
                $message = 'Please input comp_year_id';
                return $message;
            }


            if (empty($_POST['leave_type'])) {
                $message = 'Please input leave type';
                return $message;
            }

            $new_leavetrack = new LeaveTrack();
            $new_leavetrack->set_org_id($_POST['org_id']);
            $new_leavetrack->set_emp_id($_POST['emp_id']);
            $new_leavetrack->set_comp_year_id($_POST['comp_year_id']);
            $new_leavetrack->set_leave_ent_id($_POST['leave_ent_id']);
            $new_leavetrack->set_leave_req_id($_POST['leave_req_id']);
            $new_leavetrack->set_leave_type($_POST['leave_type']);
            $new_leavetrack->set_entitled_days($_POST['entitled_days']);
            $new_leavetrack->set_leave_earned($_POST['leave_earned']);
            $new_leavetrack->set_leave_used($_POST['leave_used']);
            $new_leavetrack->create();

            $message = 'leavetrack Created';
            return $message;

    }
    }

    public function deleteleavetrack()
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
                $statement = $this->leavetrackModel->getleavetracksById($id);
                $delleavetrack = $statement->fetch(PDO::FETCH_ASSOC);
                if ($delleavetrack['id'] != $_SESSION['id']) {
                    if (($delleavetrack['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                        $message = $this->leavetrackModel->delete($id);
                        $this->delleavetrack();
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

    public function viewleavetrack()
    {
        
        $url = $_SERVER['REQUEST_SCHEME'] . '://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];

        $url_components = parse_url($url);
        if(isset($url_components['query'])){
            parse_str($url_components['query'], $params);
        };
        $id = $params['id'];
        $leavetrack = $this->leavetrackModel->getleavetracksById($id);
        return $leavetrack;
    }

    public function viewleavetracks()
    {
        $id =  $_SESSION['id'];
        $role = $_SESSION['role'];
        $statement = $this->leavetrackModel->view($role, $id);
        return $statement;
    
    }

    public function updateleavetrack()
    {
    
            $update_leavetrack = new LeaveTrack();
            $d = array(
                'id'            => $_REQUEST['id'],
                'org_id'        => $_REQUEST['org_id'],
                'comp_year_id'    => $_REQUEST['comp_year_id'],
                'leave_ent_id'        => $_REQUEST['leave_ent_id'],
                'leave_req_id'            => $_REQUEST['leave_req_id'],
                'emp_id'        => $_REQUEST['emp_id'],
                'leave_type'        => $_REQUEST['leave_type'],
                'entitled_days'        => $_REQUEST['entitled_days'],
                'leave_earned'        => $_REQUEST['leave_earned'],
                'leave_used'        => $_REQUEST['leave_used']

            );
            $message = $update_leavetrack->update($d['id'], $d);
            include_once __DIR__ . "/../view/edtleavetrack.php";
            return $message;
        }
    
}
?>