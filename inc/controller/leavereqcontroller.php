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

                    
            public function tblleaverequests()
            {
                include_once __DIR__ . "/../view/tblleaverequests.php";
            }

            public function frmleaverequests()
            {
                include_once __DIR__ . "/../view/frmleaverequests.php";
            }

            public function edtleaverequests()
            {
                include_once __DIR__ . "/../view/edtleaverequests.php";
            }

            public function delleaverequests(){
                include_once __DIR__ . "/../view/delete.php";
            }
        
            public function createlevreq($d)
            {
                
            }
        
            public function deletelevreq($id)
            {
                
            }
        
            public function viewlevreq($role, $id)
            {
                
            }
        
            public function updatelevreq($id, $d)
            {
                
            }
        }
        ?>