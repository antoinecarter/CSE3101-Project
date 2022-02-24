<?php

    include_once __DIR__."/../model/tables/users.php";
    include_once __DIR__."/../alert.php";

    class UsersController extends User
    {
        private $userModel;
        public $message;

        public function __construct()
        {
            $this->userModel = new User;
        }
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
        public function home(){
            include_once __DIR__."/../view/home.php";
        }
        
        public function userlogin(){
            $method = $_SERVER["REQUEST_METHOD"];
            
            if($method == "GET"){
                include_once __DIR__."/../view/login.php";
            }else{         
                $d = [
                    'username' => $this->remove_errors($_POST['username']),
                    'passcode' => $this->remove_errors($_POST['passcode']) 
                ];

                if(empty($d['username']) || empty($d['passcode'])){
                    //alert('login',"Please fill out all inputs");
                    $this->message = "Please fill out all inputs";
                    header("Location: /CSE3101-Project/");
                    exit();
                }

                if($this->userModel->findUsernameORPassword($d['username'], $d['passcode'])){
                    $valid = $this->userModel->login($d['username'], $d['passcode']);
                    if($valid){
                        session_start();
                        $_SESSION['id'] = $valid['id'];
                        $_SESSION['username'] = $valid['username'];
                        $_SESSION['pass'] = $valid['passcode'];
                        $_SESSION['role'] = $valid['role'];
                        header('Location: /CSE3101-Project/home');
                        exit();
                    }else{
                        $this->message = "Username/Password Incorrect";
                        //alert('login',"Username/Password Incorrect");
                        header("Location: /CSE3101-Project/");
                        
                        exit();
                        
                    }

                }else{
                    //alert('login',"User not found");
                    $this->message = "User not found";
                    header("Location: /CSE3101-Project/");
                    exit();
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

    $init = new UsersController;

    if($_SERVER['REQUEST_METHOD'] == 'post'){
        switch($_POST['type']){
            case 'login':
                $init->userlogin();
                break;
            default:
                header('Location: Location: /CSE3101-Project/inc/view/login.php');
        }
    }

?>

