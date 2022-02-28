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