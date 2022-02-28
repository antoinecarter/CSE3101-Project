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