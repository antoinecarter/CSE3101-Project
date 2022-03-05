<?php 

        include_once __DIR__ . "/../model/tables/leavereq.php";
        include_once __DIR__ . "/../alert.php";
        
        class LeaverequestsController extends LeaveRequest
        {
            private $leaverequestsModel;
            public $message;
        
            public function __construct()
            {
                $this->leaverequestsModel = new LeaveRequest();
            }

                    
            public function tblleaverequests()
            {
                include_once __DIR__ . "/../view/tblleavereq.php";
            }

            public function frmleaverequests()
            {
                include_once __DIR__ . "/../view/frmleavereq.php";
            }

            public function edtleaverequests()
            {
                include_once __DIR__ . "/../view/edtleavereq.php";
            }

            public function delleaverequests(){
                include_once __DIR__ . "/../view/delete.php";
            }
        
            public function createleavreq()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmleavereq.php";
                } else {
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter org id';
                        return $message;
                    }
        
                    if (empty($_POST['emp_id'])) {
                        $message = 'Please enter emp id';
                        return $message;
                    }
        
                    if (empty($_POST['leave_type'])) {
                        $message = 'Please input leave type ';
                        return $message;
                    }
        
        
                    if (empty($_POST['from_date'])) {
                        $message = 'Please input from date ';
                        return $message;
                    }
        
        
                    if (empty($_POST['to_date'])) {
                        $message = 'Please input to date ';
                        return $message;
                    }
        
        
                    if (empty($_POST['resumption_date'])) {
                        $message = 'Please input resumption date ';
                        return $message;
                    }
        
        
                    if (empty($_POST['status'])) {
                        $message = 'Please input status ';
                        return $message;
                    }
    
        
                    $new_leaverequests = new LeaveRequest();
                    $new_leaverequests->set_org_id($_POST['org_id']);
                    $new_leaverequests->set_emp_id($_POST['emp_id']);
                    $new_leaverequests->set_leave_type($_POST['leave_type']);
                    $new_leaverequests->set_from_date($_POST['from_date']);
                    $new_leaverequests->set_to_date($_POST['to_date']);
                    $new_leaverequests->set_resumption_date($_POST['resumption_date']);
                    $new_leaverequests->set_approved_by($_POST['approved_by']);
                    $new_leaverequests->set_approved_date($_POST['approved_date']);
                    $new_leaverequests->set_status($_POST['status']);
                    $new_leaverequests->create();
                    $message = 'leave requests Created';
                    return $message;

        
            }
            }
        
            public function deleteleavreq()
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
                        $statement = $this->leaverequestsModel->getleaverequestsById($id);
                        $delleavreq = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delleavreq['id'] != $_SESSION['id']) {
                            if (($delleavreq['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->leaverequestsModel->delete($id);
                                $this->delleaverequests();
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
        
            public function viewleavreq()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $leaverequests = $this->leaverequestsModel->getleaverequestsById($id);
                return $leaverequests;
            }
        
            public function viewleavreqs()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->leaverequestsModel->view($role, $id);
                return $statement;
            
            }
        
            public function updateleavreq()
            {
            
                    $update_leavreq = new LeaveRequest();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'emp_id'     => $_REQUEST['emp_id'],
                        'leave_type'     => $_REQUEST['leave_type'],
                        'from_date'    => $_REQUEST['from_date'],
                        'to_date'            => $_REQUEST['to_date'],
                        'resumption_date'            => $_REQUEST['resumption_date'],
                        'approved_by'            => $_REQUEST['approved_by'],
                        'approved_date'            => $_REQUEST['approved_date'],
                        'status'        => $_REQUEST['status']
        
                    );
                    $message = $update_leavreq->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtleavereq.php";
                    return $message;
                }
            
        }
        ?>