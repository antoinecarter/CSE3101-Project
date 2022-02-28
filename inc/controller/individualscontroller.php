<?php

        include_once __DIR__ . "/../model/tables/individuals.php";
        include_once __DIR__ . "/../alert.php";
        
        class IndividualsController extends individuals
        {
            private $individualsModel;
            public $message;
        
            public function __construct()
            {
                $this->individualsModel = new individuals();
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