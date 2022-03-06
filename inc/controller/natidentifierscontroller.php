<?php

include_once __DIR__ . "/../model/tables/natidentifiers.php";
include_once __DIR__ . "/../alert.php";

class NationalidentifiersController extends NationalIdentifier
{
    private $nationalidentifiersModel;
    public $message;

    public function __construct()
    {
        $this->nationalidentifiersModel = new NationalIdentifier();
    }

    public function tblnationalidentifiers()
    {
        include_once __DIR__ . "/../view/tblnationalidentifiers.php";
    }

    public function frmnationalidentifiers()
    {
        include_once __DIR__ . "/../view/frmnationalidentifiers.php";
    }

    public function edtnationalidentifiers()
    {
        include_once __DIR__ . "/../view/edtnationalidentifiers.php";
    }

    public function delnationalidentifiers(){
        include_once __DIR__ . "/../view/delete.php";
    }

    public function createnationalidentifiers()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "GET") {
            include_once __DIR__ . "/../view/frmnationalidentifiers.php";
        } else {
            if (empty($_POST['org_id'])) {
                $message = 'Please enter Organization ID';
                return $message;
            }  

            if (empty($_POST['ind_id'])) {
                $message = 'Please enter ind_id';
                return $message;
            }

            if (empty($_POST['identifier'])) {
                $message = 'Please input identifier';
                return $message;
            }
            if (empty($_POST['identifier_num'])) {
                $message = 'Please input identifier_num';
                return $message;
            }

            if (empty($_POST['start_date'])) {
                $message = 'Please input start Date';
                return $message;
            }

            $new_nationalidentifiers = new NationalIdentifier();
            $new_nationalidentifiers->set_org_id($_POST['org_id']);
            $new_nationalidentifiers->set_ind_id($_POST['ind_id']);
            $new_nationalidentifiers->set_identifier($_POST['identifier']);
            $new_nationalidentifiers->set_identifier_num($_POST['identifier_num']);
            $new_nationalidentifiers->set_start_date($_POST['start_date']);
            $new_nationalidentifiers->set_end_date($_POST['end_date']);
            $new_nationalidentifiers->create();

            $message = 'nationalidentifiers Created';
            return $message;


    }
    }

    public function deletenationalidentifiers()
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
                $statement = $this->nationalidentifiersModel->getNatIdById($id);
                $delnationalidentifiers = $statement->fetch(PDO::FETCH_ASSOC);
                if ($delnationalidentifiers['id'] != $_SESSION['id']) {
                    if (($_SESSION['role'] != 'ADMIN') || ($_SESSION['can_delete'] == 1)) {
                        $message = $this->nationalidentifiersModel->delete($id);
                        $this->delnationalidentifiers($params);
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

    public function viewnationalidentifier()
    {
        
        $url = $_SERVER['REQUEST_SCHEME'] . '://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];

        $url_components = parse_url($url);
        if(isset($url_components['query'])){
            parse_str($url_components['query'], $params);
            $id = $params['id'];
        };
        
        $nationalidentifiers = $this->nationalidentifiersModel->getNatIdById($id);
        return $nationalidentifiers;
    }

    public function viewnationalidentifiers()
    {
        $id =  $_SESSION['emp_no'];
        $role = $_SESSION['role'];
        $statement = $this->nationalidentifiersModel->view($role, $id);
        return $statement;
    
    }

    public function updatenationalidentifiers()
    {
    
            $update_nationalidentifiers = new NationalIdentifier();
            $d = array(
                'id'            => $_REQUEST['id'],
                'org_id'        => $_REQUEST['org_id'],
                'start_date'    => $_REQUEST['start_date'],
                'end_date'        => $_REQUEST['end_date'],
                'ind_id'            => $_REQUEST['ind_id'],
                'identifier'        => $_REQUEST['identifier'],
                'identifier_num'        => $_REQUEST['identifier_num']

            );
            $message = $update_nationalidentifiers->update($d['id'], $d);
            include_once __DIR__ . "/../view/edtnationalidentifiers.php";
            return $message;
        }
    
}