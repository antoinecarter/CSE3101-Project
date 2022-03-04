<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class Worklocation implements crud {
        private $id;
        private $org_id;
        private $location_code;
        private $location_desc;
        private $address;
        private $telephone;
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
                $this->connection->query("INSERT INTO worklocations(org_id, location_code, location_desc, address, telephone, status, start_date) 
                                                VALUES (:org_id, :location_code, :location_desc, :address, :telephone,  :status, :start_date)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':location_code',$this->location_code);
                $this->connection->bind(':location_desc',$this->location_desc);
                $this->connection->bind(':address',$this->address);
                $this->connection->bind(':telephone',$this->telephone);
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
                $this->connection->query("UPDATE worklocations SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE worklocations SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }
                $this->connection->query("UPDATE worklocations 
                                        SET 
                                            org_id = :org_id, location_code = :location_code, location_desc = :location_desc, 
                                            address = :address, telephone = :telephone, start_date = :start_date, 
                                            status = :status
                                        WHERE
                                            id = :id");
            
                $this->connection->bind(':id', $id);
                $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
                $this->connection->bind(':location_code', $this->remove_errors($d['location_code']));
                $this->connection->bind(':location_desc', $this->remove_errors($d['location_desc']));
                $this->connection->bind(':address', $this->remove_errors($d['address']));
                $this->connection->bind(':telephone', $this->remove_errors($d['telephone']));
                $this->connection->bind(':start_date', $this->remove_errors(date('Y-m-d', strtotime($d['start_date']))));
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
            $this->connection->query( "DELETE FROM worklocations WHERE id= :id");
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
                $this->connection->query('SELECT a.*, b.full_name full_name
                FROM worklocations a
                LEFT JOIN organization b on a.org_id = b.id
                WHERE a.org_id = :org_id');
                $this->connection->bind(':org_id', $org_id);
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }
        

        public function findWkLocation($org_id){
            $this->connection->query('SELECT id, CONCAT(location_code, " :- ", location_desc) as worklocation FROM worklocations WHERE org_id = :org_id and status = "VERIFY"');
            $this->connection->bind(':org_id', $org_id);
            $statement = $this->connection->getStatement();
            return $statement;
        }

        public function getWkLocationById($id){
            $this->connection->query('SELECT * FROM worklocations WHERE id = :id');
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

        public function get_location_code(){
            return $this->location_code;
        }

        public function get_location_desc(){
            return $this->location_desc;
        }

        public function get_address(){
            return $this->address;
        }

        public function get_telephone(){
            return $this->telephone;
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

        public function set_id($id){
            return $this->id = $id;
        }

        public function set_org_id($org_id){
            return $this->org_id = $org_id;
        }

        public function set_location_code($location_code){
            return $this->location_code = $location_code;
        }

        public function set_location_desc($location_desc){
            return $this->location_desc = $location_desc;
        }

        public function set_address($address){
            return $this->address = $address;
        }

        public function set_telephone($telephone){
            return $this->telephone = $telephone;
        }

        public function set_start_date($start_date){
            return $this->start_date = $start_date;
        }

        public function set_end_date($end_date){
            return $this->end_date = $end_date;
        }

        public function set_status($status){
            return $this->status = $status;
        }
    }
?>