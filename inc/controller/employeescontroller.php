<?php

        include_once __DIR__ . "/../model/tables/employees.php";
        include_once __DIR__ . "/../alert.php";
        
        class EmployeesController extends employees
        {
            private $employeesModel;
            public $message;
        
            public function __construct()
            {
                $this->employeesModel = new employees();
            }
        
            
            public function tblemployees()
            {
                include_once __DIR__ . "/../view/tblemployees.php";
            }

            public function frmemployees()
            {
                include_once __DIR__ . "/../view/frmemployees.php";
            }

            public function edtemployees()
            {
                include_once __DIR__ . "/../view/edtemployees.php";
            }

            public function delemployees(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createemp()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmemployees.php";
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
        
                    $new_employees = new employees();
                    $new_employees->set_fname($_POST['first_name']);
                    $new_employees->set_lname($_POST['last_name']);
                    $new_employees->set_start_date($_POST['start_date']);
                    $new_employees->create();
                    $message = 'employees Created';
                    return $message;
            }
            }
        
            public function deleteemp()
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
                        $statement = $this->employeesModel->getEmpById($id);
                        $delemp = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delemp['id'] != $_SESSION['id']) {
                            if (($delemp['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->employeesModel->delete($id);
                                $this->delemp();
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
        
            public function viewemp()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $employees = $this->employeesModel->getEmpById($id);
                return $employees;
            }
        
            public function viewemps()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->employeesModel->view($role, $id);
                return $statement;
            
            }
        
            public function updateemp()
            {
            
                    $update_emp = new employees();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no']
        
                    );
                    $message = $update_emp->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtemployees.php";
                    return $message;
                }
            
        }
        ?>