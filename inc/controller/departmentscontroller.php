<?php

        include_once __DIR__ . "/../model/tables/departments.php";
        include_once __DIR__ . "/../alert.php";
        
        class DepartmentsController extends departments
        {
            private $departmentsModel;
            public $message;
        
            public function __construct()
            {
                $this->departmentsModel = new departments();
            }

            
            public function tbldepartments()
            {
                include_once __DIR__ . "/../view/tbldepartments.php";
            }

            public function frmdepartments()
            {
                include_once __DIR__ . "/../view/frmdepartments.php";
            }

            public function edtdepartments()
            {
                include_once __DIR__ . "/../view/edtdepartments.php";
            }

            public function deldepartments(){
                include_once __DIR__ . "/../view/delete.php";
            }
                
            public function createdpt($d)
            {
                
            }
        
            public function deletedpt($id)
            {
                
            }
        
            public function viewdpt($role, $id)
            {
                
            }
        
            public function updatedpt($id, $d)
            {
                
            }
        }
        ?>