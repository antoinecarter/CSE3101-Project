<?php


        include_once __DIR__ . "/../model/tables/leaveent.php";
        include_once __DIR__ . "/../alert.php";
        
        class LeaveentitlemtController extends LeaveEntitlement
        {
            private $leaveentitlemtModel;
            public $message;
        
            public function __construct()
            {
                $this->leaveentitlemtModel = new LeaveEntitlement();
            }

            
            public function tblleaveentitlemt()
            {
                include_once __DIR__ . "/../view/tblleaveentitlemt.php";
            }

            public function frmleaveentitlemt()
            {
                include_once __DIR__ . "/../view/frmleaveentitlemt.php";
            }

            public function edtleaveentitlemt()
            {
                include_once __DIR__ . "/../view/edtleaveentitlemt.php";
            }

            public function delleaveentitlemt(){
                include_once __DIR__ . "/../view/delete.php";
            }
        
            public function createleav()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmleaveentitlemt.php";
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
        
                    $new_leaveentitlemt = new LeaveEntitlement();
                    $new_leaveentitlemt->set_fname($_POST['first_name']);
                    $new_leaveentitlemt->set_lname($_POST['last_name']);
                    $new_leaveentitlemt->set_start_date($_POST['start_date']);
                    $new_leaveentitlemt->create();
                    $message = 'leaveentitlemt Created';
                    return $message;
            }
            }
        
            public function deleteleav()
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
                        $statement = $this->leaveentitlemtModel->getLeavById($id);
                        $delleav = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delleav['id'] != $_SESSION['id']) {
                            if (($delleav['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->leaveentitlemtModel->delete($id);
                                $this->delleav();
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
        
            public function viewleav()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $leaveentitlemt = $this->leaveentitlemtModel->getLeavById($id);
                return $leaveentitlemt;
            }
        
            public function viewleavs()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->leaveentitlemtModel->view($role, $id);
                return $statement;
            
            }
        
            public function updateleav()
            {
            
                    $update_leav = new LeaveEntitlement();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no']
        
                    );
                    $message = $update_leav->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtleaveentitlemt.php";
                    return $message;
                }
            
        }
        ?>