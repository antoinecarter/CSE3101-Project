<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class AttendanceDetail implements crud {

        private $id;
        private $org_id;
        private $emp_id;
        private $rule_option;
        private $rule_value;
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
                $this->connection->query("INSERT INTO attendancedetails(org_id, emp_id, rule_option, rule_value, start_date) 
                                                VALUES (:org_id, :emp_id, :rule_option, :rule_value, :start_date)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':emp_id',$this->emp_id);
                $this->connection->bind(':rule_option',$this->rule_option);
                $this->connection->bind(':rule_value',$this->rule_value);
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
                $this->connection->query("UPDATE attendancedetails SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE attendancedetails SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }
            $this->connection->query("UPDATE attendancedetails 
                                    SET 
                                        org_id = :org_id, emp_id = :emp_id, rule_option = :rule_option, 
                                        rule_value = :rule_value, start_date = :start_date
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
            $this->connection->bind(':emp_id', $this->remove_errors($d['emp_id']));
            $this->connection->bind(':rule_option', $this->remove_errors($d['rule_option']));
            $this->connection->bind(':rule_value', $this->remove_errors($d['rule_value']));
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
            $this->connection->query( "DELETE FROM attendancedetails WHERE id= :id");
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
                $this->connection->query("SELECT * FROM attendancedetails");
                $statement = $this->connection->getStatement();
                return $statement;
            }else{
                $this->connection->query('SELECT * FROM attendancedetails  WHERE id = :id');
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }

        public function findAttDtl($org_id, $id){
            $this->connection->query('SELECT id, CONCAT(rule_option, ":-", rule_value) FROM attendancedetails WHERE org_id = :org_id and end_date is null and emp_id = :id');
            $this->connection->bind(':org_id', $org_id);
            $this->connection->bind(':id', $id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getAttDtlById($id){
            $this->connection->query('SELECT * FROM attendancedetails WHERE id = :id');
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

        public function get_emp_id(){
            return $this->emp_id;
        }

        public function get_rule_option(){
            return $this->rule_option;
        }

        public function get_rule_value(){
            return $this->rule_value;
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

        public function set_emp_id($emp_id){
            return $this->emp_id = $emp_id;
        }

        public function set_rule_option($rule_option){
            return $this->rule_option = $rule_option;
        }

        public function set_rule_value($rule_value){
            return $this->rule_value = $rule_value;
        }

        public function set_start_date($start_date){
            return $this->start_date = $start_date;
        }

        public function set_end_date($end_date){
            return $this->end_date = $end_date;
        }
        
    }
?>
