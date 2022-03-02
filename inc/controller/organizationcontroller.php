<?php

        include_once __DIR__ . "/../model/tables/organization.php";
        include_once __DIR__ . "/../alert.php";
        
        class OrganizationsController extends Organization
        {
            private $organizationsModel;
            public $message;
        
            public function __construct()
            {
                $this->organizationsModel = new Organization();
            }
        

            public function tblorganizations()
            {
                include_once __DIR__ . "/../view/tblorganization.php";
            }
        
            public function frmorganizations()
            {
                include_once __DIR__ . "/../view/frmorganization.php";
            }
        
            public function edtorganizations()
            {
                include_once __DIR__ . "/../view/edtorganization.php";
            }
        
            public function delorganizations(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createorg()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmorganization.php";
                } else {
                    if (empty($_POST['org_type'])) {
                        $message = 'Please enter orginization type';
                        return $message;
                    }
        
                    if (empty($_POST['short_name'])) {
                        $message = 'Please input short name';
                        return $message;
                    }
        
        
                    if (empty($_POST['full_name'])) {
                        $message = 'Please input full name';
                        return $message;
                    }
        
        
                    if (empty($_POST['address'])) {
                        $message = 'Please input address';
                        return $message;
                    }
        
        
                    if (empty($_POST['telephone'])) {
                        $message = 'Please input telephone';
                        return $message;
                    }
        
        
                    if (empty($_POST['fax'])) {
                        $message = 'Please input fax';
                        return $message;
                    }
        
        
                    if (empty($_POST['email'])) {
                        $message = 'Please input email';
                        return $message;
                    }
        
        
                    if (empty($_POST['country'])) {
                        $message = 'Please input country';
                        return $message;
                    }
        
        
                    if (empty($_POST['end_date'])) {
                        $message = 'Please input end date';
                        return $message;
                    }
        
        
                    if (empty($_POST['start_date'])) {
                        $message = 'Please input date start date';
                        return $message;
                    }
        
        
                    if (empty($_POST['status'])) {
                        $message = 'Please input status';
                        return $message;
                    }
        
                    $new_organizations = new Organization();
                    $new_organizations->set_org_type($_POST['org_type']);
                    $new_organizations->set_short_name($_POST['short_name']);
                    $new_organizations->set_full_name($_POST['full_name']);
                    $new_organizations->set_address($_POST['address']);
                    $new_organizations->set_telephone($_POST['telephone']);
                    $new_organizations->set_fax($_POST['fax']);
                    $new_organizations->set_email($_POST['email']);
                    $new_organizations->set_country($_POST['country']);
                    $new_organizations->set_end_date($_POST['end_date']);
                    $new_organizations->set_start_date($_POST['start_date']);
                    $new_organizations->set_status($_POST['status']);
                    $new_organizations->create();
                    $message = 'Organiztion Created';
                    return $message;

            }
            }
        
            public function deleteorg()
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
                        $statement = $this->organizationsModel->getOrgById($id);
                        $delorg = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delorg['id'] != $_SESSION['id']) {
                            if (($delorg['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->organizationsModel->delete($id);
                                $this->delorganizations();
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
        
            public function vieworg()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $organizations = $this->organizationsModel->getOrgById($id);
                return $organizations;
            }
        
            public function vieworgs()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->organizationsModel->view($role, $id);
                return $statement;
            
            }
        
            public function updateorg()
            {
            
                    $update_org = new Organization();
                    $d = array(
                        'org_type'            => $_REQUEST['org_type'],
                        'short_name'        => $_REQUEST['short_name'],
                        'full_name'     => $_REQUEST['full_name'],
                        'address'     => $_REQUEST['address'],
                        'telephone'    => $_REQUEST['telephone'],
                        'fax'            => $_REQUEST['fax'],
                        'email'            => $_REQUEST['email'],
                        'country'            => $_REQUEST['country'],
                        'end_date'            => $_REQUEST['end_date'],
                        'start_date'            => $_REQUEST['start_date'],
                        'status'        => $_REQUEST['status']
        
                    );
                    $message = $update_org->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtorganization.php";
                    return $message;
                }
            
        }
        ?>