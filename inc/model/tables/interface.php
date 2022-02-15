<?php
    interface crud {
        public function create();
        public function view();
        public function update();
        public function delete();
        public function verify();
        public function approve();
        public function find($id);
    }
?>