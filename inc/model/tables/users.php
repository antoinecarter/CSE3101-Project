<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";

    class User extends Database implements crud {
        private $first_name;
        private $last_name;
        private $email;
        private $username;
        private $passcode;
        private $role;
        private $emp_no;
        private $can_create; 
        private $can_view;
        private $can_update; 
        private $can_delete; 
        private $can_verify;
        private $can_approve;
        private $start_date;
        private $end_date;
        private $status;

        public function __construct()
        {
            $this->connect();
        }

        public function remove_errors($d)
        {
            $d = trim($d);
            $d = stripslashes($d);
            $d = htmlspecialchars($d);
            return $d;
        }

        public function create()
        {
            $sql = "INSERT INTO users(first_name, last_name, email, username, passcode, role, status, start_date) 
                                VALUES (:first_name, :last_name, :email, :username, :passcode, :role, :status, :start_date)";
            
            $new_user = [
                "first_name" => $this->remove_errors($this->first_name) ,
                "last_name" => $this->remove_errors($this->last_name) ,
                "email" => $this->remove_errors($this->email) ,
                "username" => $this->remove_errors($this->username) ,
                "passcode" => $this->remove_errors($this->passcode) ,
                "role" => $this->remove_errors($this->role), 
                "start_date" => $this->remove_errors($this->start_date),
                "status" => $this->remove_errors($this->status) 
            ];

            try{
                $statement = $this->connection->prepare($sql);
                $statement->exec($new_user);
                $this->id = $this->connection->lastInsertId();
                $message = 'Account Created';
                return $message;
                header("location: /CSE3101-Project/");
            }catch(PDOException $message){
                echo $message->getMessage();
            }
            
        }
/*
        public function view_all()
        {
            if($this->role == 'ADMIN'){
                $sql = "SELECT * FROM users";
            }

            
            $statement = $this->connection->prepare($sql);
            return $statement->fetchAll(PDO::FETCH_CLASS, 'User');
        }
        */

        public function update($id)
        {
            $sql = "UPDATE 
                        users 
                    SET 
                        first_name = :first_name, 
                        last_name = :last_name,
                        email = :email,
                        username = :username,
                        passcode = :passcode,
                        employee_no = :emp_no,
                        role = :role,
                        can_create = :c_create,
                        can_view = :c_view,
                        can_update = :c_update,
                        can_delete = :c_delete,
                        can_verify = :c_verify,
                        can_approve = :c_approve,
                        start_date = :start_date,
                        end_date = :end_date,
                        status = :status
                    WHERE
                        id = :id";
            
            $update_user = [
                "id" => $id,
                "first_name" => $this->remove_errors($this->first_name) ,
                "last_name" => $this->remove_errors($this->last_name) ,
                "email" => $this->remove_errors($this->email) ,
                "username" => $this->remove_errors($this->username) ,
                "passcode" => $this->remove_errors($this->passcode) ,
                "role" => $this->remove_errors($this->role),
                "emp_no" => $this->remove_errors($this->emp_no),
                "c_create" => $this->remove_errors($this->can_create),
                "c_view" => $this->remove_errors($this->can_view),
                "c_update" => $this->remove_errors($this->can_update),
                "c_delete" => $this->remove_errors($this->can_delete),
                "c_verify" => $this->remove_errors($this->can_verify),
                "c_approve" => $this->remove_errors($this->can_approve),
                "start_date" => $this->remove_errors($this->start_date),
                "status" => $this->remove_errors($this->status),
                "end_date" => $this->remove_errors($this->end_date)
            ];

            try{
                $statement = $this->connection->prepare($sql);
                $statement->exec($update_user);
                $message = "User Account Updated";
                return $message;
            }catch(PDOException $message){
                echo $message->getMessage();
            }
        }

        public function delete($id)
        {
            $sql = "DELETE FROM users WHERE id= :id";
            try{
                $statement = $this->connection->prepare($sql);
                $statement->execute(['id'=> $id]);
                header('Location: ');
            }catch(PDOException $message){
                echo $message->getMessage();
            }         
        }

        public function view($role, $id)
        {
            if($this->role == $role){
                $sql = "SELECT * FROM users";
                $statement = $this->connection->prepare($sql);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_CLASS, 'User');
            }else{
                $sql = "SELECT * FROM users WHERE id= :id";
                $statement = $this->connection->prepare($sql);
                $statement->execute(['id' => $id]);
                return $statement->fetchObject();
            }
            
            
        }

        public function login($data)
        {
            $username = $this->remove_errors($data['username']);
            $passcode = $this->remove_errors(md5($data['passcode']));

            try{
                $sql = "SELECT username, passcode FROM users WHERE username = :username AND passcode = :passcode LIMIT 1";
                $userlogin = [
                    "username" => $username,
                    "passcode" => $passcode
                ];

                $statement = $this->connection->prepare($sql);
                $statement->execute($userlogin);
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                if($statement->rowCount() > 0){
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['pass'] = $row['passcode'];
                    $_SESSION['role'] = $row['role'];
                    return true;
                }else{
                    $message = "Invalid UserLogin Attempt";
                    require_once __DIR__."/../../view/login.php";
                }

            }catch(PDOException $message){
                echo $message->getMessage();
                
            }
            return $message;
        }

        public function logout(){
            session_unset();
            header('Location: /CSE3101-Project/login');
        }

        public function findcreds($d){
            $username = $this->remove_errors($d['username']);
            $passcode = $this->remove_errors(md5($d['passcode']));

            $sql = "SELECT username, passcode FROM users WHERE username = :username AND passcode = :passcode LIMIT 1";
            $userlogin = [
                "username" => $username,
                "passcode" => $passcode
            ];
        }

        public function verify($role)
        {
            if($this->role == $role){

            }
        }

        public function approve($role)
        {
            
        }

        public function get_fname(){
            return $this->first_name;
        }

        public function get_lname(){
            return $this->last_name;
        }

        public function get_email(){
            return $this->email;
        }

        public function get_username(){
            return $this->username;
        }

        public function get_passcode(){
            return $this->passcode;
        }

        public function get_role(){
            return $this->role;
        }

        public function get_emp_no(){
            return $this->emp_no;
        }

        public function get_can_create(){
            return $this->can_create;
        }

        public function get_can_view(){
            return $this->can_view;
        }

        public function get_can_update(){
            return $this->can_update;
        }

        public function get_can_delete(){
            return $this->can_delete;
        }

        public function get_can_verify(){
            return $this->can_verify;
        }

        public function get_can_approve(){
            return $this->can_approve;
        }

        public function set_fname($fname){
            return $this->first_name = $fname;
        }

        public function set_lname($lname){
            return $this->last_name = $lname;
        }

        public function set_email($email){
            return $this->email = $email;
        }

        public function set_username($username){
            return $this->username = $username;
        }

        public function set_passcode($passcode){
            return $this->passcode = md5($passcode);
        }

        public function set_role($role){
            return $this->role = $role;
        }

        public function set_emp_no($emp_no){
            return $this->emp_no = $emp_no;
        }

        public function set_can_create($can_create){
            return $this->can_create = $can_create;
        }

        public function set_can_view($can_view){
            return $this->can_view = $can_view;
        }

        public function set_can_update($can_update){
            return $this->can_update = $can_update;
        }

        public function set_can_delete($can_delete){
            return $this->can_delete = $can_delete;
        }

        public function set_can_verify($can_verify){
            return $this->can_verify = $can_verify;
        }

        public function set_can_approve($can_approve){
            return $this->can_approve =$can_approve;
        }
    }

?>