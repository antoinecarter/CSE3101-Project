<?php

        include_once __DIR__ . "/../model/tables/organization.php";
        include_once __DIR__ . "/../alert.php";
        
        class OrganizationsController extends organizations
        {
            private $organizationsModel;
            public $message;
        
            public function __construct()
            {
                $this->organizationsModel = new organizations();
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
        
                    $new_organizations = new organizations();
                    $new_organizations->set_fname($_POST['first_name']);
                    $new_organizations->set_lname($_POST['last_name']);
                    $new_organizations->set_start_date($_POST['start_date']);
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
                                $this->delorg();
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
            
                    $update_org = new organizations();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no']
        
                    );
                    $message = $update_org->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtorganization.php";
                    return $message;
                }
            
        }
        ?>