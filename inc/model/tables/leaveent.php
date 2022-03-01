<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class LeaveEntitlement implements crud {

        private $id;
        private $org_id;
        private $emp_id;
        private $leave_type;
        private $quantity;
        private $max_accumulation;
        private $monthly_rate;
        private $leave_earn;
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
                $this->connection->query("INSERT INTO leaveent(org_id, emp_id, leave_type, quantity, monthly_rate, start_date) 
                                                VALUES (:org_id, :emp_id, :leave_type, :quantity, :monthly_rate, :start_date)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':emp_id',$this->emp_id);
                $this->connection->bind(':leave_type',$this->leave_type);
                $this->connection->bind(':quantity',$this->quantity);
                $this->connection->bind(':max_accumulation',$this->max_accumulation);
                $this->connection->bind(':monthly_rate',$this->monthly_rate);
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
                $this->connection->query("UPDATE leaveent SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE leaveent SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }
            $this->connection->query("UPDATE leaveent 
                                    SET 
                                        org_id = :org_id, emp_id = :emp_id, leave_type = :leave_type, 
                                        quantity = :quantity, max_accumulation = :max_accumulation,  monthly_rate = :monthly_rate, 
                                        start_date = :start_date
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
            $this->connection->bind(':emp_id', $this->remove_errors($d['emp_id']));
            $this->connection->bind(':leave_type', $this->remove_errors($d['leave_type']));
            $this->connection->bind(':quantity', $this->remove_errors($d['quantity']));
            $this->connection->bind(':max_accumulation', $this->remove_errors($d['max_accumulation']));
            $this->connection->bind(':monthly_rate', $this->remove_errors($d['monthly_rate']));
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
            $this->connection->query( "DELETE FROM leaveent WHERE id= :id");
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
                $this->connection->query("SELECT * FROM leaveent WHERE emp_id = :id");
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }else{
                $this->connection->query('SELECT * FROM leaveent  WHERE emp_id = :id');
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }

        public function findLeaveEnt($org_id, $id){
            $this->connection->query('SELECT id, leave_type FROM leaveent WHERE org_id = :org_id and end_date is null and emp_id = :id');
            $this->connection->bind(':org_id', $org_id);
            $this->connection->bind(':id', $id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getLeaveEntById($id){
            $this->connection->query('SELECT * FROM leaveent WHERE id = :id');
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

        public function get_leave_type(){
            return $this->leave_type;
        }

        public function get_quantity(){
            return $this->quantity;
        }

        public function get_max_accumulation(){
            return $this->max_accumulation;
        }

        public function get_monthly_rate(){
            return $this->monthly_rate;
        }

        public function get_leave_earn(){
            return $this->leave_earn;
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

        public function set_leave_type($leave_type){
            return $this->leave_type = $leave_type;
        }

        public function set_quantity($quantity){
            return $this->quantity = $quantity;
        }

        public function set_max_accumulation($max_accumulation){
            return $this->max_accumulation = $max_accumulation;
        }

        public function set_monthly_rate($monthly_rate){
            return $this->monthly_rate = $monthly_rate;
        }

        public function set_leave_earn($leave_earn){
            return $this->leave_earn = $leave_earn;
        }

        public function set_start_date($start_date){
            return $this->start_date = $start_date;
        }

        public function set_end_date($end_date){
            return $this->end_date = $end_date;
        }
        
    }
?>
