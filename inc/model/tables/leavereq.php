<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class LeaveRequest implements crud {

        private $id;
        private $org_id;
        private $emp_id;
        private $leave_type;
        private $from_date;
        private $to_date;
        private $resumption_date;
        private $approved_by;
        private $approved_date;
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
                $this->connection->query("INSERT INTO leaverequests(org_id, emp_id, leave_type, from_date, to_date, resumption_date, approved_by, approved_date, status ) 
                                                VALUES (:org_id, :emp_id, :leave_type, :from_date, :to_date, :resumption_date, :approved_by, :approved_date, :status )");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':emp_id',$this->emp_id);
                $this->connection->bind(':leave_type',$this->leave_type);
                $this->connection->bind(':from_date',$this->from_date);
                $this->connection->bind(':to_date',$this->to_date);
                $this->connection->bind(':resumption_date',$this->resumption_date);
                $this->connection->bind(':approved_by',$this->approved_by);
                $this->connection->bind(':approved_date',$this->approved_date);
                $this->connection->bind(':status',$this->status);
                $this->connection->execute();
                
                $this->id = $this->connection->get_connection()->lastInsertId();
            }catch(PDOException $message){
                echo $message->getMessage();
            }
            
        }

        public function update($id, $d)
        {
            if($d['approved_by'] == null){
                $this->connection->query("UPDATE leaverequests SET approved_by = NULL, approved_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE leaverequests SET approved_by = :approved_by, approved_date = :approved_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':approved_by', $this->remove_errors($d['approved_by']));
                $this->connection->bind(':approved_date', $this->remove_errors(date('Y-m-d', strtotime($d['approved_date']))));
                $this->connection->execute();
            }
            $this->connection->query("UPDATE leaverequests 
                                    SET 
                                        org_id = :org_id, emp_id = :emp_id, leave_type = :leave_type, 
                                        from_date = :from_date, to_date = :to_date, resumption_date = :resumption_date,
                                        status = :status
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
            $this->connection->bind(':emp_id', $this->remove_errors($d['emp_id']));
            $this->connection->bind(':leave_type', $this->remove_errors($d['leave_type']));
            $this->connection->bind(':from_date', $this->remove_errors(date('Y-m-d', strtotime($d['from_date']))));
            $this->connection->bind(':to_date', $this->remove_errors(date('Y-m-d', strtotime($d['to_date']))));
            $this->connection->bind(':resumption_date', $this->remove_errors(date('Y-m-d', strtotime($d['resumption_date']))));
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
            $this->connection->query( "DELETE FROM leaverequests WHERE id= :id");
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
                $this->connection->query("SELECT * FROM leaverequests");
                $statement = $this->connection->getStatement();
                return $statement;
            }else{
                $this->connection->query('SELECT * FROM leaverequests a inner join employees b on a.emp_id = b.id inner join users c on c.emp_no = b.id WHERE c.emp_no = :id');
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }

        public function findleaverequests($org_id, $id){
            $this->connection->query('SELECT id, leave_type FROM leaverequests WHERE org_id = :org_id and emp_id = :id');
            $this->connection->bind(':org_id', $org_id);
            $this->connection->bind(':id', $id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getleaverequestsById($id){
            $this->connection->query('SELECT * FROM leaverequests WHERE id = :id');
            $this->connection->bind(':id', $id);
            $row = $this->connection->getStatement();
    
            return $row;
        }

        public function approve($id)
        {
            $this->connection->query('SELECT * FROM users WHERE id = :id');
            $this->connection->bind(':id', $id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if($row['can_approve'] == 0){
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

        public function get_from_date(){
            return $this->from_date;
        }

        public function get_to_date(){
            return $this->to_date;
        }

        public function get_resumption_date(){
            return $this->resumption_date;
        }

        public function get_approved_by(){
            return $this->approved_by;
        }

        public function get_approved_date(){
            return $this->approved_date;
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

        public function set_emp_id($emp_id){
            return $this->emp_id = $emp_id;
        }

        public function set_leave_type($leave_type){
            return $this->leave_type = $leave_type;
        }

        public function set_from_date($from_date){
            return $this->from_date = $from_date;
        }

        public function set_to_date($to_date){
            return $this->to_date = $to_date;
        }

        public function set_resumption_date($resumption_date){
            return $this->resumption_date = $resumption_date;
        }

        public function set_approved_by($approved_by){
            return $this->approved_by = $approved_by;
        }

        public function set_approved_date($approved_date){
            return $this->approved_date = $approved_date;
        }

        public function set_status($status){
            return $this->status = $status;
        }

        
        
    }
?>
