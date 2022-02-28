<?php 

        include_once __DIR__ . "/../model/tables/references.php";
        include_once __DIR__ . "/../alert.php";
        
        class ReferencesController extends references
        {
            private $referencesModel;
            public $message;
        
            public function __construct()
            {
                $this->referencesModel = new references();
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