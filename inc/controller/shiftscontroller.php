<?php


        include_once __DIR__ . "/../model/tables/shifts.php";
        include_once __DIR__ . "/../alert.php";
        
        class ShiftsController extends Shift
        {
            private $shiftsModel;
            public $message;
        
            public function __construct()
            {
                $this->shiftsModel = new Shift();
            }

            
            public function tblshifts()
            {
                include_once __DIR__ . "/../view/tblshifts.php";
            }

            public function frmshifts()
            {
                include_once __DIR__ . "/../view/frmshifts.php";
            }

            public function edtshifts()
            {
                include_once __DIR__ . "/../view/edtshifts.php";
            }

            public function delshifts(){
                include_once __DIR__ . "/../view/delete.php";
            }
        
            public function createshift()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmshifts.php";
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
        
                    $new_shifts = new Shift();
                    $new_shifts->set_fname($_POST['first_name']);
                    $new_shifts->set_lname($_POST['last_name']);
                    $new_shifts->set_start_date($_POST['start_date']);
                    $new_shifts->create();
                    $message = 'shifts Created';
                    return $message;
            }
            }
        
            public function deleteshift()
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
                        $statement = $this->shiftsModel->getShiftById($id);
                        $delshift = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delshift['id'] != $_SESSION['id']) {
                            if (($delshift['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->shiftsModel->delete($id);
                                $this->delshift();
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
        
            public function viewshift()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $shifts = $this->shiftsModel->getShiftById($id);
                return $shifts;
            }
        
            public function viewshifts()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->shiftsModel->view($role, $id);
                return $statement;
            
            }
        
            public function updateshift()
            {
            
                    $update_shift = new Shift();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no']
        
                    );
                    $message = $update_shift->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtshifts.php";
                    return $message;
                }
            
        }
        ?>