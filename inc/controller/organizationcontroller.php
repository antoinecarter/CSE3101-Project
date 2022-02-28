<?php

        include_once __DIR__ . "/../model/tables/organization.php";
        include_once __DIR__ . "/../alert.php";
        
        class OrganizationsController extends organizations
        {
            private $organizationsModel;
            public $message;
        
            public function __construct()
            {
                $this->organizationsModel = new organizations();
            }
        

            public function tblorganizations()
            {
                include_once __DIR__ . "/../view/tblorganizations.php";
            }
        
            public function frmorganizations()
            {
                include_once __DIR__ . "/../view/frmorganizations.php";
            }
        
            public function edtorganizations()
            {
                include_once __DIR__ . "/../view/edtorganizations.php";
            }
        
            public function delorganizations(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createorg($d)
            {
                
            }
        
            public function deleteorg($id)
            {
                
            }
        
            public function vieworg($role, $id)
            {
                
            }
        
            public function updateorg($id, $d)
            {
                
            }
        }
        ?>