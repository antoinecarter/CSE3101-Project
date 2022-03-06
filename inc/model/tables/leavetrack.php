<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class LeaveTrack implements crud {

        private $id;
        private $org_id;
        private $emp_id;
        private $comp_year_id;
        private $leave_ent_id;
        private $leave_req_id;
        private $leave_type;
        private $entitled_days;
        private $leave_earned;
        private $leave_used;
        
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
                $this->connection->query("INSERT INTO leavetracks(org_id, emp_id, leave_ent_id, leave_type, entitled_days) 
                                                VALUES (:org_id, :emp_id, :leave_ent_id, :leave_type, :entitled_days)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':emp_id',$this->emp_id);
                $this->connection->bind(':leave_ent_id',$this->leave_ent_id);
                $this->connection->bind(':leave_type',$this->leave_type);
                $this->connection->bind(':entitled_days',$this->entitled_days);
                $this->connection->execute();
                
                $this->id = $this->connection->get_connection()->lastInsertId();
            }catch(PDOException $message){
                echo $message->getMessage();
            }
            
        }

        public function update($id, $d)
        {
            if(in_array($d['leave_req_id'],array(null,0))){
                $this->connection->query("UPDATE leavetracks SET leave_req_id = NULL, leave_used = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE leavetracks SET leave_req_id = :leave_req_id, leave_used = :leave_used where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':leave_req_id', $this->remove_errors($d['leave_req_id']));
                $this->connection->bind(':leave_used', $this->remove_errors($d['leave_used']));
                $this->connection->execute();
            }
            $this->connection->query("UPDATE leavetracks 
                                    SET 
                                        org_id = :org_id, emp_id = :emp_id, comp_year_id = :comp_year_id, 
                                        leave_ent_id = :leave_ent_id, leave_type = :leave_type, entitled_days = :entitled_days,
                                        leave_earned = :leave_earned
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
            $this->connection->bind(':emp_id', $this->remove_errors($d['emp_id']));
            $this->connection->bind(':comp_year_id', $this->remove_errors($d['comp_year_id']));
            $this->connection->bind(':leave_ent_id', $this->remove_errors($d['leave_ent_id']));
            $this->connection->bind(':leave_type', $this->remove_errors($d['leave_type']));
            $this->connection->bind(':entitled_days', $this->remove_errors($d['entitled_days']));
            $this->connection->bind(':leave_earned', $this->remove_errors($d['leave_earned']));

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
            $this->connection->query( "DELETE FROM leavetracks WHERE id= :id");
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
                $this->connection->query('SELECT a.id as id, a.emp_id as emp_id, a.leave_ent_id as leave_ent_id, CONCAT(d.first_name, " ",d.surname, ":-", f.pos_name, "(", f.pos_level, ")") as employee, a.entitled_days as entitled_days, a.leave_earned as leave_earned, a.leave_used as leave_used, a.leave_type as leave_type
                FROM leavetracks a
                INNER JOIN organization b on a.org_id = b.id
                INNER JOIN employees c on a.emp_id = c.id
                INNER JOIN individuals d on c.ind_id = d.id
                INNER JOIN positions f on c.position_id = f.id');
                $statement = $this->connection->getStatement();
                return $statement;
            }else{
                $this->connection->query('SELECT a.id as id, a.emp_id as emp_id, a.leave_ent_id as leave_ent_id, CONCAT(d.first_name, " ",d.surname, ":-", f.pos_name, "(", f.pos_level, ")") as employee, a.entitled_days as entitled_days, a.leave_earned as leave_earned, a.leave_used as leave_used, a.leave_type as leave_type
                FROM leavetracks a
                INNER JOIN organization b on a.org_id = b.id
                INNER JOIN employees c on a.emp_id = c.id
                INNER JOIN individuals d on c.ind_id = d.id
                INNER JOIN positions f on c.position_id = f.id
                INNER JOIN users g on g.employee_no = a.emp_id
                WHERE g.employee_no = :emp_no');
                $this->connection->bind(':emp_no', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }

        public function findleavetracks($org_id, $id){
            $this->connection->query('SELECT id, comp_year_id FROM leavetracks WHERE org_id = :org_id and emp_id = :id');
            $this->connection->bind(':org_id', $org_id);
            $this->connection->bind(':id', $id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getleavetracksById($id){
            $this->connection->query('SELECT * FROM leavetracks WHERE id = :id');
            $this->connection->bind(':id', $id);
            $row = $this->connection->getStatement();
    
            return $row;
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

        public function get_comp_year_id(){
            return $this->comp_year_id;
        }

        public function get_leave_ent_id(){
            return $this->leave_ent_id;
        }

        public function get_leave_req_id(){
            return $this->leave_req_id;
        }

        public function get_leave_type(){
            return $this->leave_type;
        }

        public function get_entitled_days(){
            return $this->entitled_days;
        }

        public function get_leave_earned(){
            return $this->leave_earned;
        }

        public function get_leave_used(){
            return $this->leave_used;
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

        public function set_comp_year_id($comp_year_id){
            return $this->comp_year_id = $comp_year_id;
        }

        public function set_leave_ent_id($leave_ent_id){
            return $this->leave_ent_id = $leave_ent_id;
        }

        public function set_leave_req_id($leave_req_id){
            return $this->leave_req_id = $leave_req_id;
        }

        public function set_leave_type($leave_type){
            return $this->leave_type = $leave_type;
        }

        public function set_entitled_days($entitled_days){
            return $this->entitled_days = $entitled_days;
        }

        public function set_leave_earned($leave_earned){
            return $this->leave_earned = $leave_earned;
        }

        public function set_leave_used($leave_used){
            return $this->leave_used = $leave_used;
        }

    }
?>
