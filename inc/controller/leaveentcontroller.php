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
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter Orginazation id';
                        return $message;
                    }else {
                        if ($this->leaveentitlemtModel->findLeaveEnt($_POST['org_id'], $_POST['id'])) {
                            $message = 'Username already exist';
                            return $message;
                        }
                    }
        
                    if (empty($_POST['emp_id'])) {
                        $message = 'Please input Employee id';
                        return $message;
                    }
        
        
                    if (empty($_POST['leave_type'])) {
                        $message = 'Please input leave type';
                        return $message;
                    }
        
        
                    if (empty($_POST['quantity'])) {
                        $message = 'Please input quantity';
                        return $message;
                    }
        
        
                    if (empty($_POST['max_accumulation'])) {
                        $message = 'Please input max accumulation';
                        return $message;
                    }
        
        
                    if (empty($_POST['monthly_rate'])) {
                        $message = 'Please input monthly rate';
                        return $message;
                    }
        
        
                    if (empty($_POST['leave_earn'])) {
                        $message = 'Please input leave earn';
                        return $message;
                    }
        
        
                    if (empty($_POST['end_date'])) {
                        $message = 'Please input end date ';
                        return $message;
                    }
        
        
                    if (empty($_POST['start_date'])) {
                        $message = 'Please input start date';
                        return $message;
                    }
        
                    $new_leaveentitlemt = new LeaveEntitlement();
                    $new_leaveentitlemt->set_org_id($_POST['org_id']);
                    $new_leaveentitlemt->set_emp_id($_POST['emp_id']);
                    $new_leaveentitlemt->set_leave_type($_POST['leave_type']);
                    $new_leaveentitlemt->set_quantity($_POST['quantity']);
                    $new_leaveentitlemt->set_max_accumulation($_POST['max_accumulation']);
                    $new_leaveentitlemt->set_monthly_rate($_POST['monthly_rate']);
                    $new_leaveentitlemt->set_leave_earn($_POST['leave_earn']);
                    $new_leaveentitlemt->set_end_date($_POST['end_date']);
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
                        $statement = $this->leaveentitlemtModel->getLeaveEntById($id);
                        $delleav = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delleav['id'] != $_SESSION['id']) {
                            if (($delleav['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->leaveentitlemtModel->delete($id);
                                $this->delleaveentitlemt();
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
                $leaveentitlemt = $this->leaveentitlemtModel->getLeaveEntById($id);
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
                        'emp_id'     => $_REQUEST['emp_id'],
                        'leave_type'     => $_REQUEST['leave_type'],
                        'quantity'    => $_REQUEST['quantity'],
                        'max_accumulation'            => $_REQUEST['max_accumulation'],
                        'monthly_rate'            => $_REQUEST['monthly_rate'],
                        'leave_earn'            => $_REQUEST['leave_earn'],
                        'end_date'            => $_REQUEST['end_date'],
                        'start_date'            => $_REQUEST['start_date']
        
                    );
                    $message = $update_leav->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtleaveentitlemt.php";
                    return $message;
                }
            
        }
        ?>