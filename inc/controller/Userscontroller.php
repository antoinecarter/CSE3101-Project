<?php
    include_once __DIR__."/../model/tables/users.php";

    class UsersController extends User
    {
        /*
        public function __construct()
        {
            $this->userobj = new User;
        }
        
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
        }*/

        public function userlogin(){
            $method = $_SERVER["REQUEST_METHOD"];
            
            
            if($method == "GET"){
                include_once __DIR__."/../view/login.php";
            }else{
                $d = [
                    'username' => $_POST['username'],
                    'passcode' => $_POST['passcode']
                ];

                $valid = $this->login($d);
                if($valid){
                    header("Location: /CSE3101-Project/inc/view/Afterlogin.php");
                }
            }
            
        }

        public function createuser(){

        }

        public function updateuser(){

        }

        public function viewuser(){

        }

        public function deleteuser(){

        }

        public function approveuser(){

        }

        public function verifyuser(){

        }

    }

