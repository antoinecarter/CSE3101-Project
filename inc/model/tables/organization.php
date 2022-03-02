<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";

    class Organization implements crud {

        private $id;
        private $org_type;
        private $short_name;
        private $full_name;
        private $address;
        private $telephone;
        private $fax;
        private $email;
        private $country;
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
                $this->connection->query("INSERT INTO organization(org_type, short_name, full_name, address, telephone, fax, email, country, status, start_date) 
                                                VALUES (:org_type, :short_name, :full_name, :address, :telephone, :fax, :email, :country, :status, :start_date)");
                $this->connection->bind(':org_type', $this->org_type);
                $this->connection->bind(':short_name',$this->short_name);
                $this->connection->bind(':full_name',$this->full_name);
                $this->connection->bind(':address',$this->address);
                $this->connection->bind(':telephone',$this->telephone);
                $this->connection->bind(':fax',$this->fax);
                $this->connection->bind(':email',$this->email);
                $this->connection->bind(':country',$this->country);
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
                $this->connection->query("UPDATE organization SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE organization SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }
            $this->connection->query("UPDATE organization 
                                    SET 
                                        org_type = :org_type, short_name = :short_name, full_name = :full_name, 
                                        address = :address, telephone = :telephone,  fax = :fax, email = :email, 
                                        country = :country, start_date = :start_date, status = :status
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_type', $this->remove_errors($d['org_type']));
            $this->connection->bind(':short_name', $this->remove_errors($d['short_name']));
            $this->connection->bind(':full_name', $this->remove_errors($d['full_name']));
            $this->connection->bind(':address', $this->remove_errors($d['address']));
            $this->connection->bind(':telephone', $this->remove_errors($d['telephone']));
            $this->connection->bind(':fax', $this->remove_errors($d['fax']));
            $this->connection->bind(':email', $this->remove_errors($d['email']));
            $this->connection->bind(':country', $this->remove_errors($d['country']));
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
            $this->connection->query( "DELETE FROM organization WHERE id= :id");
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
                $this->connection->query("SELECT * FROM organization");
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }

        public function findOrg(){
            $this->connection->query("SELECT id, full_name FROM organization WHERE org_type = 'APP_USER'");
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getOrgById($id){
            $this->connection->query('SELECT * FROM organization WHERE id = :id');
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

        public function get_org_type(){
            return $this->org_type;
        }

        public function get_short_name(){
            return $this->short_name;
        }

        public function get_full_name(){
            return $this->full_name;
        }

        public function get_address(){
            return $this->address;
        }

        public function get_telephone(){
            return $this->telephone;
        }

        public function get_fax(){
            return $this->fax;
        }

        public function get_email(){
            return $this->email;
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

        public function get_status(){
            return $this->status;
        }

        public function set_id($id){
            return $this->id = $id;
        }

        public function set_org_type($org_type){
            return $this->org_type = $org_type;
        }

        public function set_short_name($short_name){
            return $this->short_name = $short_name;
        }

        public function set_full_name($full_name){
            return $this->full_name = $full_name;
        }

        public function set_address($address){
            return $this->address = $address;
        }

        public function set_telephone($telephone){
            return $this->telephone = $telephone;
        }

        public function set_fax($fax){
            return $this->fax = $fax;
        }

        public function set_email($email){
            return $this->email = $email;
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

        public function set_status($status){
            return $this->status = $status;
        }
    }
?>
