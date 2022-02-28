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