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
        
                    $new_leaverequests = new LeaveRequest();
                    $new_leaverequests->set_fname($_POST['first_name']);
                    $new_leaverequests->set_lname($_POST['last_name']);
                    $new_leaverequests->set_start_date($_POST['start_date']);
                    $new_leaverequests->create();
                    $message = 'leaverequests Created';
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
                        $statement = $this->leaverequestsModel->getLeavreqById($id);
                        $delleavreq = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delleavreq['id'] != $_SESSION['id']) {
                            if (($delleavreq['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->leaverequestsModel->delete($id);
                                $this->delleavreq();
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
                $leaverequests = $this->leaverequestsModel->getLeavreqById($id);
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
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no']
        
                    );
                    $message = $update_leavreq->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtleavereq.php";
                    return $message;
                }
            
        }
        ?>