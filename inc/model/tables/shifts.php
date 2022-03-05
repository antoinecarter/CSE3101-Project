<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class Shift implements crud {
        private $id;
        private $org_id;
        private $shift_type;
        private $shift_code;
        private $start_time;
        private $end_time;
        private $shift_hours;
        private $lunch_start;
        private $lunch_end;
        private $lunch_hours;
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
                $this->connection->query("INSERT INTO shifts(org_id, shift_type, shift_code, start_time, end_time, lunch_start, lunch_end, status, start_date) 
                                                VALUES (:org_id, :shift_type, :shift_code, :start_time, :end_time, :lunch_start, :lunch_end, :status, :start_date)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':shift_type',$this->shift_type);
                $this->connection->bind(':shift_code',$this->shift_code);
                $this->connection->bind(':start_time',$this->start_time);
                $this->connection->bind(':end_time', $this->end_time);
                $this->connection->bind(':lunch_start',$this->lunch_start);
                $this->connection->bind(':lunch_end',$this->lunch_end);
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
                $this->connection->query("UPDATE shifts SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE shifts SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }

            if($d['lunch_start'] == null || $d['lunch_end'] == null){
                $this->connection->query("UPDATE shifts SET lunch_start = NULL, lunch_end = null where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE shifts SET lunch_start = :lunch_start, lunch_end = :lunch_end where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':lunch_start',  $this->remove_errors(date("H:i", strtotime($d['lunch_start']))));
                $this->connection->bind(':lunch_end', $this->remove_errors(date("H:i", strtotime($d['lunch_end']))));
                $this->connection->execute();
            }

                $this->connection->query("UPDATE shifts 
                                        SET 
                                            org_id = :org_id, shift_type = :shift_type, shift_code = :shift_code, 
                                            start_time = :start_time, end_time = :end_time, start_date = :start_date, status = :status
                                        WHERE
                                            id = :id");
            
                $this->connection->bind(':id', $id);
                $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
                $this->connection->bind(':shift_type', $this->remove_errors($d['shift_type']));
                $this->connection->bind(':shift_code', $this->remove_errors($d['shift_code']));
                $this->connection->bind(':start_time', $this->remove_errors(date("H:i", strtotime($d['start_time']))));
                $this->connection->bind(':end_time', $this->remove_errors(date("H:i", strtotime($d['end_time']))));
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
            $this->connection->query( "DELETE FROM shifts WHERE id= :id");
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
                $this->connection->query("SELECT * FROM shifts");
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }
        

        public function findShift($org_id){
            $this->connection->query('SELECT id, CONCAT(shift_type, ":", shift_code, " :- (", start_time, " - ", end_time, ")") as shift FROM shifts WHERE org_id = :org_id and status = "VERIFY"');
            $this->connection->bind(':org_id', $org_id);
            $statement = $this->connection->getStatement();
            return $statement;
        }

        public function getShiftById($id){
            $this->connection->query('SELECT * FROM shifts WHERE id = :id');
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

        public function get_shift_type(){
            return $this->shift_type;
        }

        public function get_shift_code(){
            return $this->shift_code;
        }

        public function get_start_time(){
            return $this->start_time;
        }

        public function get_end_time(){
            return $this->end_time;
        }

        public function get_shift_hours(){
            return $this->shift_hours;
        }

        public function get_lunch_start(){
            return $this->lunch_start;
        }

        public function get_lunch_end(){
            return $this->lunch_end;
        }

        public function get_lunch_hours(){
            return $this->lunch_hours;
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

        public function set_shift_type($shift_type){
            return $this->shift_type = $shift_type;
        }

        public function set_shift_code($shift_code){
            return $this->shift_code = $shift_code;
        }

        public function set_start_time($start_time){
            return $this->start_time = $start_time;
        }

        public function set_end_time($end_time){
            return $this->end_time = $end_time;
        }

        public function set_lunch_start($lunch_start){
            return $this->lunch_start = $lunch_start;
        }

        public function set_lunch_end($lunch_end){
            return $this->lunch_end = $lunch_end;
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