<?php

    
        include_once __DIR__ . "/../model/tables/worklocations.php";
        include_once __DIR__ . "/../alert.php";
        
        class WorklocationsController extends worklocations
        {
            private $worklocationsModel;
            public $message;
        
            public function __construct()
            {
                $this->worklocationsModel = new worklocations();
            }
        

            public function tblworklocations()
            {
                include_once __DIR__ . "/../view/tblworklocations.php";
            }

            public function frmworklocations()
            {
                include_once __DIR__ . "/../view/frmworklocations.php";
            }

            public function edtworklocations()
            {
                include_once __DIR__ . "/../view/edtworklocations.php";
            }

            public function delworklocations(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createworkl()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmworklocations.php";
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
                        $message = 'Please input date ';
                        return $message;
                    }
        
                    $new_worklocations = new worklocations();
                    $new_worklocations->set_fname($_POST['first_name']);
                    $new_worklocations->set_lname($_POST['last_name']);
                    $new_worklocations->set_start_date($_POST['start_date']);
                    $new_worklocations->create();
                    $message = 'worklocations Created';
                    return $message;
            }
            }
        
            public function deleteworkl()
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
                        $statement = $this->worklocationsModel->getWorklById($id);
                        $delworkl = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delworkl['id'] != $_SESSION['id']) {
                            if (($delworkl['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->worklocationsModel->delete($id);
                                $this->delworkl();
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
        
            public function viewworkl()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $worklocations = $this->worklocationsModel->getWorklById($id);
                return $worklocations;
            }
        
            public function viewworkls()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->worklocationsModel->view($role, $id);
                return $statement;
            
            }
        
            public function updateworkl()
            {
            
                    $update_workl = new worklocations();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no']
        
                    );
                    $message = $update_workl->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtworklocations.php";
                    return $message;
                }
            
        }
        ?>