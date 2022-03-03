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
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter Organization';
                        return $message;
                    }

                    if (empty($_POST['shift_type'])) {
                        $message = 'Please input shift typed';
                        return $message;
                    }
        
                    if (empty($_POST['shift_code'])) {
                        $message = 'Please input shift code';
                        return $message;
                    }
        
                    if (empty($_POST['start_time'])) {
                        $message = 'Please input start time';
                        return $message;
                    }
        
                    if (empty($_POST['end_time'])) {
                        $message = 'Please input end time';
                        return $message;
                    }
        
                    if (empty($_POST['lunch_start'])) {
                        $message = 'Please input lunch start';
                        return $message;
                    }
        
                    if (empty($_POST['lunch_end'])) {
                        $message = 'Please input lunch end';
                        return $message;
                    }
        
                    if (empty($_POST['start_date'])) {
                        $message = 'Please input start date';
                        return $message;
                    }
        
                    if (empty($_POST['status'])) {
                        $message = 'Please input status';
                        return $message;
                    }
        
                    $new_shifts = new Shift();
                    $new_shifts->set_org_id($_POST['org_id']);
                    $new_shifts->set_shift_type($_POST['shift_type']);
                    $new_shifts->set_shift_code($_POST['shift_code']);
                    $new_shifts->set_start_time($_POST['start_time']);
                    $new_shifts->set_end_time($_POST['end_time']);
                    $new_shifts->set_lunch_start($_POST['lunch_start']);
                    $new_shifts->set_lunch_end($_POST['lunch_end']);
                    $new_shifts->set_start_date($_POST['start_date']);
                    $new_shifts->set_end_date($_POST['end_date']);
                    $new_shifts->set_status($_POST['status']);
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
                        if (($_SESSION['role'] == 'ADMIN') || ($_SESSION['can_delete'] == 1)) {
                            if (in_array($delshift['status'], array('UNVERIFY', 'KEYED'))){
                                $message = $this->shiftsModel->delete($id);
                                $this->delshifts();
                                return $message;
                            } else {
                                $message = 'Cannot delete verified record!';
                                return $message;
                            }
                        } else {
                            $message = 'Not permitted to delete record!';
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
                        'org_id'            => $_REQUEST['org_id'],
                        'shift_type'        => $_REQUEST['shift_type'],
                        'shift_code'     => $_REQUEST['shift_code'],
                        'start_time'     => $_REQUEST['start_time'],
                        'end_time'    => $_REQUEST['end_time'],
                        'shift_hours'    => $_REQUEST['shift_hours'],
                        'lunch_start'            => $_REQUEST['lunch_start'],
                        'lunch_end'            => $_REQUEST['lunch_end'],
                        'lunch_hours'            => $_REQUEST['lunch_hours'],
                        'start_date'            => $_REQUEST['start_date'],
                        'end_date'            => $_REQUEST['end_date'],
                        'status'            => $_REQUEST['status']
        
                    );
                    $message = $update_shift->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtshifts.php";
                    return $message;
                }

                public function shiftsList($org_id){
                    $list = $this->shiftsModel->findShift($org_id);
                    return $list;
                }
            
        }
        ?>