<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";

    class Reference implements crud {
        private $id;
        private $org_id;
        private $table_name;
        private $table_desc;
        private $table_value;
        private $value_desc;
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
                $this->connection->query("INSERT INTO references(org_id, table_name, table_desc, table_value, value_desc, status, start_date) 
                                                VALUES (:org_id, :table_name, :table_desc, :table_value, :value_desc,  :status, :start_date)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':table_name',$this->table_name);
                $this->connection->bind(':table_desc',$this->table_desc);
                $this->connection->bind(':table_value',$this->table_value);
                $this->connection->bind(':value_desc',$this->value_desc);
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
                $this->connection->query("UPDATE references SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE references SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }
                $this->connection->query("UPDATE references 
                                        SET 
                                            org_id = :org_id, table_name = :table_name, table_desc = :table_desc, 
                                            table_value = :table_value, value_desc = :value_desc, start_date = :start_date, 
                                            status = :status
                                        WHERE
                                            id = :id");
            
                $this->connection->bind(':id', $id);
                $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
                $this->connection->bind(':table_name', $this->remove_errors($d['table_name']));
                $this->connection->bind(':table_desc', $this->remove_errors($d['table_desc']));
                $this->connection->bind(':table_value', $this->remove_errors($d['table_value']));
                $this->connection->bind(':value_desc', $this->remove_errors($d['value_desc']));
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
            $this->connection->query( "DELETE FROM references WHERE id= :id");
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
                $this->connection->query("SELECT * FROM references");
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }
        

        public function findRef($table_name, $org_id){
            $table_name = $this->remove_errors($table_name);
            $this->connection->query("SELECT table_value, value_desc FROM references WHERE table_name = :table_name and org_id = :org_id");
            $this->connection->bind(':table_name', $table_name);
            $this->connection->bind(':org_id', $org_id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getRefById($id){
            $this->connection->query('SELECT * FROM references WHERE id = :id');
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

        public function get_table_name(){
            return $this->table_name;
        }

        public function get_table_desc(){
            return $this->table_desc;
        }

        public function get_table_value(){
            return $this->table_value;
        }

        public function get_value_desc(){
            return $this->value_desc;
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

        public function set_table_name($table_name){
            return $this->table_name = $table_name;
        }

        public function set_table_desc($table_desc){
            return $this->table_desc = $table_desc;
        }

        public function set_table_value($table_value){
            return $this->table_value = $table_value;
        }

        public function set_value_desc($value_desc){
            return $this->value_desc = $value_desc;
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