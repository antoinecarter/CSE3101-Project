<?php

include_once __DIR__ . "/../model/tables/orgstructure.php";
include_once __DIR__ . "/../alert.php";

class OrgstructureController extends Orgstructure
{
    private $orgstructureModel;
    public $message;

    public function __construct()
    {
        $this->orgstructureModel = new Orgstructure();
    }

    public function tblorgstructure()
    {
        include_once __DIR__ . "/../view/tblorgstructure.php";
    }

    public function frmorgstructure()
    {
        include_once __DIR__ . "/../view/frmorgstructure.php";
    }

    public function edtorgstructure()
    {
        include_once __DIR__ . "/../view/edtorgstructure.php";
    }

    public function delorgstructure(){
        include_once __DIR__ . "/../view/delete.php";
    }

    public function createorgstructure()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "GET") {
            include_once __DIR__ . "/../view/frmorgstructure.php";
        } else {
            if (empty($_POST['org_id'])) {
                $message = 'Please enter Organization ID';
                return $message;
            }

            if (empty($_POST['org_struct_name'])) {
                $message = 'Please enter org_struct_name';
                return $message;
            }

            if (empty($_POST['end_date'])) {
                $message = 'Please input end date';
                return $message;
            }
            if (empty($_POST['status'])) {
                $message = 'Please input status';
                return $message;
            }

            if (empty($_POST['start_date'])) {
                $message = 'Please input start Date';
                return $message;
            }

            $new_orgstructure = new Orgstructure();
            $new_orgstructure->set_org_id($_POST['org_id']);
            $new_orgstructure->set_org_struct_name($_POST['org_struct_name']);
            $new_orgstructure->set_end_date($_POST['end_date']);
            $new_orgstructure->set_status($_POST['status']);
            $new_orgstructure->set_start_date($_POST['start_date']);
            $new_orgstructure->create();

            $message = 'orgstructure Created';
            return $message;
    
    }
    }

    public function deleteorgstructure()
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
                $statement = $this->orgstructureModel->getOrgStructById($id);
                $delorgstructure = $statement->fetch(PDO::FETCH_ASSOC);
                if ($delorgstructure['id'] != $_SESSION['id']) {
                    if (($delorgstructure['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                        $message = $this->orgstructureModel->delete($id);
                        $this->delorgstructure();
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

    public function vieworgstructure()
    {
        
        $url = $_SERVER['REQUEST_SCHEME'] . '://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];

        $url_components = parse_url($url);
        if(isset($url_components['query'])){
            parse_str($url_components['query'], $params);
        };
        $id = $params['id'];
        $orgstructure = $this->orgstructureModel->getOrgStructById($id);
        return $orgstructure;
    }

    public function vieworgstructures()
    {
        $id =  $_SESSION['id'];
        $role = $_SESSION['role'];
        $statement = $this->orgstructureModel->view($role, $id);
        return $statement;
    
    }

    public function updateorgstructure()
    {
    
            $update_orgstructure = new Orgstructure();
            $d = array(
                'id'            => $_REQUEST['id'],
                'org_id'        => $_REQUEST['org_id'],
                'org_struct_name'    => $_REQUEST['org_struct_name'],
                'end_date'        => $_REQUEST['end_date'],
                'status'            => $_REQUEST['status'],
                'start_date'        => $_REQUEST['start_date']

            );
            $message = $update_orgstructure->update($d['id'], $d);
            include_once __DIR__ . "/../view/edtorgstructure.php";
            return $message;
        }
    
}
?>