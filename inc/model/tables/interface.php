<?php
    interface crud {
        public function create();
 //       public function view_all();
        public function update($id);
        public function delete($id);
        public function verify($role);
        public function approve($role);
        public function view($role, $id);
        public function remove_errors($d);
    }
?>