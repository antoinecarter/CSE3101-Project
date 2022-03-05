<?php

        include_once __DIR__ . "/../model/tables/salary.php";
        include_once __DIR__ . "/../alert.php";
        
        class SalaryController extends Salary
        {
            private $salaryModel;
            public $message;
        
            public function __construct()
            {
                $this->salaryModel = new Salary();
            }
        

            public function tblsalary()
            {
                include_once __DIR__ . "/../view/tblsalary.php";
            }
        
            public function frmsalary()
            {
                include_once __DIR__ . "/../view/frmsalary.php";
            }
        
            public function edtsalary()
            {
                include_once __DIR__ . "/../view/edtsalary.php";
            }
        
            public function delsalary(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createsal()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmsalary.php";
                } else {
                    if($this->salaryModel->verify($_POST['emp_id'])){
                        $message= 'Employee already has active salary record';
                        return $message;
                    }
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter organization';
                        return $message;
                    }

                    if (empty($_POST['emp_id'])) {
                        $message = 'Please input employee';
                        return $message;
                    }
        

                    if (empty($_POST['salary'])) {
                        $message = 'Please input salary';
                        return $message;
                    }

                    if (empty($_POST['start_date'])) {
                        $message = 'Please input date attented';
                        return $message;
                    }
        
                    $new_salary = new Salary();
                    $new_salary->set_org_id($_POST['org_id']);
                    $new_salary->set_emp_id($_POST['emp_id']);
                    $new_salary->set_salary($_POST['salary']);
                    $new_salary->set_start_date($_POST['start_date']);
                    $new_salary->set_end_date($_POST['end_date']);
                    $new_salary->create();
                    $message = 'salary Created';
                    return $message;

            }
            }
        
            public function deletesal()
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
                        $statement = $this->salaryModel->getSalById($id);
                        $delsal = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delsal['id'] != $_SESSION['id']) {
                            if (($delsal['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->salaryModel->delete($id);
                                $this->delsalary();
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
        
            public function viewsal()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $salary = $this->salaryModel->getSalById($id);
                return $salary;
            }
        
            public function viewsals()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->salaryModel->view($role, $id);
                return $statement;
            
            }
        
            public function updatesal()
            {
            
                    $update_sal = new Salary();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'emp_id'     => $_REQUEST['emp_id'],
                        'salary'     => $_REQUEST['salary'],
                        'start_date'    => $_REQUEST['start_date'],
                        'end_date'            => $_REQUEST['end_date']
        
                    );
                    $message = $update_sal->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtsalary.php";
                    return $message;
                }
            
        }
        ?>