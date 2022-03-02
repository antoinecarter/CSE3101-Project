<?php

        include_once __DIR__ . "/../model/tables/departments.php";
        include_once __DIR__ . "/../alert.php";
        
        class DepartmentsController extends Department
        {
            private $departmentsModel;
            public $message;
        
            public function __construct()
            {
                $this->departmentsModel = new Department();
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
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter Organization id';
                        return $message;
                    }else {
                        if ($this->departmentsModel->findDepartments($_POST['org_id'])) {
                            $message = 'Username already exist';
                            return $message;
                        }
                    }
        
                    if (empty($_POST['org_struct_id'])) {
                        $message = 'Please input Org. Structure id';
                        return $message;
                    }
                
                    if (empty($_POST['dept_code'])) {
                        $message = 'Please input Department code';
                        return $message;
                    }
                
                    if (empty($_POST['dept_name'])) {
                        $message = 'Please input Department Name';
                        return $message;
                    }
                
                    if (empty($_POST['dept_level'])) {
                        $message = 'Please input department level';
                        return $message;
                    }
                
                    if (empty($_POST['start_date'])) {
                        $message = 'Please input date';
                        return $message;
                    }
                
                    if (empty($_POST['status'])) {
                        $message = 'Please input Status';
                        return $message;
                    }
        
                    $new_departments = new Department();
                    $new_departments->set_org_id($_POST['org_id']);
                    $new_departments->set_org_struct_id($_POST['org_struct_id']);
                    $new_departments->set_dept_code($_POST['dept_code']);
                    $new_departments->set_dept_name($_POST['dept_name']);
                    $new_departments->set_dept_level($_POST['dept_level']);
                    $new_departments->set_start_date($_POST['start_date']);
                    $new_departments->set_status($_POST['status']);
                    $new_departments->create();
                    $message = 'Department Created';
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
                        $statement = $this->departmentsModel->getDeptById($id);
                        $deldpt = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($deldpt['id'] != $_SESSION['id']) {
                            if (($deldpt['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->departmentsModel->delete($id);
                                $this->deldepartments();
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
                $departments = $this->departmentsModel->getDeptById($id);
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
            
                    $update_dpt = new Department();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'org_struct_id'     => $_REQUEST['org_struct_id'],
                        'dept_code'     => $_REQUEST['dept_code'],
                        'dept_name'    => $_REQUEST['dept_name'],
                        'dept_level'            => $_REQUEST['dept_level'],
                        'start_date'            => $_REQUEST['start_date'],
                        'status'        => $_REQUEST['status']
        
                    );
                    $message = $update_dpt->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtdepartments.php";
                    return $message;
                }
            
        }
        ?>