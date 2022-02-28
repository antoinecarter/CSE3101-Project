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
        
            
            public function tblemployees()
            {
                include_once __DIR__ . "/../view/tblemployees.php";
            }

            public function frmemployees()
            {
                include_once __DIR__ . "/../view/frmemployees.php";
            }

            public function edtemployees()
            {
                include_once __DIR__ . "/../view/edtemployees.php";
            }

            public function delemployees(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createemps($d)
            {
                
            }
        
            public function deleteemps($id)
            {
                
            }
        
            public function viewemps($role, $id)
            {
                
            }
        
            public function updateemps($id, $d)
            {
                
            }
        }
        ?>