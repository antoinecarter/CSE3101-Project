<?php


        include_once __DIR__ . "/../model/tables/shifts.php";
        include_once __DIR__ . "/../alert.php";
        
        class ShiftsController extends shifts
        {
            private $shiftsModel;
            public $message;
        
            public function __construct()
            {
                $this->shiftsModel = new shifts();
            }

            
            public function tblshifts()
            {
                include_once __DIR__ . "/../view/tblshifts.php";
            }

            public function frmshifts()
            {
                include_once __DIR__ . "/../view/frmshifts.php";
            }

            public function edtshifts()
            {
                include_once __DIR__ . "/../view/edtshifts.php";
            }

            public function delshifts(){
                include_once __DIR__ . "/../view/delete.php";
            }
        
            public function createshift($d)
            {
                
            }
        
            public function deleteshift($id)
            {
                
            }
        
            public function viewshift($role, $id)
            {
                
            }
        
            public function updateshift($id, $d)
            {
                
            }
        }
        ?>