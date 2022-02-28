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