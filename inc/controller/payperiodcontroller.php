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
        

            public function tblpayperiods()
            {
                include_once __DIR__ . "/../view/tblpayperiods.php";
            }
        
            public function frmpayperiods()
            {
                include_once __DIR__ . "/../view/frmpayperiods.php";
            }
        
            public function edtpayperiods()
            {
                include_once __DIR__ . "/../view/edtpayperiods.php";
            }
        
            public function delpayperiods(){
                include_once __DIR__ . "/../view/delete.php";
            }

            public function createpayp($d)
            {
                
            }
        
            public function deletepayp($id)
            {
                
            }
        
            public function viewpayp($role, $id)
            {
                
            }
        
            public function updatepayp($id, $d)
            {
                
            }
        }
        ?>