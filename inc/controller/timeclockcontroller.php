<?php


        include_once __DIR__ . "/../model/tables/timeclock.php";
        include_once __DIR__ . "/../alert.php";
        
        class TimeclocksController extends timeclocks
        {
            private $timeclocksModel;
            public $message;
        
            public function __construct()
            {
                $this->timeclocksModel = new timeclocks();
            }

                    
            public function tbltimeclocks()
            {
                include_once __DIR__ . "/../view/tbltimeclock.php";
            }

            public function frmtimeclocks()
            {
                include_once __DIR__ . "/../view/frmtimeclock.php";
            }

            public function edttimeclocks()
            {
                include_once __DIR__ . "/../view/edttimeclock.php";
            }

            public function deltimeclocks(){
                include_once __DIR__ . "/../view/delete.php";
            }
        
            public function createtime()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmtimeclock.php";
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
        
                    $new_timeclocks = new timeclocks();
                    $new_timeclocks->set_fname($_POST['first_name']);
                    $new_timeclocks->set_lname($_POST['last_name']);
                    $new_timeclocks->set_start_date($_POST['start_date']);
                    $new_timeclocks->create();
                    $message = 'timeclocks Created';
                    return $message;
            }
            }
        
            public function deletetime()
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
                        $statement = $this->timeclocksModel->getTimeById($id);
                        $deltime = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($deltime['id'] != $_SESSION['id']) {
                            if (($deltime['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->timeclocksModel->delete($id);
                                $this->deltime();
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
        
            public function viewtime()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $timeclocks = $this->timeclocksModel->getTimeById($id);
                return $timeclocks;
            }
        
            public function viewtimes()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->timeclocksModel->view($role, $id);
                return $statement;
            
            }
        
            public function updatetime()
            {
            
                    $update_time = new timeclocks();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no']
        
                    );
                    $message = $update_time->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edttimeclock.php";
                    return $message;
                }
            
        }
        ?>