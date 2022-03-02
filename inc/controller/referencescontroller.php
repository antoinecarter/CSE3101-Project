<?php 

        include_once __DIR__ . "/../model/tables/references.php";
        include_once __DIR__ . "/../alert.php";
        
        class ReferencesController extends Reference
        {
            private $referencesModel;
            public $message;
        
            public function __construct()
            {
                $this->referencesModel = new Reference();
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
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter org id';
                        return $message;
                    }
        
                    if (empty($_POST['table_name'])) {
                        $message = 'Please input table name';
                        return $message;
                    }
        
        
                    if (empty($_POST['table_desc'])) {
                        $message = 'Please input table desc';
                        return $message;
                    }
        
        
                    if (empty($_POST['table_value'])) {
                        $message = 'Please input table value';
                        return $message;
                    }
        
        
                    if (empty($_POST['value_desc'])) {
                        $message = 'Please input value desc';
                        return $message;
                    }
        
        
                    if (empty($_POST['end_date'])) {
                        $message = 'Please input end date';
                        return $message;
                    }
        
        
                    if (empty($_POST['status'])) {
                        $message = 'Please input status';
                        return $message;
                    }
        
        
                    if (empty($_POST['start_date'])) {
                        $message = 'Please input start date';
                        return $message;
                    }
        
                    $new_references = new Reference();
                    $new_references->set_org_id($_POST['org_id']);
                    $new_references->set_table_name($_POST['table_name']);
                    $new_references->set_table_desc($_POST['table_desc']);
                    $new_references->set_table_value($_POST['table_value']);
                    $new_references->set_value_desc($_POST['value_desc']);
                    $new_references->set_end_date($_POST['end_date']);
                    $new_references->set_status($_POST['status']);
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
                                $this->delreferences();
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
            
                    $update_ref = new Reference();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'table_name'     => $_REQUEST['table_name'],
                        'table_desc'     => $_REQUEST['table_desc'],
                        'table_value'    => $_REQUEST['table_value'],
                        'value_desc'            => $_REQUEST['value_desc'],
                        'end_date'            => $_REQUEST['end_date'],
                        'status'            => $_REQUEST['status'],
                        'start_date'        => $_REQUEST['start_date']
        
                    );
                    $message = $update_ref->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtreferences.php";
                    return $message;
                }
            
        }
        ?>