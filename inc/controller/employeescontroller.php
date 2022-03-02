<?php

        include_once __DIR__ . "/../model/tables/employees.php";
        include_once __DIR__ . "/../alert.php";
        
        class EmployeesController extends Employee
        {
            private $employeesModel;
            public $message;
        
            public function __construct()
            {
                $this->employeesModel = new Employee();
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
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter Organization Id';
                        return $message;
                    } else {
                        if ($this->employeesModel->findEmp($_POST['org_id'])) {
                            $message = 'Username already exist';
                            return $message;
                        }
                    }

                    if (empty($_POST['emp_no'])) {
                        $message = 'Please enter Employee Number';
                        return $message;
                    }
        
                    if (empty($_POST['ind_id'])) {
                        $message = 'Please input Ind Id ';
                        return $message;
                    }
                
                    if (empty($_POST['position_id'])) {
                        $message = 'Please input Position Id ';
                        return $message;
                    }
                
                    if (empty($_POST['payment_frequency'])) {
                        $message = 'Please input Payment Frequency ';
                        return $message;
                    }
                
                    if (empty($_POST['emp_type'])) {
                        $message = 'Please input Employee type ';
                        return $message;
                    }
                
                    if (empty($_POST['emp_status'])) {
                        $message = 'Please input Employee Status ';
                        return $message;
                    }
                
                    if (empty($_POST['emp_date'])) {
                        $message = 'Please input date ';
                        return $message;
                    }
                
                    if (empty($_POST['rate_of_pay'])) {
                        $message = 'Please input Rate of pay ';
                        return $message;
                    }
        
                
                    if (empty($_POST['shift_id'])) {
                        $message = 'Please input Shift id ';
                        return $message;
                    }
        
                
                    if (empty($_POST['status'])) {
                        $message = 'Please input Status ';
                        return $message;
                    }
        
                    $new_employees = new Employee();
                    $new_employees->set_org_id($_POST['org_id']);
                    $new_employees->set_emp_no($_POST['emp_no']);
                    $new_employees->set_ind_id($_POST['ind_id']);
                    $new_employees->set_position_id($_POST['position_id']);
                    $new_employees->set_payment_frequency($_POST['payment_frequency']);
                    $new_employees->set_emp_type($_POST['emp_type']);
                    $new_employees->set_emp_status($_POST['emp_status']);
                    $new_employees->set_emp_date($_POST['emp_date']);
                    $new_employees->set_rate_of_pay($_POST['rate_of_pay']);
                    $new_employees->set_shift_id($_POST['shift_id']);
                    $new_employees->set_status($_POST['status']);
                    $new_employees->create();
                    $message = 'Employee Created';
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
                                $this->delemployees();
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
            
                    $update_emp = new Employee();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'emp_no'     => $_REQUEST['emp_no'],
                        'ind_id'     => $_REQUEST['ind_id'],
                        'position_id'    => $_REQUEST['position_id'],
                        'payment_frequency'            => $_REQUEST['payment_frequency'],
                        'emp_type'        => $_REQUEST['emp_type'],
                        'emp_status'        => $_REQUEST['emp_status'],
                        'emp_date'        => $_REQUEST['emp_date'],
                        'rate_of_pay'        => $_REQUEST['rate_of_pay'],
                        'shift_id'        => $_REQUEST['shift_id'],
                        'status'        => $_REQUEST['status']
        
                    );
                    $message = $update_emp->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtemployees.php";
                    return $message;
                }
            
        }
        ?>