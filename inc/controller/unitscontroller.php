<?php
    
        include_once __DIR__ . "/../model/tables/units.php";
        include_once __DIR__ . "/../alert.php";
        
        class UnitsController extends units
        {
            private $unitsModel;
            public $message;
        
            public function __construct()
            {
                $this->unitsModel = new units();
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