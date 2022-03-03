<?php

        include_once __DIR__ . "/../model/tables/positions.php";
        include_once __DIR__ . "/../alert.php";
        
        class PositionsController extends Position
        {
            private $positionsModel;
            public $message;
        
            public function __construct()
            {
                $this->positionsModel = new Position();
            }
        
            
            public function tblpositions()
            {
                include_once __DIR__ . "/../view/tblpositions.php";
            }

            public function frmpositions()
            {
                include_once __DIR__ . "/../view/frmpositions.php";
            }

            public function edtpositions()
            {
                include_once __DIR__ . "/../view/edtpositions.php";
            }

            public function delpositions(){
                include_once __DIR__ . "/../view/delete.php";
            }
    
            public function createpos()
            {
                $method = $_SERVER['REQUEST_METHOD'];
        
                if ($method == "GET") {
                    include_once __DIR__ . "/../view/frmpositions.php";
                } else {
                    if (empty($_POST['org_id'])) {
                        $message = 'Please enter Organization';
                        return $message;
                    }
        
                    if (empty($_POST['org_struct_id'])) {
                        $message = 'Please input Org Structure';
                        return $message;
                    }
        
        
                    if (empty($_POST['parent_unit_id'])) {
                        $message = 'Please input Parent Unit';
                        return $message;
                    }
        
        
                    if (empty($_POST['pos_code'])) {
                        $message = 'Please input position code';
                        return $message;
                    }
        
        
                    if (empty($_POST['pos_name'])) {
                        $message = 'Please input position name';
                        return $message;
                    }
        
        
                    if (empty($_POST['pos_level'])) {
                        $message = 'Please input position level';
                        return $message;
                    }
        
        
                    if (empty($_POST['overview'])) {
                        $message = 'Please input overview';
                        return $message;
                    }
        
        
                    if (empty($_POST['wk_loc_id'])) {
                        $message = 'Please input wk_loc_id';
                        return $message;
                    }
        
        
                    if (empty($_POST['lower_sal'])) {
                        $message = 'Please input lower_sal';
                        return $message;
                    }
        
        
                    if (empty($_POST['upper_sal'])) {
                        $message = 'Please input upper_sal';
                        return $message;
                    }
        
        
                    if (empty($_POST['status'])) {
                        $message = 'Please input status';
                        return $message;
                    }
        
        
                    if (empty($_POST['start_date'])) {
                        $message = 'Please input date';
                        return $message;
                    }
        
                    $new_positions = new Position();
                    $new_positions->set_org_id($_POST['org_id']);
                    $new_positions->set_org_struct_id($_POST['org_struct_id']);
                    $new_positions->set_parent_unit_id($_POST['parent_unit_id']);
                    $new_positions->set_pos_code($_POST['pos_code']);
                    $new_positions->set_pos_name($_POST['pos_name']);
                    $new_positions->set_pos_level($_POST['pos_level']);
                    $new_positions->set_overview($_POST['overview']);
                    $new_positions->set_wk_loc_id($_POST['wk_loc_id']);
                    $new_positions->set_lower_sal($_POST['lower_sal']);
                    $new_positions->set_upper_sal($_POST['upper_sal']);
                    $new_positions->set_end_date($_POST['end_date']);
                    $new_positions->set_status($_POST['status']);
                    $new_positions->set_start_date($_POST['start_date']);
                    $new_positions->create();
                    $message = 'positions Created';
                    return $message;

    
            }
            }
        
            public function deletepos()
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
                        $statement = $this->positionsModel->getPosById($id);
                        $delpos = $statement->fetch(PDO::FETCH_ASSOC);
                        if (($_SESSION['role'] == 'ADMIN') || ($_SESSION['can_delete'] == 1)) {
                            if (in_array($delpos['status'], array('UNVERIFY', 'KEYED'))){
                                $message = $this->positionsModel->delete($id);
                                $this->delpositions();
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
        
            public function viewpos()
            {
                
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
        
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                };
                $id = $params['id'];
                $positions = $this->positionsModel->getPosById($id);
                return $positions;
            }
        
            public function viewposs()
            {
                $id =  $_SESSION['id'];
                $role = $_SESSION['role'];
                $statement = $this->positionsModel->view($role, $id);
                return $statement;
            
            }
        
            public function updatepos()
            {
            
                    $update_pos = new Position();
                    $d = array(
                        'id'            => $_REQUEST['id'],
                        'org_id'        => $_REQUEST['org_id'],
                        'org_struct_id'     => $_REQUEST['org_struct_id'],
                        'parent_unit_id'     => $_REQUEST['parent_unit_id'],
                        'pos_code'     => $_REQUEST['pos_code'],
                        'pos_name'     => $_REQUEST['pos_name'],
                        'pos_level'     => $_REQUEST['pos_level'],
                        'overview'     => $_REQUEST['overview'],
                        'wk_loc_id'    => $_REQUEST['wk_loc_id'],
                        'lower_sal'    => $_REQUEST['lower_sal'],
                        'upper_sal'    => $_REQUEST['upper_sal'],
                        'end_date'    => $_REQUEST['end_date'],
                        'status'            => $_REQUEST['status'],
                        'start_date'        => $_REQUEST['start_date']
        
                    );
                    $message = $update_pos->update($d['id'], $d);
                    include_once __DIR__ . "/../view/edtpositions.php";
                    return $message;
                }

                public function positionsList($org_id){
                    $list = $this->positionsModel->findPositions($org_id);
                    return $list;
                }
            
        }
        ?>