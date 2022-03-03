<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";

    class Individual implements crud {
        private $id;
        private $org_id;
        private $first_name;
        private $surname;
        private $sex;
        private $date_of_birth; 
        private $place_of_birth; 
        private $email; 
        private $nationality; 
        private $ethnicity;
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
                $this->connection->query("INSERT INTO individuals(org_id, first_name, surname,  sex, date_of_birth, place_of_birth, email, nationality, ethnicity, status) 
                                                VALUES (:org_id, :first_name, :surname, :sex, :date_of_birth, :place_of_birth, :email, :nationality, :ethnicity, :status)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':first_name',$this->first_name);
                $this->connection->bind(':surname',$this->surname);
                $this->connection->bind(':sex',$this->sex);
                $this->connection->bind(':date_of_birth',$this->date_of_birth);
                $this->connection->bind(':place_of_birth',$this->place_of_birth);
                $this->connection->bind(':email',$this->email);
                $this->connection->bind(':nationality',$this->nationality);
                $this->connection->bind(':ethnicity',$this->ethnicity);
                $this->connection->bind(':status',$this->status);
                $this->connection->execute();
                
                $this->id = $this->connection->get_connection()->lastInsertId();
            }catch(PDOException $message){
                echo $message->getMessage();
            }
            
        }

        public function update($id, $d)
        {
                $this->connection->query("UPDATE individuals 
                                        SET 
                                            org_id = :org_id, first_name = :first_name, surname = :surname, 
                                            sex = :sex, date_of_birth = :date_of_birth, place_of_birth = :place_of_birth, 
                                            email = :email, nationality = :nationality, ethnicity = :ethnicity, status = :status
                                        WHERE
                                            id = :id");
            
                $this->connection->bind(':id', $id);
                $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
                $this->connection->bind(':first_name', $this->remove_errors($d['first_name']));
                $this->connection->bind(':surname', $this->remove_errors($d['surname']));
                $this->connection->bind(':sex', $this->remove_errors($d['sex']));
                $this->connection->bind(':date_of_birth', $this->remove_errors($d['date_of_birth']));
                $this->connection->bind(':place_of_birth', $this->remove_errors($d['place_of_birth']));
                $this->connection->bind(':email', $this->remove_errors($d['email']));
                $this->connection->bind(':nationality', $this->remove_errors($d['nationality']));
                $this->connection->bind(':ethnicity', $this->remove_errors($d['ethnicity']));
                $this->connection->bind(':status', $this->remove_errors($d['status']));

            try{
                $this->connection->execute();
                $message = "Record Updated";
                return $message;
            }catch(PDOException $message){
                echo $message->getMessage();
            }
        }

        public function delete($id)
        {
            $this->connection->query( "DELETE FROM individuals WHERE id= :id");
            $this->connection->bind(':id', $id);
            try{
                $this->connection->execute();
                $message = "Record Removed";
                return $message;
            }catch(PDOException $message){
                echo $message->getMessage();
            }         
        }

        public function view($role, $id)
        {  
            if($role == 'ADMIN'){
                $this->connection->query("SELECT * FROM individuals");
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }
        

        public function findIndividual($org_id){
            $this->connection->query('SELECT a.id as id, CONCAT(a.surname, ", ", a.first_name, ":-(DOB: ", date_format(a.date_of_birth, "%d-%b-%Y"), ")(", a.sex, ")") as individual FROM individuals a WHERE org_id = :org_id');
            $this->connection->bind(':org_id', $org_id);
            $statement = $this->connection->getStatement();
            return $statement;
        }

        public function getIndById($id){
            $this->connection->query('SELECT * FROM individuals WHERE id = :id');
            $this->connection->bind(':id', $id);
            $row = $this->connection->getStatement();
    
            return $row;
        }

        public function alreadyexist($surname, $first_name){
            $this->connection->query('SELECT * FROM individuals WHERE surname=:surname and first_name=:first_name');
            $this->connection->bind(':surname', $surname);
            $this->connection->bind(':first_name', $first_name);
            $row = $this->connection->getStatement();
            if($row->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function verify($id)
        {
            $this->connection->query('SELECT * FROM users WHERE id = :id');
            $this->connection->bind(':id', $id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if($row['can_verify'] == 0){
                return false;
            }else{
                return true;
            }
            
        }

        public function get_id(){
            return $this->id;
        }

        public function get_org_id(){
            return $this->org_id;
        }

        public function get_first_name(){
            return $this->first_name;
        }

        public function get_surname(){
            return $this->surname;
        }

        public function get_sex(){
            return $this->sex;
        }

        public function get_date_of_birth(){
            return $this->date_of_birth;
        }

        public function get_place_of_birth(){
            return $this->place_of_birth;
        }

        public function get_email(){
            return $this->email;
        }

        public function get_nationality(){
            return $this->nationality;
        }
        public function get_ethnicity(){
            return $this->ethnicity;
        }

        public function get_status(){
            return $this->status;
        }

        public function set_id($id){
            return $this->id = $id;
        }

        public function set_org_id($org_id){
            return $this->org_id = $org_id;
        }

        public function set_first_name($first_name){
            return $this->first_name = $first_name;
        }

        public function set_surname($surname){
            return $this->surname = $surname;
        }

        public function set_sex($sex){
            return $this->sex = $sex;
        }

        public function set_date_of_birth($date_of_birth){
            return $this->date_of_birth = $date_of_birth;
        }

        public function set_place_of_birth($place_of_birth){
            return $this->place_of_birth = $place_of_birth;
        }

        public function set_email($email){
            return $this->email = $email;
        }

        public function set_nationality($nationality){
            return $this->nationality = $nationality;
        }

        public function set_ethnicity($ethnicity){
            return $this->ethnicity = $ethnicity;
        }

        public function set_status($status){
            return $this->status = $status;
        }
    }

?>