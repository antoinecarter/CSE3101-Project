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
        
            
            public function tblindividuals()
            {
                include_once __DIR__ . "/../view/tblindividuals.php";
            }

            public function frmindividuals()
            {
                include_once __DIR__ . "/../view/frmindividuals.php";
            }

            public function edtindividuals()
            {
                include_once __DIR__ . "/../view/edtindividuals.php";
            }

            public function delindividuals(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createindv($d)
            {
                
            }
        
            public function deleteindv($id)
            {
                
            }
        
            public function viewindv($role, $id)
            {
                
            }
        
            public function updateindv($id, $d)
            {
                
            }
        }
        ?>