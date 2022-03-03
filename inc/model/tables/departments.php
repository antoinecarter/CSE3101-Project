<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class Department implements crud {
        private $id;
        private $org_id;
        private $org_struct_id;
        private $dept_code;
        private $dept_name;
        private $dept_level;
        private $parent_dept_id;
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
                $this->connection->query("INSERT INTO departments(org_id, org_struct_id, dept_code, dept_name, dept_level, status, start_date) 
                                                VALUES (:org_id, :org_struct_id, :dept_code, :dept_name, :dept_level,  :status, :start_date)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':org_struct_id',$this->org_struct_id);
                $this->connection->bind(':dept_code',$this->dept_code);
                $this->connection->bind(':dept_name',$this->dept_name);
                $this->connection->bind(':dept_level',$this->dept_level);
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
                $this->connection->query("UPDATE departments SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE departments SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }

            if($d['parent_dept_id'] == null){
                $this->connection->query("UPDATE departments SET parent_dept_id = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE departments SET parent_dept_id = :parent_dept_id where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':parent_dept_id', $this->remove_errors($d['parent_dept_id']));
                $this->connection->execute();
            }
                $this->connection->query("UPDATE departments 
                                        SET 
                                            org_id = :org_id, org_struct_id = :org_struct_id, dept_code = :dept_code,
                                            dept_name = :dept_name, dept_level = :dept_level, start_date = :start_date, 
                                            status = :status
                                        WHERE
                                            id = :id");
            
                $this->connection->bind(':id', $id);
                $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
                $this->connection->bind(':org_struct_id', $this->remove_errors($d['org_struct_id']));
                $this->connection->bind(':dept_code', $this->remove_errors($d['dept_code']));
                $this->connection->bind(':dept_name', $this->remove_errors($d['dept_name']));
                $this->connection->bind(':dept_level', $this->remove_errors($d['dept_level']));
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
            $this->connection->query( "DELETE FROM departments WHERE id= :id");
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
                $this->connection->query("SELECT * FROM departments");
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }
        
        public function excludeDepartment($id, $org_id){
            $this->connection->query('SELECT id, CONCAT(dept_level, " : ", dept_name) as Department FROM departments WHERE org_id = :org_id and status = "VERIFY" and id != :id');
            $this->connection->bind(':org_id', $org_id);
            $this->connection->bind(':id', $id);
            $statement = $this->connection->getStatement();
            return $statement;
        }

        public function findDepartments($org_id){
            $this->connection->query('SELECT id, CONCAT(dept_level, " : ", dept_name) as Department FROM departments WHERE org_id = :org_id and status = "VERIFY"');
            $this->connection->bind(':org_id', $org_id);
            $statement = $this->connection->getStatement();
            return $statement;
        }

        public function getDeptById($id){
            $this->connection->query('SELECT * FROM departments WHERE id = :id');
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

        public function get_org_struct_id(){
            return $this->org_struct_id;
        }
        
        public function get_dept_code(){
            return $this->dept_code;
        }
        
        public function get_dept_name(){
            return $this->dept_name;
        }
        
        public function get_dept_level(){
            return $this->dept_level;
        }

        public function get_parent_dept_id(){
            return $this->parent_dept_id;
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

        public function set_org_struct_id($org_struct_id){
            return $this->org_struct_id = $org_struct_id;
        }

        public function set_dept_code($dept_code){
            return $this->dept_code = $dept_code;
        }

        public function set_dept_name($dept_name){
            return $this->dept_name = $dept_name;
        }

        public function set_dept_level($dept_level){
            return $this->dept_level = $dept_level;
        }

        public function set_parent_dept_id($parent_dept_id){
            return $this->parent_dept_id = $parent_dept_id;
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