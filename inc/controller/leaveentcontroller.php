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

            
            public function tblleaveentitlemt()
            {
                include_once __DIR__ . "/../view/tblleaveentitlemt.php";
            }

            public function frmleaveentitlemt()
            {
                include_once __DIR__ . "/../view/frmleaveentitlemt.php";
            }

            public function edtleaveentitlemt()
            {
                include_once __DIR__ . "/../view/edtleaveentitlemt.php";
            }

            public function delleaveentitlemt(){
                include_once __DIR__ . "/../view/delete.php";
            }
        
            public function createleven($d)
            {
                
            }
        
            public function deleteleven($id)
            {
                
            }
        
            public function viewleven($role, $id)
            {
                
            }
        
            public function updateleven($id, $d)
            {
                
            }
        }
        ?>