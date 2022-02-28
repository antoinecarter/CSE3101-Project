<?php 

        include_once __DIR__ . "/../model/tables/leavereq.php";
        include_once __DIR__ . "/../alert.php";
        
        class LeaverequestsController extends leaverequests
        {
            private $leaverequestsModel;
            public $message;
        
            public function __construct()
            {
                $this->leaverequestsModel = new leaverequests();
            }
        
            public function create($d)
            {
                
            }
        
            public function delete($id)
            {
                
            }
        
            public function view($role, $id)
            {
                
            }
        
            public function update($id, $d)
            {
                
            }
        }
        ?>