<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class Position implements crud {
        private $id;
        private $org_id;
        private $org_struct_id;
        private $parent_unit_id;
        private $pos_code;
        private $pos_name;
        private $pos_level;
        private $overview;
        private $wk_loc_id;
        private $lower_sal;
        private $upper_sal;
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
                $this->connection->query("INSERT INTO positions(org_id, org_struct_id, parent_unit_id, pos_code, pos_name, pos_level, overview, wk_loc_id, lower_sal, upper_sal, status, start_date) 
                                                VALUES (:org_id, :org_struct_id, :parent_unit_id, :pos_code, :pos_name, :pos_level, :overview, :wk_loc_id, :lower_sal, :upper_sal, :status, :start_date)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':org_struct_id',$this->org_struct_id);
                $this->connection->bind(':parent_unit_id',$this->parent_unit_id);
                $this->connection->bind(':pos_code',$this->pos_code);
                $this->connection->bind(':pos_name',$this->pos_name);
                $this->connection->bind(':pos_level',$this->pos_level);
                $this->connection->bind(':overview',$this->overview);
                $this->connection->bind(':wk_loc_id',$this->wk_loc_id);
                $this->connection->bind(':lower_sal',$this->lower_sal);
                $this->connection->bind(':upper_sal',$this->upper_sal);
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
                $this->connection->query("UPDATE positions SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE positions SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }

                $this->connection->query("UPDATE positions 
                                        SET 
                                            org_id = :org_id, org_struct_id = :org_struct_id, 
                                            parent_unit_id = :parent_unit_id, pos_code = :pos_code,
                                            pos_name = :pos_name, pos_level = :pos_level, 
                                            overview = :overview, wk_loc_id = :wk_loc_id, 
                                            lower_sal = :lower_sal, upper_sal = :upper_sal,
                                            start_date = :start_date, status = :status
                                        WHERE
                                            id = :id");
            
                $this->connection->bind(':id', $id);
                $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
                $this->connection->bind(':org_struct_id', $this->remove_errors($d['org_struct_id']));
                $this->connection->bind(':parent_unit_id', $this->remove_errors($d['parent_unit_id']));
                $this->connection->bind(':pos_code', $this->remove_errors($d['pos_code']));
                $this->connection->bind(':pos_name', $this->remove_errors($d['pos_name']));
                $this->connection->bind(':pos_level', $this->remove_errors($d['pos_level']));
                $this->connection->bind(':overview', $this->remove_errors($d['overview']));
                $this->connection->bind(':wk_loc_id', $this->remove_errors($d['wk_loc_id']));
                $this->connection->bind(':lower_sal', $this->remove_errors($d['lower_sal']));
                $this->connection->bind(':upper_sal', $this->remove_errors($d['upper_sal']));
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
            $this->connection->query( "DELETE FROM positions WHERE id= :id");
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
                $this->connection->query("SELECT * FROM positions");
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }
        

        public function findPositions($org_id){
            $this->connection->query('SELECT id, CONCAT(a.pos_name, " :- ", b.location_desc) as Position FROM positions a inner join worklocations b on a.wk_loc_id = b.id WHERE a.org_id = :org_id and a.status = "VERIFY"');
            $this->connection->bind(':org_id', $org_id);
            $statement = $this->connection->getStatement();
            return $statement;
        }

        public function getPosById($id){
            $this->connection->query('SELECT * FROM positions WHERE id = :id');
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

        public function get_parent_unit_id(){
            return $this->parent_unit_id;
        }

        public function get_pos_code(){
            return $this->pos_code;
        }
        
        public function get_pos_name(){
            return $this->pos_name;
        }
        
        public function get_pos_level(){
            return $this->pos_level;
        }

        public function get_overview(){
            return $this->overview;
        }

        public function get_wk_loc_id(){
            return $this->wk_loc_id;
        }

        public function get_lower_sal(){
            return $this->lower_sal;
        }

        public function get_upper_sal(){
            return $this->upper_sal;
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

        public function set_parent_unit_id($parent_unit_id){
            return $this->parent_unit_id = $parent_unit_id;
        }

        public function set_pos_code($pos_code){
            return $this->pos_code = $pos_code;
        }

        public function set_pos_name($pos_name){
            return $this->pos_name = $pos_name;
        }

        public function set_pos_level($pos_level){
            return $this->pos_level = $pos_level;
        }

        public function set_overview($overview){
            return $this->overview = $overview;
        }

        public function set_wk_loc_id($wk_loc_id){
            return $this->wk_loc_id = $wk_loc_id;
        }

        public function set_lower_sal($lower_sal){
            return $this->lower_sal = $lower_sal;
        }

        public function set_upper_sal($upper_sal){
            return $this->upper_sal = $upper_sal;
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