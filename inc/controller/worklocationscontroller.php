<?php

    
        include_once __DIR__ . "/../model/tables/worklocations.php";
        include_once __DIR__ . "/../alert.php";
        
        class WorklocationsController extends Worklocation
        {
            private $worklocationsModel;
            public $message;
        
            public function __construct()
            {
                $this->worklocationsModel = new Worklocation();
            }
        

            public function tblworklocations()
            {
                include_once __DIR__ . "/../view/tblworklocations.php";
            }

            public function frmworklocations()
            {
                include_once __DIR__ . "/../view/frmworklocations.php";
            }

            public function edtworklocations()
            {
                include_once __DIR__ . "/../view/edtworklocations.php";
            }

            public function delworklocations(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createworkl()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmworklocations.php";
                } else {
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter orginazation id ';
                        return $message;
                    }

                    if (empty($_POST['location_code'])) {
                        $message = 'Please input location code';
                        return $message;
                    }
        

                    if (empty($_POST['location_desc'])) {
                        $message = 'Please input location desc';
                        return $message;
                    }
        

                    if (empty($_POST['address'])) {
                        $message = 'Please input address';
                        return $message;
                    }
        

                    if (empty($_POST['telephone'])) {
                        $message = 'Please input telephone';
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
                        $message = 'Please input ';
                        return $message;
                    }
      
        
                    $new_worklocations = new Worklocation();
                    $new_worklocations->set_org_id($_POST['org_id']);
                    $new_worklocations->set_location_code($_POST['location_code']);
                    $new_worklocations->set_location_desc($_POST['location_desc']);
                    $new_worklocations->set_address($_POST['address']);
                    $new_worklocations->set_telephone($_POST['telephone']);
                    $new_worklocations->set_end_date($_POST['end_date']);
                    $new_worklocations->set_status($_POST['status']);
                    $new_worklocations->set_start_date($_POST['start_date']);
                    $new_worklocations->create();
                    $message = 'worklocations Created';
                    return $message;
            }
            }
        
            public function deleteworkl()
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
                        $statement = $this->worklocationsModel->getWkLocationById($id);
                        $delworkl = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($delworkl['id'] != $_SESSION['id']) {
                            if (($delworkl['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                                $message = $this->worklocationsModel->delete($id);
                                $this->delworklocations();
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
        
            public function viewworkl()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $worklocations = $this->worklocationsModel->getWkLocationById($id);
                return $worklocations;
            }
        
            public function viewworkls()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->worklocationsModel->view($role, $id);
                return $statement;
            
            }
        
            public function updateworkl()
            {
            
                    $update_workl = new Worklocation();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'location_code'        => $_REQUEST['location_code'],
                        'location_desc'        => $_REQUEST['location_desc'],
                        'address'     => $_REQUEST['address'],
                        'telephone'     => $_REQUEST['telephone'],
                        'end_date'    => $_REQUEST['end_date'],
                        'status'            => $_REQUEST['status'],
                        'start_date'        => $_REQUEST['start_date']
        
                    );
                    $message = $update_workl->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtworklocations.php";
                    return $message;
                }
            
        }
        ?>