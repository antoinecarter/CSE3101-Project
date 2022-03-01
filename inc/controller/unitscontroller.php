<?php
    
        include_once __DIR__ . "/../model/tables/units.php";
        include_once __DIR__ . "/../alert.php";
        
        class UnitsController extends units
        {
            private $unitsModel;
            public $message;
        
            public function __construct()
            {
                $this->unitsModel = new units();
            }

            public function tblunits()
            {
                include_once __DIR__ . "/../view/tblunits.php";
            }
        
            public function frmunits()
            {
                include_once __DIR__ . "/../view/frmunits.php";
            }
        
            public function edtunits()
            {
                include_once __DIR__ . "/../view/edtunits.php";
            }
        
            public function delunits(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createunits()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmunits.php";
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
        
                    $new_units = new units();
                    $new_units->set_fname($_POST['first_name']);
                    $new_units->set_lname($_POST['last_name']);
                    $new_units->set_start_date($_POST['start_date']);
                    $new_units->create();
                    $message = 'units Created';
                    return $message;
            }
            }
        
            public function deleteunits()
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
                        $statement = $this->unitsModel->getUnitsById($id);
                        $delunits = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delunits['id'] != $_SESSION['id']) {
                            if (($delunits['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->unitsModel->delete($id);
                                $this->delunit();
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
        
            public function viewunits()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $units = $this->unitsModel->getUnitsById($id);
                return $units;
            }
        
            public function viewunitss()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->unitsModel->view($role, $id);
                return $statement;
            
            }
        
            public function updateunits()
            {
            
                    $update_units = new units();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no']
        
                    );
                    $message = $update_units->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtunits.php";
                    return $message;
                }
            
        }
        ?>