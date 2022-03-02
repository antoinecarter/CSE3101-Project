<?php

include_once __DIR__ . "/../model/tables/address.php";
include_once __DIR__ . "/../alert.php";

class AddressController extends Address
{
    private $addressModel;
    public $message;

    public function __construct()
    {
        $this->addressModel = new Address();
    }

    public function tbladdress()
    {
        include_once __DIR__ . "/../view/tbladdress.php";
    }

    public function frmaddress()
    {
        include_once __DIR__ . "/../view/frmaddress.php";
    }

    public function edtaddress()
    {
        include_once __DIR__ . "/../view/edtaddress.php";
    }

    public function deladdress(){
        include_once __DIR__ . "/../view/delete.php";
    }

    public function createaddress()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "GET") {
            include_once __DIR__ . "/../view/frmaddress.php";
        } else {
            if (empty($_POST['org_id'])) {
                $message = 'Please enter Organization ID';
                return $message;
            } 

            if (empty($_POST['ind_id'])) {
                $message = 'Please enter ind id';
                return $message;
            }

            if (empty($_POST['address_type'])) {
                $message = 'Please input address type';
                return $message;
            }
            
            if (empty($_POST['lot'])) {
                $message = 'Please input lot';
                return $message;
            }

            if (empty($_POST['address_line1'])) {
                $message = 'Please input address line1';
                return $message;
            }

            if (empty($_POST['address_line2'])) {
                $message = 'Please input address line2';
                return $message;
            }

            if (empty($_POST['address_line3'])) {
                $message = 'Please input address line3';
                return $message;
            }

            if (empty($_POST['country'])) {
                $message = 'Please input country';
                return $message;
            }

            if (empty($_POST['start_date'])) {
                $message = 'Please input start date';
                return $message;
            }

            if (empty($_POST['end_date'])) {
                $message = 'Please input end date';
                return $message;
            }

            $new_address = new Address();
            $new_address->set_org_id($_POST['org_id']);
            $new_address->set_ind_id($_POST['ind_id']);
            $new_address->set_address_type($_POST['address_type']);
            $new_address->set_lot($_POST['lot']);
            $new_address->set_address_line1($_POST['address_line1']);
            $new_address->set_address_line2($_POST['address_line2']);
            $new_address->set_address_line3($_POST['address_line3']);
            $new_address->set_country($_POST['country']);
            $new_address->set_start_date($_POST['start_date']);
            $new_address->set_end_date($_POST['end_date']);
            $new_address->create();

            $message = 'address Created';
            return $message;

    }
    }

    public function deleteaddress()
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
                $statement = $this->addressModel->getAddressById($id);
                $deladdress = $statement->fetch(PDO::FETCH_ASSOC);
                if ($deladdress['id'] != $_SESSION['id']) {
                    if (($deladdress['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                        $message = $this->addressModel->delete($id);
                        $this->deladdress();
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

    public function viewaddress()
    {
        
        $url = $_SERVER['REQUEST_SCHEME'] . '://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];

        $url_components = parse_url($url);
        if(isset($url_components['query'])){
            parse_str($url_components['query'], $params);
        };
        $id = $params['id'];
        $address = $this->addressModel->getAddressById($id);
        return $address;
    }

    public function viewaddresss()
    {
        $id =  $_SESSION['id'];
        $role = $_SESSION['role'];
        $statement = $this->addressModel->view($role, $id);
        return $statement;
    
    }

    public function updateaddress()
    {
    
            $update_address = new Address();
            $d = array(
                'id'            => $_REQUEST['id'],
                'org_id'        => $_REQUEST['org_id'],
                'ind_id'    => $_REQUEST['ind_id'],
                'address_type'    => $_REQUEST['address_type'],
                'lot'    => $_REQUEST['lot'],
                'address_line1'        => $_REQUEST['address_line1'],
                'address_line2'            => $_REQUEST['address_line2'],
                'address_line3'        => $_REQUEST['address_line3'],
                'country'        => $_REQUEST['country'],
                'start_date'        => $_REQUEST['start_date'],
                'end_date'        => $_REQUEST['end_date']

            );
            $message = $update_address->update($d['id'], $d);
            include_once __DIR__ . "/../view/edtaddress.php";
            return $message;
        }
    
}
?>