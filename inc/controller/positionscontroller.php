<?php

        include_once __DIR__ . "/../model/tables/positions.php";
        include_once __DIR__ . "/../alert.php";
        
        class PositionsController extends positions
        {
            private $positionsModel;
            public $message;
        
            public function __construct()
            {
                $this->positionsModel = new positions();
            }
        
            
            public function tblpositions()
            {
                include_once __DIR__ . "/../view/tblpositions.php";
            }

            public function frmpositions()
            {
                include_once __DIR__ . "/../view/frmpositions.php";
            }

            public function edtpositions()
            {
                include_once __DIR__ . "/../view/edtpositions.php";
            }

            public function delpositions(){
                include_once __DIR__ . "/../view/delete.php";
            }
    
            public function createpos()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmpositions.php";
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
                        $message = 'Please input date';
                        return $message;
                    }
        
                    $new_positions = new positions();
                    $new_positions->set_fname($_POST['first_name']);
                    $new_positions->set_lname($_POST['last_name']);
                    $new_positions->set_start_date($_POST['start_date']);
                    $new_positions->create();
                    $message = 'positions Created';
                    return $message;
            }
            }
        
            public function deletepos()
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
                        $statement = $this->positionsModel->getPosById($id);
                        $delpos = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delpos['id'] != $_SESSION['id']) {
                            if (($delpos['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->positionsModel->delete($id);
                                $this->delpos();
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
        
            public function viepos()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $positions = $this->positionsModel->getPosById($id);
                return $positions;
            }
        
            public function viewposs()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->positionsModel->view($role, $id);
                return $statement;
            
            }
        
            public function updatepos()
            {
            
                    $update_pos = new positions();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no']
        
                    );
                    $message = $update_pos->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtpositions.php";
                    return $message;
                }
            
        }
        ?>