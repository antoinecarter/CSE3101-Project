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
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter Organization';
                        return $message;
                    }

                    if (empty($_POST['year'])) {
                        $message = 'Please enter year';
                        return $message;
                    }

                    if (empty($_POST['start_year'])) {
                        $message = 'Please enter year';
                        return $message;
                    }
                    
                    if (empty($_POST['end_year'])) {
                        $message = 'Please enter year';
                        return $message;
                    }
        
                    if (empty($_POST['payment_frequency'])) {
                        $message = 'Please input payment';
                        return $message;
                    }
        
                    $new_compyear = new Compyear();
                    $new_compyear->set_org_id($_POST['org_id']);
                    $new_compyear->set_year($_POST['year']);
                    $new_compyear->set_start_year($_POST['start_year']);
                    $new_compyear->set_end_year($_POST['end_year']);
                    $new_compyear->set_payment_frequency($_POST['payment_frequency']);
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
                        $statement = $this->compyearModel->getCompYearById($id);
                        $delcompyr = $statement->fetch(PDO::FETCH_ASSOC);
                        if (($_SESSION['role'] == 'ADMIN') || ($_SESSION['can_delete'] == 1)) {
                                $message = $this->compyearModel->delete($id);
                                $this->delcompy();
                                return $message;
                            
                        } else {
                            $message = 'Not permitted to delete record!';
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
                $compyear = $this->compyearModel->getCompYearById($id);
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
                        'year'     => $_REQUEST['year'],
                        'start_year'     => $_REQUEST['start_year'],
                        'end_year'    => $_REQUEST['end_year'],
                        'payment_frequency'    => $_REQUEST['payment_frequency']
   
                    );
                    $message = $update_compyr->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtcompy.php";
                    return $message;
                }
            
                public function compyrList($org_id){
                    $list = $this->compyearModel->findCompYear($org_id);
                    return $list;
                }
        }
        ?>