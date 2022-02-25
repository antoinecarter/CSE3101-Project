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
                    $d['username'] || $d['passcode'] = 'Please fill out all inputs';
                    header("location: ../index.php");
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
                $method = $_SERVER['REQUEST_METHOD'];
 
                    if ($method == "GET"){
                        include_once __DIR__."/../view/newuser.php";
                    }else{
                    $d = [
                        'first_name' => $this->remove_errors($_POST['first_name']),
                        'last_name' => $this->remove_errors($_POST['last_name']),
                        'username' => $this->remove_errors($_POST['username']),
                        'email' => $this->remove_errors($_POST['email']),
                        'passcode' => $this->remove_errors($_POST['passcode'])
                    ];
        
                    if(empty($d['first_name'])){
                        $d['first_name'] = 'Please enter First name';
                    }

                    if(empty($d['last_name'])){
                        $d['last_name'] = 'Please enter Last name';
                    }

                    if(empty($d['username'])){
                        $d['username'] = 'Please enter Username';
                    }else{
                        if($this->userModel->findUsernameORPassword($d['username'],$d['passcode'])){
                            $d['username'] = 'Email already exist';
                        }
                    }
      
                    if(empty($d['email'])){
                        $d['email'] = 'Please enter email';
                    }else{
                        if($this->userModel->findEmail($d['email'])){
                            $d['email'] = 'Email already exist';
                        }
                    }
 
                    if(empty($d['passcode'])){
                        $d['passcode'] = 'Please enter your password';
                    }elseif(($d['passcode']) < 6){
                        $d['passcode'] = 'Password must be atleast six characters';
                    }

 
                    if(empty($d['first_name']) && empty($d['last_name']) && empty($d['email']) && empty($d['passcode'])){
                        $d['passcode'] = ($d['passcode']);
                        if($this->userModel->createuser($d)){
                            flash('create_success', 'you are registerd you can login now');
                        }
                    }

                
                }
        }

        public function updateuser($id){
                $d = array(
                            'id'		    => $_REQUEST['id'],
                            'first_name' 	=> $_REQUEST['first_name'],
                            'last_name'     => $_REQUEST['last_name'],
                            'email'		    => $_REQUEST['email'],
                            'username'		=> $_REQUEST['username'],
                            'passcode'		=> $_REQUEST['passcode'],
                            'role'		    => $_REQUEST['role'],
                            'emp_no'		=> $_REQUEST['emp_no'],
                            'c_create'		=> $_REQUEST['can_create'],
                            'c_view'		=> $_REQUEST['can_view'],
                            'c_update'		=> $_REQUEST['can_update'],
                            'c_delete'		=> $_REQUEST['can_delete'],
                            'c_verify'		=> $_REQUEST['can_verify'],
                            'c_approve'		=> $_REQUEST['can_approve'],
                            'start_date'	=> $_REQUEST['start_date'],
                            'status'		=> $_REQUEST['status'],
                            'end_date'		=> $_REQUEST['end_date']


                            );		
                    parent::update($id, $d);		
            }    
            
        
    
        public function viewuser($id, $d){
                $user = $this->userModel->getUserById($id);
        
                $d = [
                    'user' => $user
                ];
        
                header('posts/show', $d);
            }
        

        //delete post
        public function delete($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //check for owner
                $deluser = $this->userModel->getUserById($id);
                if($deluser->id != $_SESSION['id']){
                    redirect('');
                }
                
                //call delete method from post model
                if($this->userModel->deleteuser($id)){
                    redirect('');
                }else{
                    die('something went wrong');
                }
            }else{
                redirect('');
            }
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

