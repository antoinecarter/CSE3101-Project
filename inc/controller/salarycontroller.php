<?php

        include_once __DIR__ . "/../model/tables/salary.php";
        include_once __DIR__ . "/../alert.php";
        
        class SalaryController extends salary
        {
            private $salaryModel;
            public $message;
        
            public function __construct()
            {
                $this->salaryModel = new salary();
            }
        

            public function tblsalary()
            {
                include_once __DIR__ . "/../view/tblsalary.php";
            }
        
            public function frmsalary()
            {
                include_once __DIR__ . "/../view/frmsalary.php";
            }
        
            public function edtsalary()
            {
                include_once __DIR__ . "/../view/edtsalary.php";
            }
        
            public function delsalary(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createsal($d)
            {
                
            }
        
            public function deletesal($id)
            {
                
            }
        
            public function viewsal($role, $id)
            {
                
            }
        
            public function updatesal($id, $d)
            {
                
            }
        }
        ?>