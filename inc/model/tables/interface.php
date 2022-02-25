<?php
    interface crud {
        public function create($d);
 //       public function view_all();
        public function update($id, $d);
        public function delete($id);
        public function view($role, $id);
    }
?>