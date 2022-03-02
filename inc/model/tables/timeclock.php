<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class Timeclock implements crud {

        private $id;
        private $org_id;
        private $work_date;
        private $day;
        private $emp_id;
        private $shift_id;
        private $shift_hours;
        private $time_in;
        private $time_out;
        private $min_time_in;
        private $max_time_out;
        private $hours_worked;
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
                $this->connection->query("INSERT INTO timeclocks(org_id, work_date, day, emp_id, shift_id, shift_hours, time_in, time_out, min_time_in, max_time_out, status) 
                                                VALUES (:org_id, :work_date, :day, :emp_id, :shift_id, :shift_hours, :time_in, :time_out, :min_time_in, :max_time_out, :status)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':work_date',$this->work_date);
                $this->connection->bind(':day',$this->day);
                $this->connection->bind(':emp_id',$this->emp_id);
                $this->connection->bind(':shift_id',$this->shift_id);
                $this->connection->bind(':shift_hours',$this->shift_hours);
                $this->connection->bind(':time_in',$this->time_in);
                $this->connection->bind(':time_out',$this->time_out);
                $this->connection->bind(':min_time_in',$this->min_time_in);
                $this->connection->bind(':max_time_out',$this->max_time_out);
                $this->connection->bind(':status',$this->status);
                $this->connection->execute();
                
                $this->id = $this->connection->get_connection()->lastInsertId();
            }catch(PDOException $message){
                echo $message->getMessage();
            }
            
        }

        public function update($id, $d)
        {
            $this->connection->query("UPDATE timeclocks 
                                    SET 
                                        org_id = :org_id, work_date = :work_date, day = :day, 
                                        emp_id = :emp_id, shift_id = :shift_id, shift_hours = :shift_hours, time_in = :time_in, 
                                        time_out = :time_out, min_time_in = :min_time_in, max_time_out = :max_time_out, 
                                        status = :status
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
            $this->connection->bind(':work_date', $this->remove_errors(date('Y-m-d', strtotime($d['work_date']))));
            $this->connection->bind(':day', $this->remove_errors($d['day']));
            $this->connection->bind(':emp_id', $this->remove_errors($d['emp_id']));
            $this->connection->bind(':shift_id', $this->remove_errors($d['shift_id']));
            $this->connection->bind(':shift_hours', $this->remove_errors($d['shift_hours']));
            $this->connection->bind(':time_in', $this->remove_errors(date('H:i', strtotime($d['time_in']))));
            $this->connection->bind(':time_out', $this->remove_errors(date('H:i', strtotime($d['time_out']))));
            $this->connection->bind(':min_time_in', $this->remove_errors(date('H:i', strtotime($d['min_time_in']))));
            $this->connection->bind(':max_time_out', $this->remove_errors(date('H:i', strtotime($d['max_time_out']))));
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
            $this->connection->query( "DELETE FROM timeclocks WHERE id= :id");
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
                $this->connection->query("SELECT * FROM timeclocks");
                $statement = $this->connection->getStatement();
                return $statement;
            }else{
                $this->connection->query('SELECT a.* FROM timeclocks a INNER JOIN users b on a.emp_id = b.emp_no WHERE a.emp_id = :id');
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }

        public function findTimeClock($org_id){
            $this->connection->query('SELECT a.id, CONCAT(d.surname, ", ", d.first_name ,":-", b.shift_code, ":- (", time_format(b.start_time, "%H:%i"),"-", time_format(b.end_time, "%H:%i"),")-Work Date:",a.work_date, "//", a.status) as emp_timeclock FROM timeclocks a inner join shifts b on a.shift_id = b.id inner join employees c on a.emp_id = c.id inner join individuals d on d.id = c.ind_id WHERE org_id = :org_id');
            $this->connection->bind(':org_id', $org_id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getTimeClockById($id){
            $this->connection->query('SELECT * FROM timeclocks WHERE id = :id');
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

        public function get_work_date(){
            return $this->work_date;
        }

        public function get_day(){
            return $this->day;
        }

        public function get_emp_id(){
            return $this->emp_id;
        }

        public function get_shift_id(){
            return $this->shift_id;
        }

        public function get_shift_hours(){
            return $this->shift_hours;
        }

        public function get_time_in(){
            return $this->time_in;
        }

        public function get_time_out(){
            return $this->time_out;
        }

        public function get_min_time_in(){
            return $this->min_time_in;
        }

        public function get_max_time_out(){
            return $this->max_time_out;
        }

        public function get_hours_worked(){
            return $this->hours_worked;
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

        public function set_work_date($work_date){
            return $this->work_date = $work_date;
        }

        public function set_day($day){
            return $this->day = $day;
        }

        public function set_emp_id($emp_id){
            return $this->emp_id = $emp_id;
        }

        public function set_shift_id($shift_id){
            return $this->shift_id = $shift_id;
        }

        public function set_shift_hours($shift_hours){
            return $this->shift_hours = $shift_hours;
        }

        public function set_time_in($time_in){
            return $this->time_in = $time_in;
        }

        public function set_time_out($time_out){
            return $this->time_out = $time_out;
        }

        public function set_min_time_in($min_time_in){
            return $this->min_time_in = $min_time_in;
        }

        public function set_max_time_out($max_time_out){
            return $this->max_time_out = $max_time_out;
        }

        public function set_hours_worked($hours_worked){
            return $this->hours_worked = $hours_worked;
        }

        public function set_status($status){
            return $this->status = $status;
        }

        
    }
?>
