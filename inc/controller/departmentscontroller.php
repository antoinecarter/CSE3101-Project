<?php

        include_once __DIR__ . "/../model/tables/departments.php";
        include_once __DIR__ . "/../alert.php";
        
        class DepartmentsController extends departments
        {
            private $departmentsModel;
            public $message;
        
            public function __construct()
            {
                $this->departmentsModel = new departments();
            }

            
            public function tbldepartments()
            {
                include_once __DIR__ . "/../view/tbldepartments.php";
            }

            public function frmdepartments()
            {
                include_once __DIR__ . "/../view/frmdepartments.php";
            }

            public function edtdepartments()
            {
                include_once __DIR__ . "/../view/edtdepartments.php";
            }

            public function deldepartments(){
                include_once __DIR__ . "/../view/delete.php";
            }
                
            public function createdpt()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmdepartments.php";
                } else {
                    if (empty($_POST['department_name'])) {
                        $message = 'Please enter Departments name';
                        return $message;
                    }
        
                    if (empty($_POST['start_date'])) {
                        $message = 'Please input date department';
                        return $message;
                    }
        
                    $new_departments = new departments();
                    $new_departments->set_dname($_POST['department_name']);
                    $new_departments->set_start_date($_POST['start_date']);
                    $new_departments->create();
                    $message = 'departments Created';
                    return $message;
            }
            }
        
            public function deletedpt()
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
                        $statement = $this->departmentsModel->getDptById($id);
                        $deldpt = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($deldpt['id'] != $_SESSION['id']) {
                            if (($deldpt['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->departmentsModel->delete($id);
                                $this->deldpt();
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
        
            public function viewdpt()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $departments = $this->departmentsModel->getDptById($id);
                return $departments;
            }
        
            public function viewdpts()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->departmentsModel->view($role, $id);
                return $statement;
            
            }
        
            public function updatedpt()
            {
            
                    $update_dpt = new departments();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no']
        
                    );
                    $message = $update_dpt->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtdepartments.php";
                    return $message;
                }
            
        }
        ?>