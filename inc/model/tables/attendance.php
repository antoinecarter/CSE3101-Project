<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";

    class attendance implements crud {
        private $id;
        private $org_id;
        private $first_name;
        private $last_name;
        private $email;
        private $username;
        private $passcode;
        private $role;
        private $emp_no;

        private $start_date;
        private $end_date;
        private $status;

        protected $connection;

        public function __construct()
        {
            $this->connection = new Database;
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
            try{
                $this->connection->query("INSERT INTO users(first_name, last_name, email, username, passcode, role, status, start_date) 
                                                VALUES (:first_name, :last_name, :email, :username, :passcode, :role, :status, :start_date)");
                $this->connection->bind(':first_name',$this->first_name);
                $this->connection->bind(':last_name',$this->last_name);
                $this->connection->bind(':email',$this->email);
                $this->connection->bind(':username',$this->username);
                $this->connection->bind(':passcode',$this->passcode);
                $this->connection->bind(':role',$this->role);
                $this->connection->bind(':status',$this->status);
                $this->connection->bind(':start_date',$this->start_date);
                
                $this->connection->execute();
                
                $this->id = $this->connection->get_connection()->lastInsertId();
            }catch(PDOException $message){
                echo $message->getMessage();
            }
            
        }

        public function update($id, $d)
        {
            if($d['end_date'] == null){
                $this->connection->query("UPDATE users SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE users SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }

            if($d['passcode'] != NULL){
                $this->connection->query("UPDATE users 
                                        SET 
                                            org_id = :org_id, first_name = :first_name, last_name = :last_name, email = :email, username = :username, passcode = :passcode, employee_no = :emp_no, role = :role, start_date = :start_date, status = :status
                                        WHERE
                                            id = :id");
            
                $this->connection->bind(':id', $id);
                $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
                $this->connection->bind(':first_name', $this->remove_errors($d['first_name']));
                $this->connection->bind(':last_name', $this->remove_errors($d['last_name']));
                $this->connection->bind(':email', $this->remove_errors($d['email']));
                $this->connection->bind(':username', $this->remove_errors($d['username']));
                $this->connection->bind(':passcode', $this->remove_errors(md5($d['passcode'])));
                $this->connection->bind(':role', $this->remove_errors($d['role']));
                $this->connection->bind(':emp_no', $this->remove_errors($d['emp_no']));

                $this->connection->bind(':start_date', $this->remove_errors(date('Y-m-d', strtotime($d['start_date']))));
                $this->connection->bind(':status', $this->remove_errors($d['status']));
            }else{
                $this->connection->query("UPDATE users 
                                        SET 
                                            org_id = :org_id, first_name = :first_name, last_name = :last_name, email = :email, username = :username, employee_no = :emp_no, role = :role, start_date = :start_date, status = :status
                                        WHERE
                                            id = :id");
            
                $this->connection->bind(':id', $id);
                $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
                $this->connection->bind(':first_name', $this->remove_errors($d['first_name']));
                $this->connection->bind(':last_name', $this->remove_errors($d['last_name']));
                $this->connection->bind(':email', $this->remove_errors($d['email']));
                $this->connection->bind(':username', $this->remove_errors($d['username']));
                $this->connection->bind(':role', $this->remove_errors($d['role']));
                $this->connection->bind(':emp_no', $this->remove_errors($d['emp_no']));

                $this->connection->bind(':start_date', $this->remove_errors(date('Y-m-d', strtotime($d['start_date']))));
                $this->connection->bind(':status', $this->remove_errors($d['status']));
            }
            

            try{
                $this->connection->execute();
                $message = "User Account Updated";
                return $message;
            }catch(PDOException $message){
                echo $message->getMessage();
            }
        }

        public function delete($id)
        {
            $this->connection->query( "DELETE FROM users WHERE id= :id");
            $this->connection->bind(':id', $id);
            try{
                $this->connection->execute();
                $message = "User Account Removed";
                return $message;
            }catch(PDOException $message){
                echo $message->getMessage();
            }         
        }


        public function view($role, $id)
        {
            if($role == 'ADMIN'){
                $this->connection->query("SELECT * FROM users");
                $statement = $this->connection->getStatement();
                return $statement;
            }else{
                $this->connection->query("SELECT * FROM users WHERE id= :id");
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }    
        }
        

        public function getAttById($id){
            $this->connection->query('SELECT * FROM users WHERE id = :id');
            $this->connection->bind(':id', $id);
            $row = $this->connection->getStatement();
    
            return $row;
        }



        public function get_id(){
            return $this->id;
        }

        public function get_ord_id(){
            return $this->org_id;
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


        public function get_start_date(){
            return $this->start_date;
        }

        public function get_end_date(){
            return $this->end_date;
        }

        public function get_status(){
            return $this->status;
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


        public function set_start_date($start_date){
            return $this->start_date = $start_date;
        }
    }

?>