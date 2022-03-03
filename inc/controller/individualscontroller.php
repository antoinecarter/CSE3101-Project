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
                        if (empty($_POST['org_id'])) {
                            $message = 'Please enter Orginazation id';
                            return $message;
                        }

                        if($this->individualsModel->alreadyexist($_POST['surname'], $_POST['first_name'])){
                            $message = 'Individual already exist';
                            return $message;
                        }
            
                        if (empty($_POST['first_name'])) {
                            $message = 'Please enter first name';
                            return $message;
                        }
            
                        if (empty($_POST['surname'])) {
                            $message = 'Please input surname ';
                            return $message;
                        }
            
            
                        if (empty($_POST['sex'])) {
                            $message = 'Please input sex ';
                            return $message;
                        }
            
            
                        if (empty($_POST['date_of_birth'])) {
                            $message = 'Please input date of birth ';
                            return $message;
                        }
            
            
                        if (empty($_POST['place_of_birth'])) {
                            $message = 'Please input place of birth ';
                            return $message;
                        }
            
            
                        if (empty($_POST['email'])) {
                            $message = 'Please input email ';
                            return $message;
                        }
            
            
                        if (empty($_POST['nationality'])) {
                            $message = 'Please input nationality ';
                            return $message;
                        }
            
            
                        if (empty($_POST['ethnicity'])) {
                            $message = 'Please input ethnicity ';
                            return $message;
                        }
            
            
                        if (empty($_POST['status'])) {
                            $message = 'Please input status ';
                            return $message;
                        }
            
                        $new_individuals = new Individual();
                        $new_individuals->set_org_id($_SESSION['org_id']);
                        $new_individuals->set_first_name($_POST['first_name']);
                        $new_individuals->set_surname($_POST['surname']);
                        $new_individuals->set_sex($_POST['sex']);
                        $new_individuals->set_date_of_birth($_POST['date_of_birth']);
                        $new_individuals->set_place_of_birth($_POST['place_of_birth']);
                        $new_individuals->set_email($_POST['email']);
                        $new_individuals->set_nationality($_POST['nationality']);
                        $new_individuals->set_ethnicity($_POST['ethnicity']);
                        $new_individuals->set_status($_POST['status']);
                        $new_individuals->create();
                        $message = 'Individual Created';
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
                            $statement = $this->individualsModel->getIndById($id);
                            $delindv = $statement->fetch(PDO::FETCH_ASSOC);
                            if (($_SESSION['role'] == 'ADMIN') || ($_SESSION['can_delete'] == 1)) {
                                if (in_array($delindv['status'], array('UNVERIFY', 'KEYED'))){
                                    $message = $this->individualsModel->delete($id);
                                    $this->delindividuals();
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
                    $individuals = $this->individualsModel->getIndById($id);
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
                            'surname'     => $_REQUEST['surname'],
                            'sex'    => $_REQUEST['sex'],
                            'date_of_birth'            => $_REQUEST['date_of_birth'],
                            'place_of_birth'            => $_REQUEST['place_of_birth'],
                            'email'            => $_REQUEST['email'],
                            'nationality'            => $_REQUEST['nationality'],
                            'ethnicity'            => $_REQUEST['ethnicity'],
                            'status'        => $_REQUEST['status']
            
                        );
                        $message = $update_indv->update($d['id'], $d);
                        include_once __DIR__ . "/../view/edtindividuals.php";
                        return $message;
                    }
                public function individualsList($org_id){
                    $list= $this->individualsModel->findIndividual($org_id);
                    return $list;
                }
            }
            ?>