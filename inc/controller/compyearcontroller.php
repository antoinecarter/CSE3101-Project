    <?php

        include_once __DIR__ . "/../model/tables/compyear.php";
        include_once __DIR__ . "/../alert.php";
        
        class CompyearController extends Compyear
        {
            private $compyearModel;
            public $message;
        
            public function __construct()
            {
                $this->compyearModel = new Compyear();
            }

            public function tblcompy()
            {
                include_once __DIR__ . "/../view/tblcompy.php";
            }
        
            public function frmcompy()
            {
                include_once __DIR__ . "/../view/frmcompy.php";
            }
        
            public function edtcompy()
            {
                include_once __DIR__ . "/../view/edtcompy.php";
            }
        
            public function delcompy(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createcompyr()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmacompy.php";
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
                        $message = 'Please input date Year';
                        return $message;
                    }
        
                    $new_compyear = new Compyear();
                    $new_compyear->set_fname($_POST['first_name']);
                    $new_compyear->set_lname($_POST['last_name']);
                    $new_compyear->set_start_date($_POST['start_date']);
                    $new_compyear->create();
                    $message = 'Company Year Created';
                    return $message;
            }
            }
        
            public function deletecompyr()
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
                        $statement = $this->compyearModel->getCompyrById($id);
                        $delcompyr = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delcompyr['id'] != $_SESSION['id']) {
                            if (($delcompyr['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->compyearModel->delete($id);
                                $this->delcompyr();
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
        
            public function viewcompyr()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $compyear = $this->compyearModel->getCompyrById($id);
                return $compyear;
            }
        
            public function viewcompyrs()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->compyearModel->view($role, $id);
                return $statement;
            
            }
        
            public function updatecompyr()
            {
            
                    $update_compyr = new Compyear();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'first_name'     => $_REQUEST['first_name'],
                        'last_name'     => $_REQUEST['last_name'],
                        'start_date'    => $_REQUEST['start_date'],
                        'role'            => $_REQUEST['role'],
                        'emp_no'        => $_REQUEST['emp_no'],
        
                    );
                    $message = $update_compyr->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtcompy.php";
                    return $message;
                }
            
        }
        ?>