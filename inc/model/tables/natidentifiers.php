<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class NationalIdentifier implements crud {

        private $id;
        private $org_id;
        private $ind_id;
        private $identifier;
        private $identifier_num;
        private $start_date;
        private $end_date;

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
                $this->connection->query("INSERT INTO nationalidentifiers(org_id, ind_id, identifier, identifier_num, start_date) 
                                                VALUES (:org_id, :ind_id, :identifier, :identifier_num, :start_date)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':ind_id',$this->ind_id);
                $this->connection->bind(':identifier',$this->identifier);
                $this->connection->bind(':identifier_num',$this->identifier_num);
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
                $this->connection->query("UPDATE nationalidentifiers SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE nationalidentifiers SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }
            $this->connection->query("UPDATE nationalidentifiers 
                                    SET 
                                        org_id = :org_id, ind_id = :ind_id, identifier = :identifier, 
                                        identifier_num = :identifier_num, start_date = :start_date
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
            $this->connection->bind(':ind_id', $this->remove_errors($d['ind_id']));
            $this->connection->bind(':identifier', $this->remove_errors($d['identifier']));
            $this->connection->bind(':identifier_num', $this->remove_errors($d['identifier_num']));
            $this->connection->bind(':start_date', $this->remove_errors(date('Y-m-d', strtotime($d['start_date']))));

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
            $this->connection->query( "DELETE FROM nationalidentifiers WHERE id= :id");
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
            $org_id = $_SESSION['org_id'];
            if($role == 'ADMIN'){
                $this->connection->query('SELECT a.id as id, a.ind_id as ind_id, CONCAT(b.surname, ", ", b.first_name, ":-(DOB: ", date_format(b.date_of_birth, "%d-%b-%Y"), ")(", b.sex, ")") as individual, concat(a.identifier, ":-", a.identifier_num) as natid, a.start_date as start_date, a.end_date as end_date FROM nationalidentifiers a inner join individuals b on a.ind_id = b.id where a.org_id = :org_id');
                $this->connection->bind(':org_id', $org_id);
                //$this->connection->query('SELECT a.id as id,  CONCAT(b.surname, ", ", b.first_name, ":-(DOB: ", date_format(b.date_of_birth, "%d-%b-%Y"), ")(", b.sex, ")") as individual, concat(a.identifier, ":-", a.identifier_num) as natid, a.start_date as start_date, a.end_date as end_date FROM nationalidentifiers a inner join individuals b on a.ind_id = b.id inner join employees c on c.ind_id = b.id inner join users d on c.id = d.employee_no');
                $statement = $this->connection->getStatement();
                return $statement;
            }else{
                $this->connection->query('SELECT a.id as id, a.ind_id as ind_id, CONCAT(b.surname, ", ", b.first_name, ":-(DOB: ", date_format(b.date_of_birth, "%d-%b-%Y"), ")(", b.sex, ")") as individual, concat(a.identifier, ":-", a.identifier_num) as natid, a.start_date as start_date, a.end_date as end_date FROM nationalidentifiers a inner join individuals b on a.ind_id = b.id inner join employees c on c.ind_id = b.id inner join users d on c.id = d.employee_no where d.id = :id and where a.org_id = :org_id');
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }

        public function findNatId($ind_id, $org_id){
            $this->connection->query('SELECT id, CONCAT(identifier, ": ", identifier_num) as nationalidentifier FROM nationalidentifiers WHERE org_id = :org_id and ind_id = :ind_id');
            $this->connection->bind(':org_id', $org_id);
            $this->connection->bind(':ind_id', $ind_id);
            $statement = $this->connection->getStatement();
            return $statement;
        }

        public function getNatIdById($id){
            $this->connection->query('SELECT * FROM nationalidentifiers WHERE id = :id');
            $this->connection->bind(':id', $id);
            $row = $this->connection->getStatement();
    
            return $row;
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

        public function get_ind_id(){
            return $this->ind_id;
        }

        public function get_identifier(){
            return $this->identifier;
        }

        public function get_identifier_num(){
            return $this->identifier_num;
        }

        public function get_start_date(){
            return $this->start_date;
        }

        public function get_end_date(){
            return $this->end_date;
        }

        public function set_id($id){
            return $this->id = $id;
        }

        public function set_org_id($org_id){
            return $this->org_id = $org_id;
        }

        public function set_ind_id($ind_id){
            return $this->ind_id = $ind_id;
        }

        public function set_identifier($identifier){
            return $this->identifier = $identifier;
        }

        public function set_identifier_num($identifier_num){
            return $this->identifier_num = $identifier_num;
        }

        public function set_start_date($start_date){
            return $this->start_date = $start_date;
        }

        public function set_end_date($end_date){
            return $this->end_date = $end_date;
        }

        
    }
?>
