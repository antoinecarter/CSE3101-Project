<?php


        include_once __DIR__ . "/../model/tables/leaveent.php";
        include_once __DIR__ . "/../alert.php";
        
        class LeaveentitlemtController extends leaveentitlemt
        {
            private $leaveentitlemtModel;
            public $message;
        
            public function __construct()
            {
                $this->leaveentitlemtModel = new leaveentitlemt();
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