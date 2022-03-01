<?php 

        include_once __DIR__ . "/../model/tables/references.php";
        include_once __DIR__ . "/../alert.php";
        
        class ReferencesController extends Reference
        {
            private $referencesModel;
            public $message;
        
            public function __construct()
            {
                $this->referencesModel = new references();
            }
        

            public function tblreferences()
            {
                include_once __DIR__ . "/../view/tblreferences.php";
            }
        
            public function frmreferences()
            {
                include_once __DIR__ . "/../view/frmreferences.php";
            }
        
            public function edtreferences()
            {
                include_once __DIR__ . "/../view/edtreferences.php";
            }
        
            public function delreferences(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createref()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmreferences.php";
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
                        $message = 'Please input date attented';
                        return $message;
                    }
        
                    $new_references = new references();
                    $new_references->set_fname($_POST['first_name']);
                    $new_references->set_lname($_POST['last_name']);
                    $new_references->set_start_date($_POST['start_date']);
                    $new_references->create();
                    $message = 'references Created';
                    return $message;
            }
            }
        
            public function deleteref()
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
                        $statement = $this->referencesModel->getRefById($id);
                        $delref = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delref['id'] != $_SESSION['id']) {
                            if (($delref['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->referencesModel->delete($id);
                                $this->delref();
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
        
            public function viewref()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $references = $this->referencesModel->getRefById($id);
                return $references;
            }
        
            public function viewrefs()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->referencesModel->view($role, $id);
                return $statement;
            
            }
        
            public function updateref()
            {
            
                    $update_ref = new references();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no']
        
                    );
                    $message = $update_ref->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtreferences.php";
                    return $message;
                }
            
        }
        ?>