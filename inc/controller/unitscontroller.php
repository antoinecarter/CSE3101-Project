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
        

            public function tblunits()
            {
                include_once __DIR__ . "/../view/tblunits.php";
            }
        
            public function frmunits()
            {
                include_once __DIR__ . "/../view/frmunits.php";
            }
        
            public function edtunits()
            {
                include_once __DIR__ . "/../view/edtunits.php";
            }
        
            public function delunits(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createunits($d)
            {
                
            }
        
            public function deleteunits($id)
            {
                
            }
        
            public function viewunits($role, $id)
            {
                
            }
        
            public function updateunits($id, $d)
            {
                
            }
        }
        ?>