<?php
    
        include_once __DIR__ . "/../model/tables/units.php";
        include_once __DIR__ . "/../alert.php";
        
        class UnitsController extends Unit
        {
            private $unitsModel;
            public $message;
        
            public function __construct()
            {
                $this->unitsModel = new Unit();
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
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter orginazation id';
                        return $message;
                    }
        
                    if (empty($_POST['org_struct_id'])) {
                        $message = 'Please input org_struct_id';
                        return $message;
                    }
        
        
                    if (empty($_POST['parent_dept_id'])) {
                        $message = 'Please input parent dept_id';
                        return $message;
                    }
        
        
                    if (empty($_POST['unit_code'])) {
                        $message = 'Please input unit code';
                        return $message;
                    }
        
        
                    if (empty($_POST['unit_name'])) {
                        $message = 'Please input unit name';
                        return $message;
                    }
        
        
                    if (empty($_POST['unit_level'])) {
                        $message = 'Please input unit level';
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
        
        
                    if (empty($_POST['start_date'])) {
                        $message = 'Please input ';
                        return $message;
                    }
        
        
                    if (empty($_POST['status'])) {
                        $message = 'Please input status';
                        return $message;
                    }
        
        
                    $new_units = new Unit();
                    $new_units->set_org_id($_POST['org_id']);
                    $new_units->set_org_struct_id($_POST['org_struct_id']);
                    $new_units->set_parent_dept_id($_POST['parent_dept_id']);
                    $new_units->set_unit_code($_POST['unit_code']);
                    $new_units->set_unit_name($_POST['unit_name']);
                    $new_units->set_unit_level($_POST['unit_level']);
                    $new_units->set_start_date($_POST['start_date']);
                    $new_units->set_end_date($_POST['end_date']);
                    $new_units->set_status($_POST['status']);
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
                        $statement = $this->unitsModel->getUnitById($id);
                        $delunits = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delunits['id'] != $_SESSION['id']) {
                            if (($delunits['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->unitsModel->delete($id);
                                $this->delunits();
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
                $units = $this->unitsModel->getUnitById($id);
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
            
                    $update_units = new Unit();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'org_struct_id'     => $_REQUEST['org_struct_id'],
                        'parent_dept_id'     => $_REQUEST['parent_dept_id'],
                        'unit_code'    => $_REQUEST['unit_code'],
                        'unit_level'            => $_REQUEST['unit_level'],
                        'start_date'            => $_REQUEST['start_date'],
                        'end_date'            => $_REQUEST['end_date'],
                        'status'            => $_REQUEST['status']
        
                    );
                    $message = $update_units->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtunits.php";
                    return $message;
                }
            
        }
        ?>