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
                $this->connection->query("INSERT INTO references(table_name, table_desc, table_value, value_desc, passcode, role, status, start_date) 
                                                VALUES (:table_name, :table_desc, :table_value, :value_desc, :passcode, :role, :status, :start_date)");
                $this->connection->bind(':table_name',$this->table_name);
                $this->connection->bind(':table_desc',$this->table_desc);
                $this->connection->bind(':table_value',$this->table_value);
                $this->connection->bind(':value_desc',$this->value_desc);
                $this->connection->bind(':passcode',$this->passcode);
                $this->connection->bind(':role',$this->role);
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
                $this->connection->query("UPDATE users SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE users SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }

            if($d['passcode'] != NULL){
                $this->connection->query("UPDATE users 
                                        SET 
                                            org_id = :org_id, table_name = :table_name, table_desc = :table_desc, table_value = :table_value, value_desc = :value_desc, passcode = :passcode, employee_no = :emp_no, role = :role, can_create = :c_create, can_view = :c_view, can_update = :c_update, can_delete = :c_delete, can_verify = :c_verify, can_approve = :c_approve, start_date = :start_date, status = :status
                                        WHERE
                                            id = :id");
            
                $this->connection->bind(':id', $id);
                $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
                $this->connection->bind(':table_name', $this->remove_errors($d['table_name']));
                $this->connection->bind(':table_desc', $this->remove_errors($d['table_desc']));
                $this->connection->bind(':table_value', $this->remove_errors($d['table_value']));
                $this->connection->bind(':value_desc', $this->remove_errors($d['value_desc']));
                $this->connection->bind(':passcode', $this->remove_errors(md5($d['passcode'])));
                $this->connection->bind(':role', $this->remove_errors($d['role']));
                $this->connection->bind(':emp_no', $this->remove_errors($d['emp_no']));
                $this->connection->bind(':c_create', $this->remove_errors($d['can_create']));
                $this->connection->bind(':c_view', $this->remove_errors($d['can_view']));
                $this->connection->bind(':c_update', $this->remove_errors($d['can_update']));
                $this->connection->bind(':c_delete', $this->remove_errors($d['can_delete']));
                $this->connection->bind(':c_approve', $this->remove_errors($d['can_approve']));
                $this->connection->bind(':c_verify', $this->remove_errors($d['can_verify']));
                $this->connection->bind(':start_date', $this->remove_errors(date('Y-m-d', strtotime($d['start_date']))));
                $this->connection->bind(':status', $this->remove_errors($d['status']));
            }else{
                $this->connection->query("UPDATE users 
                                        SET 
                                            org_id = :org_id, table_name = :table_name, table_desc = :table_desc, table_value = :table_value, value_desc = :value_desc, employee_no = :emp_no, role = :role, can_create = :c_create, can_view = :c_view, can_update = :c_update, can_delete = :c_delete, can_verify = :c_verify, can_approve = :c_approve, start_date = :start_date, status = :status
                                        WHERE
                                            id = :id");
            
                $this->connection->bind(':id', $id);
                $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
                $this->connection->bind(':table_name', $this->remove_errors($d['table_name']));
                $this->connection->bind(':table_desc', $this->remove_errors($d['table_desc']));
                $this->connection->bind(':table_value', $this->remove_errors($d['table_value']));
                $this->connection->bind(':value_desc', $this->remove_errors($d['value_desc']));
                $this->connection->bind(':role', $this->remove_errors($d['role']));
                $this->connection->bind(':emp_no', $this->remove_errors($d['emp_no']));
                $this->connection->bind(':c_create', $this->remove_errors($d['can_create']));
                $this->connection->bind(':c_view', $this->remove_errors($d['can_view']));
                $this->connection->bind(':c_update', $this->remove_errors($d['can_update']));
                $this->connection->bind(':c_delete', $this->remove_errors($d['can_delete']));
                $this->connection->bind(':c_approve', $this->remove_errors($d['can_approve']));
                $this->connection->bind(':c_verify', $this->remove_errors($d['can_verify']));
                $this->connection->bind(':start_date', $this->remove_errors(date('Y-m-d', strtotime($d['start_date']))));
                $this->connection->bind(':status', $this->remove_errors($d['status']));
            }
            

            try{
                $this->connection->execute();
                $message = "User Account Updated";
                return $message;
            }catch(PDOException $message){
                echo $message->getMessage();
            }
        }

        public function delete($id)
        {
            $this->connection->query( "DELETE FROM users WHERE id= :id");
            $this->connection->bind(':id', $id);
            try{
                $this->connection->execute();
                $message = "User Account Removed";
                return $message;
            }catch(PDOException $message){
                echo $message->getMessage();
            }         
        }
        /*
        public function deleteuser($id)
        {
            $this->connection->query( "DELETE FROM users WHERE id= :id");
            $this->connection->bind(':id', $id);
                if($this->connection->execute()){
                    return true;
                }else{
                    return false;
                }
            try{
                //$statement = $this->connection->prepare($sql);
                //$statement->execute(['id'=> $id]);
                header('Location: ');
            }catch(PDOException $message){
                echo $message->getMessage();
            }         
        }*/

        public function view($role, $id)
        {
            if($role == 'ADMIN'){
                $this->connection->query("SELECT * FROM users");
                $statement = $this->connection->getStatement();
                return $statement;
            }else{
                $this->connection->query("SELECT * FROM users WHERE id= :id");
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }    
        }
        
        public function findtable_value($table_value){
            $table_value = $this->remove_errors($table_value);
            $this->connection->query("SELECT * FROM users WHERE table_value = :table_value LIMIT 1");
            $this->connection->bind(':table_value', $table_value);

            $row = $this->connection->record();

            if($this->connection->rowCount()>0){
                return $row;
            }else{
                return false;
            }
            
        }

        public function getUserById($id){
            $this->connection->query('SELECT * FROM users WHERE id = :id');
            $this->connection->bind(':id', $id);
            $row = $this->connection->getStatement();
    
            return $row;
        }

        public function verify($id)
        {
            $this->connection->query('SELECT * FROM users WHERE id = :id');
            $this->connection->bind(':id', $id);
            $row = $this->connection->getStatement();
            if($row['can_verify'] == 0){
                return false;
            }else{
                return true;
            }
            
        }

        public function approve($id)
        {
            $this->connection->query('SELECT * FROM users WHERE id = :id');
            $this->connection->bind(':id', $id);
            $row = $this->connection->getStatement();
            if($row['can_approve'] == 0){
                return false;
            }else{
                return true;
            }
        }

        public function get_id(){
            return $this->id;
        }

        public function get_ord_id(){
            return $this->org_id;
        }

        public function get_fname(){
            return $this->table_name;
        }

        public function get_lname(){
            return $this->table_desc;
        }

        public function get_table_value(){
            return $this->table_value;
        }

        public function get_value_desc(){
            return $this->value_desc;
        }

        public function get_passcode(){
            return $this->passcode;
        }

        public function get_role(){
            return $this->role;
        }

        public function get_emp_no(){
            return $this->emp_no;
        }

        public function get_can_create(){
            return $this->can_create;
        }

        public function get_can_view(){
            return $this->can_view;
        }

        public function get_can_update(){
            return $this->can_update;
        }

        public function get_can_delete(){
            return $this->can_delete;
        }

        public function get_can_verify(){
            return $this->can_verify;
        }

        public function get_can_approve(){
            return $this->can_approve;
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

        public function set_fname($fname){
            return $this->table_name = $fname;
        }

        public function set_lname($lname){
            return $this->table_desc = $lname;
        }

        public function set_table_value($table_value){
            return $this->table_value = $table_value;
        }

        public function set_value_desc($value_desc){
            return $this->value_desc = $value_desc;
        }

        public function set_passcode($passcode){
            return $this->passcode = md5($passcode);
        }

        public function set_role($role){
            return $this->role = $role;
        }

        public function set_emp_no($emp_no){
            return $this->emp_no = $emp_no;
        }

        public function set_can_create($can_create){
            return $this->can_create = $can_create;
        }

        public function set_can_view($can_view){
            return $this->can_view = $can_view;
        }

        public function set_can_update($can_update){
            return $this->can_update = $can_update;
        }

        public function set_can_delete($can_delete){
            return $this->can_delete = $can_delete;
        }

        public function set_can_verify($can_verify){
            return $this->can_verify = $can_verify;
        }

        public function set_can_approve($can_approve){
            return $this->can_approve =$can_approve;
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