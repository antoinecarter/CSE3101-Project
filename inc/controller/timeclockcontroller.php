<?php


        include_once __DIR__ . "/../model/tables/timeclock.php";
        include_once __DIR__ . "/../alert.php";
        
        class TimeclocksController extends timeclocks
        {
            private $timeclocksModel;
            public $message;
        
            public function __construct()
            {
                $this->timeclocksModel = new timeclocks();
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