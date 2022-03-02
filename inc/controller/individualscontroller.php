<?php

        include_once __DIR__ . "/../model/tables/individuals.php";
        include_once __DIR__ . "/../alert.php";
        
        class IndividualsController extends Individual
        {
            private $individualsModel;
            public $message;
        
            public function __construct()
            {
                $this->individualsModel = new Individual();
            }
        
            
            public function tblindividuals()
            {
                include_once __DIR__ . "/../view/tblindividuals.php";
            }

            public function frmindividuals()
            {
                include_once __DIR__ . "/../view/frmindividuals.php";
            }

            public function edtindividuals()
            {
                include_once __DIR__ . "/../view/edtindividuals.php";
            }

            public function delindividuals(){
                include_once __DIR__ . "/../view/delete.php";
            }

                public function createindv()
                {
                    $method = $_SERVER['REQUEST_METHOD'];
            
                    if ($method == "GET") {
                        include_once __DIR__ . "/../view/frmindividuals.php";
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
            
                        $new_individuals = new Individual();
                        $new_individuals->set_fname($_POST['first_name']);
                        $new_individuals->set_lname($_POST['last_name']);
                        $new_individuals->set_start_date($_POST['start_date']);
                        $new_individuals->create();
                        $message = 'Individuals Created';
                        return $message;
                }
                }
            
                public function deleteindv()
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
                            $statement = $this->individualsModel->getIndvById($id);
                            $delindv = $statement->fetch(PDO::FETCH_ASSOC);
                            if ($delindv['id'] != $_SESSION['id']) {
                                if (($delindv['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                    $message = $this->individualsModel->delete($id);
                                    $this->delindv();
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
            
                public function viewindv()
                {
                    
                    $url = $_SERVER['REQUEST_SCHEME'] . '://';
                    $url .= $_SERVER['HTTP_HOST'];
                    $url .= $_SERVER['REQUEST_URI'];
            
                    $url_components = parse_url($url);
                    if(isset($url_components['query'])){
                        parse_str($url_components['query'], $params);
                    };
                    $id = $params['id'];
                    $individuals = $this->individualsModel->getIndvById($id);
                    return $individuals;
                }
            
                public function viewindvs()
                {
                    $id =  $_SESSION['id'];
                    $role = $_SESSION['role'];
                    $statement = $this->individualsModel->view($role, $id);
                    return $statement;
                
                }
            
                public function updateindv()
                {
                
                        $update_indv = new Individual();
                        $d = array(
                            'id'            => $_REQUEST['id'],
                            'org_id'        => $_REQUEST['org_id'],
                            'first_name'     => $_REQUEST['first_name'],
                            'last_name'     => $_REQUEST['last_name'],
                            'start_date'    => $_REQUEST['start_date'],
                            'role'            => $_REQUEST['role'],
                            'emp_no'        => $_REQUEST['emp_no']
            
                        );
                        $message = $update_indv->update($d['id'], $d);
                        include_once __DIR__ . "/../view/edtindividuals.php";
                        return $message;
                    }
                
            }
            ?>