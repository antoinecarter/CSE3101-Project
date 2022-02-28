<?php

        include_once __DIR__ . "/../model/tables/positions.php";
        include_once __DIR__ . "/../alert.php";
        
        class PositionsController extends positions
        {
            private $positionsModel;
            public $message;
        
            public function __construct()
            {
                $this->positionsModel = new positions();
            }
        
            
            public function tblpositions()
            {
                include_once __DIR__ . "/../view/tblpositions.php";
            }

            public function frmpositions()
            {
                include_once __DIR__ . "/../view/frmpositions.php";
            }

            public function edtpositions()
            {
                include_once __DIR__ . "/../view/edtpositions.php";
            }

            public function delpositions(){
                include_once __DIR__ . "/../view/delete.php";
            }
    
            public function createpos($d)
            {
                
            }
        
            public function deletepos($id)
            {
                
            }
        
            public function viewpos($role, $id)
            {
                
            }
        
            public function updatepos($id, $d)
            {
                
            }
        }
        ?>