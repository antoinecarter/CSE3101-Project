<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class Absence implements crud {

        private $id;
        private $org_id;
        private $emp_id;
        private $work_date;
        private $shift_id;
        private $shift_hours;
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
                $this->connection->query("INSERT INTO absences(org_id, emp_id, work_date, shift_id, shift_hours, status) 
                                                VALUES (:org_id, :emp_id, :work_date, :shift_id, :shift_hours, :status)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':emp_id',$this->emp_id);
                $this->connection->bind(':work_date',$this->work_date);
                $this->connection->bind(':shift_id',$this->shift_id);
                $this->connection->bind(':shift_hours',$this->shift_hours);
                $this->connection->bind(':status',$this->status);
                $this->connection->execute();
                
                $this->id = $this->connection->get_connection()->lastInsertId();
            }catch(PDOException $message){
                echo $message->getMessage();
            }
            
        }

        public function update($id, $d)
        {
            $this->connection->query("UPDATE absences 
                                    SET 
                                        org_id = :org_id, emp_id = :emp_id, work_date = :work_date,
                                        shift_id = :shift_id, shift_hours = :shift_hours, status = :status
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
            $this->connection->bind(':emp_id', $this->remove_errors($d['emp_id']));
            $this->connection->bind(':work_date', $this->remove_errors(date('Y-m-d', strtotime($d['work_date']))));
            $this->connection->bind(':shift_id', $this->remove_errors($d['shift_id']));
            $this->connection->bind(':shift_hours', $this->remove_errors($d['shift_hours']));
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
            $this->connection->query( "DELETE FROM absences WHERE id= :id");
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
                $this->connection->query('SELECT a.id as id, a.emp_id as emp_id, CONCAT(d.first_name, " ",d.surname, ":-", f.pos_name, "(", f.pos_level, ")") as employee, a.work_date as work_date, concat(e.shift_type, ":-", e.shift_code) as shift, e.shift_hours, a.status as status
                FROM absences a
                INNER JOIN organization b on a.org_id = b.id
                INNER JOIN employees c on a.emp_id = c.id
                INNER JOIN individuals d on c.ind_id = d.id
                INNER JOIN shifts e on c.shift_id = e.id
                INNER JOIN positions f on c.position_id = f.id
                ');
                $statement = $this->connection->getStatement();
                return $statement;
            }else{
                $this->connection->query('SELECT a.* FROM absences a INNER JOIN users b on a.emp_id = b.emp_no WHERE a.emp_id = :id');
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }

        public function findAbsence($org_id){
            $this->connection->query('SELECT a.id, CONCAT(d.surname, ", ", d.first_name ,":-", b.shift_code, ":- (", time_format(b.start_time, "%H:%i"),"-", time_format(b.end_time, "%H:%i"),")-Work Date:",a.work_date, "//", a.status) as emp_absence FROM absences a inner join shifts b on a.shift_id = b.id inner join employees c on a.emp_id = c.id inner join individuals d on d.id = c.ind_id WHERE org_id = :org_id');
            $this->connection->bind(':org_id', $org_id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getAbsenceById($id){
            $this->connection->query('SELECT * FROM absences WHERE id = :id');
            $this->connection->bind(':id', $id);
            $row = $this->connection->getStatement();
    
            return $row;
        }

        public function verify($emp_id, $work_date)
        {
            $this->connection->query('SELECT * FROM absences WHERE emp_id = :emp_id and work_date = :work_date');
            $this->connection->bind(':emp_id', $emp_id);
            $this->connection->bind(':work_date', $work_date);
            $statement = $this->connection->getStatement();
            return $statement;
            
            
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

        public function get_work_date(){
            return $this->work_date;
        }

        public function get_shift_id(){
            return $this->shift_id;
        }

        public function get_shift_hours(){
            return $this->shift_hours;
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

        public function set_work_date($work_date){
            return $this->work_date = $work_date;
        }

        public function set_shift_id($shift_id){
            return $this->shift_id = $shift_id;
        }

        public function set_shift_hours($shift_hours){
            return $this->shift_hours = $shift_hours;
        }

        public function set_status($status){
            return $this->status = $status;
        }

    }
?>
