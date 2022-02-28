<?php


        include_once __DIR__ . "/../model/tables/payperiod.php";
        include_once __DIR__ . "/../alert.php";
        
        class PayperiodsController extends payperiods
        {
            private $payperiodsModel;
            public $message;
        
            public function __construct()
            {
                $this->payperiodsModel = new payperiods();
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