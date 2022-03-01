<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class Address implements crud {

        private $id;
        private $org_id;
        private $ind_id;
        private $address_type;
        private $lot;
        private $address_line1;
        private $address_line2;
        private $address_line3;
        private $country;
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
                $this->connection->query("INSERT INTO addresses(org_id, ind_id, address_type, lot, address_line1, address_line2, address_line3, country, start_date) 
                                                VALUES (:org_id, :ind_id, :address_type, :lot, :address_line1, :address_line2, :address_line3, :country, :start_date)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':ind_id',$this->ind_id);
                $this->connection->bind(':address_type',$this->address_type);
                $this->connection->bind(':lot',$this->lot);
                $this->connection->bind(':address_line1',$this->address_line1);
                $this->connection->bind(':address_line2',$this->address_line2);
                $this->connection->bind(':address_line3',$this->address_line3);
                $this->connection->bind(':country',$this->country);
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
                $this->connection->query("UPDATE addresses SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE addresses SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }
            $this->connection->query("UPDATE addresses 
                                    SET 
                                        org_id = :org_id, ind_id = :ind_id, address_type = :address_type, 
                                        lot = :lot,  address_line1 = :address_line1, address_line2 = :address_line2, 
                                        address_line3 = :address_line3, country = :country, start_date = :start_date
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
            $this->connection->bind(':ind_id', $this->remove_errors($d['ind_id']));
            $this->connection->bind(':address_type', $this->remove_errors($d['address_type']));
            $this->connection->bind(':lot', $this->remove_errors($d['lot']));
            $this->connection->bind(':address_line1', $this->remove_errors($d['address_line1']));
            $this->connection->bind(':address_line2', $this->remove_errors($d['address_line2']));
            $this->connection->bind(':address_line3', $this->remove_errors($d['address_line3']));
            $this->connection->bind(':country', $this->remove_errors($d['country']));
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
            $this->connection->query( "DELETE FROM addresses WHERE id= :id");
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
                $this->connection->query("SELECT * FROM addresses");
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }

        public function findAddress($ind_id, $org_id){
            $this->connection->query('SELECT id, CONCAT(address_type, ": Lot ", lot, " ",address_line1, ", ", address_line2, ", ", country) as address FROM addresses WHERE org_id = :org_id and ind_id = :ind_id');
            $this->connection->bind(':org_id', $org_id);
            $this->connection->bind(':ind_id', $ind_id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getAddressById($id){
            $this->connection->query('SELECT * FROM addresses WHERE id = :id');
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

        public function get_address_type(){
            return $this->address_type;
        }

        public function get_address(){
            return $this->address;
        }

        public function get_lot(){
            return $this->lot;
        }

        public function get_address_line1(){
            return $this->address_line1;
        }

        public function get_address_line2(){
            return $this->address_line2;
        }

        public function get_address_line3(){
            return $this->address_line3;
        }

        public function get_country(){
            return $this->country;
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

        public function set_address_type($address_type){
            return $this->address_type = $address_type;
        }

        public function set_address($address){
            return $this->address = $address;
        }

        public function set_lot($lot){
            return $this->lot = $lot;
        }

        public function set_address_line1($address_line1){
            return $this->address_line1 = $address_line1;
        }

        public function set_address_line2($address_line2){
            return $this->address_line2 = $address_line2;
        }

        public function set_address_line3($address_line3){
            return $this->address_line3 = $address_line3;
        }

        public function set_country($country){
            return $this->country = $country;
        }
        public function set_start_date($start_date){
            return $this->start_date = $start_date;
        }

        public function set_end_date($end_date){
            return $this->end_date = $end_date;
        }

        
    }
?>
