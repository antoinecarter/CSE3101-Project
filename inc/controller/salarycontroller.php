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