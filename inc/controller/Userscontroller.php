<?php
include_once("inc/model/tables/users.php");

    class UsersController extends User
    {
        private $user_obj;
        private $controller;
        
            public function login($data){
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                   // process form
                   $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
                   $data = [
                       'username' => trim($_POST['username']),
                       'passcode' => trim($_POST['passcode']),
                       'username_err' => '',
                       'passcode_err' => ''
                   ];
        
                    //validate username
                    if(empty($data['username'])){
                        $data['username_err'] = 'Please enter username';
                    }else{
                        if($this->userModel->findUserByEmail($data['username'])){
                            //user found
                        }else{
                            $data['username_err'] = 'User not found';
                        }
                    }
        
                    //validate passcode 
                    if(empty($data['passcode'])){
                        $data['passcode_err'] = 'Please enter your passcode';
                    }elseif(strlen($data['password']) < 6){
                        $data['passcode_err'] = 'passcode must be atleast six characters';
                    }
                    

            }
    }
}