<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";

    class user_crud extends Database implements crud {
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
            $sql = "INSERT INTO users(first_name, last_name, email, username, passcode, role) 
                                VALUES (:first_name, :last_name, :email, :username, :passcode, :role)";
            
            $new_user = [
                "first_name" => $this->first_name,
                "last_name" => $this->last_name,
                "email" => $this->email,
                "username" => $this->username,
                "passcode" => $this->passcode,
                "role" => $this->role
            ];

            try{
                $statement = $this->connection->prepare($sql);
                $statement->exec($new_user);
                header("location: /CSE3101-Project/");
            }catch(PDOException $message){
                echo $message->getMessage();
            }
            
        }

        public function view()
        {
            $sql = "SELECT * FROM users";
            $statement = $this->connection->prepare($sql);
            return $statement->fetchAll(PDO::FETCH_CLASS, 'user_crud');
        }

        public function update()
        {
            $sql = "UPDATE users SET ";
        }

        public function delete()
        {
            
        }

        public function find($id)
        {
            
        }

        public function verify()
        {
            
        }

        public function approve()
        {
            
        }
    }

?>