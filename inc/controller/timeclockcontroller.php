<?php


        include_once __DIR__ . "/../model/tables/timeclock.php";
        include_once __DIR__ . "/../alert.php";
        
        class TimeclocksController extends Timeclock
        {
            private $timeclocksModel;
            public $message;
        
            public function __construct()
            {
                $this->timeclocksModel = new Timeclock();
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
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter organization id';
                        return $message;
                    }
        
                    if (empty($_POST['work_date'])) {
                        $message = 'Please input work date';
                        return $message;
                    }
        
        
                    if (empty($_POST['day'])) {
                        $message = 'Please input day';
                        return $message;
                    }
        
        
                    if (empty($_POST['emp_id'])) {
                        $message = 'Please input employee id';
                        return $message;
                    }
        
        
                    if (empty($_POST['shift_id'])) {
                        $message = 'Please input shift id';
                        return $message;
                    }
        
        
                    if (empty($_POST['shift_hours'])) {
                        $message = 'Please input shift hours';
                        return $message;
                    }
        
        
                    if (empty($_POST['time_in'])) {
                        $message = 'Please input time in';
                        return $message;
                    }
        
        
                    if (empty($_POST['time_out'])) {
                        $message = 'Please input time out';
                        return $message;
                    }
        
        
                    if (empty($_POST['min_time_in'])) {
                        $message = 'Please input min_time_in';
                        return $message;
                    }
        
        
                    if (empty($_POST['max_time_out'])) {
                        $message = 'Please input max_time_out';
                        return $message;
                    }
        
        
                    if (empty($_POST['hours_worked'])) {
                        $message = 'Please input hours worked';
                        return $message;
                    }
        
        
                    if (empty($_POST['status'])) {
                        $message = 'Please input status';
                        return $message;
                    }
        
                    $new_timeclocks = new Timeclock();
                    $new_timeclocks->set_org_id($_POST['org_id']);
                    $new_timeclocks->set_work_date($_POST['work_date']);
                    $new_timeclocks->set_day($_POST['day']);
                    $new_timeclocks->set_emp_id($_POST['emp_id']);
                    $new_timeclocks->set_shift_id($_POST['shift_id']);
                    $new_timeclocks->set_shift_hours($_POST['shift_hours']);
                    $new_timeclocks->set_time_in($_POST['time_in']);
                    $new_timeclocks->set_time_out($_POST['time_out']);
                    $new_timeclocks->set_min_time_in($_POST['min_time_in']);
                    $new_timeclocks->set_max_time_out($_POST['max_time_out']);
                    $new_timeclocks->set_hours_worked($_POST['hours_worked']);
                    $new_timeclocks->set_status($_POST['status']);
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
                        $statement = $this->timeclocksModel->getTimeClockById($id);
                        $deltime = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($deltime['id'] != $_SESSION['id']) {
                            if (($deltime['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->timeclocksModel->delete($id);
                                $this->deltimeclocks();
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
                $timeclocks = $this->timeclocksModel->getTimeClockById($id);
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
            
                    $update_time = new Timeclock();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'work_date'     => $_REQUEST['work_date'],
                        'day'     => $_REQUEST['day'],
                        'emp_id'     => $_REQUEST['emp_id'],
                        'shift_id'     => $_REQUEST['shift_id'],
                        'shift_hours'     => $_REQUEST['shift_hours'],
                        'time_in'     => $_REQUEST['time_in'],
                        'time_out'     => $_REQUEST['time_out'],
                        'min_time_in'    => $_REQUEST['min_time_in'],
                        'max_time_out'            => $_REQUEST['max_time_out'],
                        'hours_worked'            => $_REQUEST['hours_worked'],
                        'status'        => $_REQUEST['status']
        
                    );
                    $message = $update_time->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edttimeclock.php";
                    return $message;
                }
            
        }
        ?>