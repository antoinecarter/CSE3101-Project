<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class Compyear implements crud {
        
        private $id;
        private $org_id;
        private $year;
        private $start_year;
        private $end_year;
        private $payment_frequency;

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
                $this->connection->query("INSERT INTO companyyear(org_id, year, start_year, end_year, payment_frequency) 
                                                VALUES (:org_id, :year, :start_year, :end_year, :payment_frequency)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':year',$this->year);
                $this->connection->bind(':start_year',$this->start_year);
                $this->connection->bind(':end_year',$this->end_year);
                $this->connection->bind(':payment_frequency',$this->payment_frequency);
                $this->connection->execute();
                
                $this->id = $this->connection->get_connection()->lastInsertId();
            }catch(PDOException $message){
                echo $message->getMessage();
            }
            
        }

        public function update($id, $d)
        {
            $this->connection->query("UPDATE companyyear 
                                    SET 
                                        org_id = :org_id, year = :year, start_year = :start_year, 
                                        end_year = :end_year, payment_frequency = :payment_frequency
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
            $this->connection->bind(':year', $this->remove_errors($d['year']));
            $this->connection->bind(':start_year', $this->remove_errors($d['start_year']));
            $this->connection->bind(':end_year', $this->remove_errors($d['end_year']));
            $this->connection->bind(':payment_frequency', $this->remove_errors($d['payment_frequency']));

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
            $this->connection->query( "DELETE FROM companyyear WHERE id= :id");
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
                $this->connection->query("SELECT * FROM companyyear");
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }

        public function findCompYear($org_id){
            $this->connection->query('SELECT id, CONCAT("COMPANY YEAR:- ", date_format(start_year, "%d-%b-%Y"), " - ", date_format(end_year, "%d-%b-%Y") as Comp_year  FROM companyyear WHERE org_id = :org_id');
            $this->connection->bind(':org_id', $org_id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getCompYearById($id){
            $this->connection->query('SELECT * FROM companyyear WHERE id = :id');
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

        public function get_year(){
            return $this->year;
        }

        public function get_start_year(){
            return $this->start_year;
        }

        public function get_end_year(){
            return $this->end_year;
        }

        public function get_payment_frequency(){
            return $this->payment_frequency;
        }

        public function set_id($id){
            return $this->id = $id;
        }

        public function set_org_id($org_id){
            return $this->org_id = $org_id;
        }

        public function set_year($year){
            return $this->year = $year;
        }

        public function set_start_year($start_year){
            return $this->start_year = $start_year;
        }

        public function set_end_year($end_year){
            return $this->end_year = $end_year;
        }

        public function set_payment_frequency($payment_frequency){
            return $this->payment_frequency = $payment_frequency;
        }
    }
?>