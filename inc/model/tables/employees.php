<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class Employee implements crud {

        private $id;
        private $org_id;
        private $emp_no;
        private $ind_id;
        private $position_id;
        private $payment_frequency;
        private $emp_type;
        private $emp_status;
        private $emp_date;
        private $ann_leave_date;
        private $rate_of_pay;
        private $separation_status;
        private $separation_date;
        private $shift_id;
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
                $this->connection->query("INSERT INTO employees(org_id, emp_no, ind_id, position_id, payment_frequency, emp_type, emp_status, emp_date, rate_of_pay, shift_id, status ) 
                                                VALUES (:org_id, :emp_no, :ind_id, :position_id, :payment_frequency, :emp_type, :emp_status, :emp_date, :rate_of_pay, :shift_id, :status)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':emp_no',$this->emp_no);
                $this->connection->bind(':ind_id',$this->ind_id);
                $this->connection->bind(':position_id',$this->position_id);
                $this->connection->bind(':payment_frequency',$this->payment_frequency);
                $this->connection->bind(':emp_type',$this->emp_type);
                $this->connection->bind(':emp_status',$this->emp_status);
                $this->connection->bind(':emp_date',$this->emp_date);
                $this->connection->bind(':rate_of_pay',$this->rate_of_pay);
                $this->connection->bind(':shift_id',$this->shift_id);
                $this->connection->bind(':status',$this->status);
                $this->connection->execute();
                
                $this->id = $this->connection->get_connection()->lastInsertId();
            }catch(PDOException $message){
                echo $message->getMessage();
            }
            
        }

        public function update($id, $d)
        {
            if($d['separation_date'] == null){
                $this->connection->query("UPDATE employees SET separation_date = NULL, separation_status = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE employees SET separation_date = :separation_date, separation_status =:separation_status where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':separation_date', $this->remove_errors(date('Y-m-d', strtotime($d['separation_date']))));
                $this->connection->bind(':separation_status', $this->remove_errors($d['separation_status']));
                $this->connection->execute();
            }
            $this->connection->query("UPDATE employees 
                                    SET 
                                        org_id = :org_id, emp_no = :emp_no, ind_id = :ind_id, 
                                        position_id = :position_id,  payment_frequency = :payment_frequency, emp_type = :emp_type, 
                                        emp_status = :emp_status, emp_date = :emp_date, rate_of_pay = :rate_of_pay, 
                                        shift_id = :shift_id, status = :status
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
            $this->connection->bind(':emp_no', $this->remove_errors($d['emp_no']));
            $this->connection->bind(':ind_id', $this->remove_errors($d['ind_id']));
            $this->connection->bind(':position_id', $this->remove_errors($d['position_id']));
            $this->connection->bind(':payment_frequency', $this->remove_errors($d['payment_frequency']));
            $this->connection->bind(':emp_type', $this->remove_errors($d['emp_type']));
            $this->connection->bind(':emp_status', $this->remove_errors($d['emp_status']));
            $this->connection->bind(':emp_date', $this->remove_errors(date('Y-m-d', strtotime($d['emp_date']))));
            $this->connection->bind(':rate_of_pay', $this->remove_errors($d['rate_of_pay']));
            $this->connection->bind(':shift_id', $this->remove_errors($d['shift_id']));
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
            $this->connection->query( "DELETE FROM employees WHERE id= :id");
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
                $this->connection->query("SELECT * FROM employees");
                $statement = $this->connection->getStatement();
                return $statement;
            }else{
                $this->connection->query('SELECT a.* FROM employees a INNER JOIN users b on a.id = b.emp_no WHERE b.id = :id');
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }

        public function findEmp($org_id){
            $this->connection->query('SELECT a.id, CONCAT(b.surname, ", ", b.first_name, ":- ", c.pos_name, " (Emp No: ", a.emp_no, ")") as employee FROM employees a inner join individuals b on a.ind_id = b.id inner join positions c on a.position_id = c.id WHERE org_id = :org_id and a.status = "VERIFY"');
            $this->connection->bind(':org_id', $org_id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getEmpById($id){
            $this->connection->query('SELECT * FROM employees WHERE id = :id');
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

        public function get_emp_no(){
            return $this->emp_no;
        }

        public function get_ind_id(){
            return $this->ind_id;
        }

        public function get_position_id(){
            return $this->position_id;
        }

        public function get_payment_frequency(){
            return $this->payment_frequency;
        }

        public function get_emp_type(){
            return $this->emp_type;
        }

        public function get_emp_status(){
            return $this->emp_status;
        }

        public function get_emp_date(){
            return $this->emp_date;
        }

        public function get_ann_leave_date(){
            return $this->ann_leave_date;
        }

        public function get_rate_of_pay(){
            return $this->rate_of_pay;
        }

        public function get_separation_status(){
            return $this->separation_status;
        }

        public function get_separation_date(){
            return $this->separation_date;
        }

        public function get_shift_id(){
            return $this->shift_id;
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

        public function set_emp_no($emp_no){
            return $this->emp_no = $emp_no;
        }

        public function set_ind_id($ind_id){
            return $this->ind_id = $ind_id;
        }

        public function set_position_id($position_id){
            return $this->position_id = $position_id;
        }

        public function set_payment_frequency($payment_frequency){
            return $this->payment_frequency = $payment_frequency;
        }

        public function set_emp_type($emp_type){
            return $this->emp_type = $emp_type;
        }

        public function set_emp_status($emp_status){
            return $this->emp_status = $emp_status;
        }

        public function set_emp_date($emp_date){
            return $this->emp_date = $emp_date;
        }

        public function set_ann_leave_date($ann_leave_date){
            return $this->ann_leave_date = $ann_leave_date;
        }

        public function set_rate_of_pay($rate_of_pay){
            return $this->rate_of_pay = $rate_of_pay;
        }
        
        public function set_separation_status($separation_status){
            return $this->separation_status = $separation_status;
        }

        public function set_separation_date($separation_date){
            return $this->separation_date = $separation_date;
        }

        public function set_shift_id($shift_id){
            return $this->shift_id = $shift_id;
        }

        public function set_status($status){
            return $this->status = $status;
        }

        
    }
?>
