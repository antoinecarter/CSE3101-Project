    <?php

        include_once __DIR__ . "/../model/tables/compyear.php";
        include_once __DIR__ . "/../alert.php";
        
        class CompyearController extends compyear
        {
            private $compyearModel;
            public $message;
        
            public function __construct()
            {
                $this->compyearModel = new compyear();
            }

            public function tblcompyear()
            {
                include_once __DIR__ . "/../view/tblcompyear.php";
            }
        
            public function frmcompyear()
            {
                include_once __DIR__ . "/../view/frmcompyear.php";
            }
        
            public function edtcompyear()
            {
                include_once __DIR__ . "/../view/edtcompyear.php";
            }
        
            public function delcompyear(){
                include_once __DIR__ . "/../view/delete.php";
            }

        public function createcompyr($d)
        {
            
        }

        public function deletecompyr($id)
        {
            
        }

        public function viewcompyr($role, $id)
        {
            
        }

        public function updatecompyr($id, $d)
        {
            
        }
    }
?>