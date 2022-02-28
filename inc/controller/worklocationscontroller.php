<?php

    
        include_once __DIR__ . "/../model/tables/worklocations.php";
        include_once __DIR__ . "/../alert.php";
        
        class WorklocationsController extends worklocations
        {
            private $worklocationsModel;
            public $message;
        
            public function __construct()
            {
                $this->worklocationsModel = new worklocations();
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

            public function creatework($d)
            {
                
            }
        
            public function deletework($id)
            {
                
            }
        
            public function viewwork($role, $id)
            {
                
            }
        
            public function updatework($id, $d)
            {
                
            }
        }
        ?>