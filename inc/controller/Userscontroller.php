<?php

    include_once __DIR__."/../model/tables/users.php";
    include_once __DIR__."/../alert.php";

    class UsersController extends User
    {
        private $userModel;
        public $message;

        public function __construct()
        {
            $this->userModel = new User();
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

                if(empty($_POST['username']) || empty($_POST['passcode'])){
                    //alert('login',"Please fill out all inputs");
                    $_POST['username'] || $_POST['passcode'] = 'Please fill out all inputs';
                    header("location: ../index.php");
                    exit();
                }
                

                if($this->userModel->findUsernameORPassword($_POST['username'], $_POST['passcode'])){
                    $valid = $this->userModel->login($_POST['username'], $_POST['passcode']);
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


    public function logout(){
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        session_destroy();
        header("Location:/CSE3101-Project/inc/view/login.php");

    }


        public function createuser(){
            $method = $_SERVER['REQUEST_METHOD'];

            if ($method == "GET"){
                include_once __DIR__."/../view/newuser.php";
            }else{
                if(empty($_POST['fName'])){
                    $message = 'Please enter First name';
                    return $message;
                }

                if(empty($_POST['lName'])){
                    $message = 'Please enter Last name';
                    return $message;
                }

                if(empty($_POST['username'])){
                    $message = 'Please enter Username';
                    return $message;
                }else{
                    if($this->userModel->findUsernameORPassword($_POST['username'],$_POST['passcode'])){
                        $message = 'Username already exist';
                        return $message;
                    }
                }

                if(empty($_POST['email'])){
                    $message = 'Please enter email';
                    return $message;
                }else{
                    if($this->userModel->findEmail($_POST['email'])){
                        $message = 'Email already exist';
                        return $message;
                    }
                }

                if(empty($_POST['passcode'])){
                    $message = 'Please enter your password';
                }elseif(($_POST['passcode']) < 6){
                    $message = 'Password must be atleast six characters';
                    return $message;
                }

                /*
                if(empty($_POST['fName']) && empty($_POST['lName']) && empty($_POST['email']) && empty($_POST['passcode'])){
                    $message = ($_POST['passcode']);
                    if($this->userModel->createuser($d)){
                        flash('create_success', 'you are registerd you can login now');
                    }
                }*/

                if(empty($_POST['role'])){
                    $message = 'Please select role';
                    return $message;
                }
                
                if(empty($_POST['status'])){
                    $message = 'Please select status';
                    return $message;
                }

                if(empty($_POST['start_date'])){
                    $message = 'Please input start date';
                    return $message;
                }

                $new_user = new User();
                $new_user->set_fname($_POST['fName']);
                $new_user->set_lname($_POST['lName']);
                $new_user->set_email($_POST['email']);
                $new_user->set_username($_POST['username']);
                $new_user->set_passcode($_POST['passcode']);
                $new_user->set_role($_POST['role']);
                $new_user->set_start_date($_POST['start_date']);
                $new_user->set_status($_POST['status']);
                $new_user->create();
                $message = 'User Created';
                return $message;
            }
        }

        public function updateuser(){

                $d = array(
                            'id'		    => $_REQUEST['id'],
                            'org_id'        => $_REQUEST['org_id'],
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
                    parent::update($d['id'], $d);		
            }    
            
        public function viewuser(){
            $id = $_GET['user_id'];
            $user = $this->userModel->getUserById($id);
            return $user;
        }
        
        public function deleteuser(){
            if($_SERVER['REQUEST_METHOD'] = 'POST'){
                $id = $_POST['id'];
                $deluser = $this->userModel->getUserById($id);
                if($deluser['id'] != $_SESSION['id']){
                    if(($deluser['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')){
                        $this->userModel->delete($id);
                        header('Location: ');
                        $message = "User deleted";
                        return $message;
                    }else{
                        $message = 'User is an Admin/You are not an Admin';
                        return $message;
                    }
                }else{
                    $message = 'Error! Cannot delete logged-in user';
                    return $message;
                }
            }
        }
              
        public function approveuser(){
            $id = $_SESSION['id'];
            $app = $this->userModel->approve($id);
            return $app;
        }

        public function verifyuser(){
            $id = $_SESSION['id'];
            $ver = $this->userModel->verify($id);
            return $ver;
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
