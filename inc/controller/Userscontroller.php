<?php

include_once __DIR__ . "/../model/tables/users.php";
include_once __DIR__ . "/../alert.php";

class UsersController extends User
{
    private $userModel;
    public $message;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function home()
    {
        include_once __DIR__ . "/../view/home.php";
    }

    public function log()
    {
        include_once __DIR__ . "/../view/login.php";
    }

    public function tblusers()
    {
        include_once __DIR__ . "/../view/tblusers.php";
    }

    public function frmusers()
    {
        include_once __DIR__ . "/../view/frmusers.php";
    }

    public function edtusers()
    {
        include_once __DIR__ . "/../view/edtusers.php";
    }

    public function delusers(){
        include_once __DIR__ . "/../view/delusers.php";
    }

    public function userlogin()
    {
        if (isset($_SESSION['id'])) {
            session_unset();
            session_destroy();
        }

        $method = $_SERVER["REQUEST_METHOD"];

        if ($method == "GET") {
            include_once __DIR__ . "/../view/login.php";
        } else {
            if (empty($_POST['username']) || empty($_POST['passcode'])) {
                $message = 'Please fill out all inputs';
                return $message;
            }

            if ($this->userModel->findUsernameORPassword($_POST['username'], $_POST['passcode'])) {
                $valid = $this->userModel->login($_POST['username'], $_POST['passcode']);
                if (isset($valid)) {
                    session_start();
                    $_SESSION['id'] = $valid['id'];
                    $_SESSION['username'] = $valid['username'];
                    $_SESSION['pass'] = $valid['passcode'];
                    $_SESSION['role'] = $valid['role'];
                    header('Location: /CSE3101-Project/home');
                    exit();
                } else {
                    $message = "Username/Password Incorrect";         
                    return $message;
                }
            } else {
                $message = "Username/Password Incorrect";    
                return $message;
            }
        }
    }


    public function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        session_destroy();
        include_once __DIR__ . "/../view/login.php";
    }


    public function createuser()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "GET") {
            include_once __DIR__ . "/../view/frmusers.php";
        } else {
            if (empty($_POST['first_name'])) {
                $message = 'Please enter First name';
                return $message;
            }

            if (empty($_POST['last_name'])) {
                $message = 'Please enter Last name';
                return $message;
            }

            if (empty($_POST['username'])) {
                $message = 'Please enter Username';
                return $message;
            } else {
                if ($this->userModel->findUsernameORPassword($_POST['username'], $_POST['passcode'])) {
                    $message = 'Username already exist';
                    return $message;
                }
            }

            if (empty($_POST['email'])) {
                $message = 'Please enter email';
                return $message;
            } else {
                if ($this->userModel->findEmail($_POST['email'])) {
                    $message = 'Email already exist';
                    return $message;
                }
            }

            if (empty($_POST['passcode'])) {
                $message = 'Please enter your password';
            } elseif (($_POST['passcode']) < 6) {
                $message = 'Password must be atleast six characters';
                return $message;
            }

            if (empty($_POST['role'])) {
                $message = 'Please select role';
                return $message;
            }

            if (empty($_POST['status'])) {
                $message = 'Please select status';
                return $message;
            }

            if (empty($_POST['start_date'])) {
                $message = 'Please input start date';
                return $message;
            }

            $new_user = new User();
            $new_user->set_fname($_POST['first_name']);
            $new_user->set_lname($_POST['last_name']);
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

    public function updateuser()
    {
        $update_user = new User();
        $d = array(
            'id'            => $_REQUEST['id'],
            'org_id'        => $_REQUEST['org_id'],
            'first_name'     => $_REQUEST['first_name'],
            'last_name'     => $_REQUEST['last_name'],
            'email'            => $_REQUEST['email'],
            'username'        => $_REQUEST['username'],
            'passcode'        => $_REQUEST['passcode'],
            'role'            => $_REQUEST['role'],
            'emp_no'        => $_REQUEST['emp_no'],
            'can_create'        => $_REQUEST['can_create'],
            'can_view'        => $_REQUEST['can_view'],
            'can_update'        => $_REQUEST['can_update'],
            'can_delete'        => $_REQUEST['can_delete'],
            'can_verify'        => $_REQUEST['can_verify'],
            'can_approve'        => $_REQUEST['can_approve'],
            'start_date'    => $_REQUEST['start_date'],
            'status'        => $_REQUEST['status'],
            'end_date'        => $_REQUEST['end_date']
        );
        $message = $update_user->update($d['id'], $d);
        include_once __DIR__ . "/../view/edtusers.php";
        return $message;
    }

    public function viewuser()
    {
        
        $url = $_SERVER['REQUEST_SCHEME'] . '://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];

        $url_components = parse_url($url);
        if(isset($url_components['query'])){
            parse_str($url_components['query'], $params);
        };
        $id = $params['id'];
        $user = $this->userModel->getUserById($id);
        return $user;
    }

    public function viewusers(){
        $id =  $_SESSION['id'];
        $role = $_SESSION['role'];
        $statement = $this->userModel->view($role, $id);
        return $statement;
    }

    public function deleteuser()
    {
        if ($_SERVER['REQUEST_METHOD'] = 'POST') {
            $url = $_SERVER['REQUEST_SCHEME'] . '://';
            $url .= $_SERVER['HTTP_HOST'];
            $url .= $_SERVER['REQUEST_URI'];

            $url_components = parse_url($url);
            if(isset($url_components['query'])){
                parse_str($url_components['query'], $params);
            };
            $id = $params['id'];
            $deluser = $this->userModel->getUserById($id);
            if ($deluser['id'] != $_SESSION['id']) {
                if (($deluser['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                    $message = $this->userModel->delete($id);
                    return $message;
                } else {
                    $message = 'User is an Admin/You are not an Admin';
                    return $message;
                }
            } else {
                $message = 'Error! Cannot delete logged-in user';
                return $message;
            }
        }
    }

    public function approveuser()
    {
        $id = $_SESSION['id'];
        $app = $this->userModel->approve($id);
        return $app;
    }

    public function verifyuser()
    {
        $id = $_SESSION['id'];
        $ver = $this->userModel->verify($id);
        return $ver;
    }
}


$init = new UsersController;

if ($_SERVER['REQUEST_METHOD'] == 'post') {
    switch ($_POST['type']) {
        case 'login':
            $init->userlogin();
            break;
        default:
            header('Location: Location: /CSE3101-Project/inc/view/login.php');
    }
}
