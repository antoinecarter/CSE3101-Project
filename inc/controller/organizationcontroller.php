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