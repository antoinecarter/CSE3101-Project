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
        

            public function tblreferences()
            {
                include_once __DIR__ . "/../view/tblreferences.php";
            }
        
            public function frmreferences()
            {
                include_once __DIR__ . "/../view/frmreferences.php";
            }
        
            public function edtreferences()
            {
                include_once __DIR__ . "/../view/edtreferences.php";
            }
        
            public function delreferences(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createref($d)
            {
                
            }
        
            public function deleteref($id)
            {
                
            }
        
            public function viewref($role, $id)
            {
                
            }
        
            public function updateref($id, $d)
            {
                
            }
        }
        ?>