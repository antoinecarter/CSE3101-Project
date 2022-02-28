<?php

        include_once __DIR__ . "/../model/tables/employees.php";
        include_once __DIR__ . "/../alert.php";
        
        class EmployeesController extends employees
        {
            private $employeesModel;
            public $message;
        
            public function __construct()
            {
                $this->employeesModel = new employees();
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