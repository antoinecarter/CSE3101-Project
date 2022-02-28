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

                    
            public function tbltimeclocks()
            {
                include_once __DIR__ . "/../view/tbltimeclocks.php";
            }

            public function frmtimeclocks()
            {
                include_once __DIR__ . "/../view/frmtimeclocks.php";
            }

            public function edttimeclocks()
            {
                include_once __DIR__ . "/../view/edttimeclocks.php";
            }

            public function deltimeclocks(){
                include_once __DIR__ . "/../view/delete.php";
            }
        
            public function createtime($d)
            {
                
            }
        
            public function deletetime($id)
            {
                
            }
        
            public function viewtime($role, $id)
            {
                
            }
        
            public function updatetime($id, $d)
            {
                
            }
        }
        ?>