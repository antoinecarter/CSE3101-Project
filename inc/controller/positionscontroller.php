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