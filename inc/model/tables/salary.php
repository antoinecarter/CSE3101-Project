<?php
    include_once __DIR__."/../Database.php";
    include_once __DIR__."/interface.php";
    
    class Salary implements crud {

        private $id;
        private $org_id;
        private $emp_id;
        private $salary;
        private $nis_deduct;
        private $taxable;
        private $monthly_basic;
        private $daily_rate;
        private $hourly_rate;
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
                $this->connection->query("INSERT INTO salaries(org_id, emp_id, salary, nis_deduct, taxable, monthly_basic, daily_rate, hourly_rate, start_date) 
                                                VALUES (:org_id, :emp_id, :salary, :nis_deduct, :taxable, :monthly_basic, :daily_rate, :hourly_rate, :start_date)");
                $this->connection->bind(':org_id', $this->org_id);
                $this->connection->bind(':emp_id',$this->emp_id);
                $this->connection->bind(':salary',$this->salary);
                $this->connection->bind(':nis_deduct',$this->nis_deduct);
                $this->connection->bind(':taxable',$this->taxable);
                $this->connection->bind(':monthly_basic',$this->monthly_basic);
                $this->connection->bind(':daily_rate',$this->daily_rate);
                $this->connection->bind(':hourly_rate',$this->hourly_rate);
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
                $this->connection->query("UPDATE salaries SET end_date = NULL where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->execute();
            }else{
                $this->connection->query("UPDATE salaries SET end_date = :end_date where id = :id");
                $this->connection->bind(':id', $id);
                $this->connection->bind(':end_date', $this->remove_errors(date('Y-m-d', strtotime($d['end_date']))));
                $this->connection->execute();
            }
            $this->connection->query("UPDATE salaries 
                                    SET 
                                        org_id = :org_id, emp_id = :emp_id, salary = :salary, 
                                        nis_deduct = :nis_deduct,  taxable = :taxable, monthly_basic = :monthly_basic, 
                                        daily_rate = :daily_rate, hourly_rate = :hourly_rate, start_date = :start_date
                                    WHERE
                                        id = :id");
        
            $this->connection->bind(':id', $id);
            $this->connection->bind(':org_id', $this->remove_errors($d['org_id']));
            $this->connection->bind(':emp_id', $this->remove_errors($d['emp_id']));
            $this->connection->bind(':salary', $this->remove_errors($d['salary']));
            $this->connection->bind(':nis_deduct', $this->remove_errors($d['nis_deduct']));
            $this->connection->bind(':taxable', $this->remove_errors($d['taxable']));
            $this->connection->bind(':monthly_basic', $this->remove_errors($d['monthly_basic']));
            $this->connection->bind(':daily_rate', $this->remove_errors($d['daily_rate']));
            $this->connection->bind(':hourly_rate', $this->remove_errors($d['hourly_rate']));
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
            $this->connection->query( "DELETE FROM salaries WHERE id= :id");
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
                $this->connection->query("SELECT * FROM salaries WHERE emp_id = :id");
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }else{
                $this->connection->query('SELECT a.* FROM salaries a INNER JOIN employees b on a.emp_id = b.id WHERE a.emp_id = :id');
                $this->connection->bind(':id', $id);
                $statement = $this->connection->getStatement();
                return $statement;
            }
        }
        /*
        public function findSal($org_id){
            $this->connection->query('SELECT a.id, CONCAT(b.surname, ", ", b.first_name, ":- ", c.pos_name, " (Emp id: ", a.emp_id, ")") as employee FROM salaries a inner join individuals b on a.salary = b.id inner join positions c on a.nis_deduct = c.id WHERE org_id = :org_id');
            $this->connection->bind(':org_id', $org_id);
            $statement = $this->connection->getStatement();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }*/

        public function getSalById($id){
            $this->connection->query('SELECT * FROM salaries WHERE id = :id');
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

        public function get_salary(){
            return $this->salary;
        }

        public function get_nis_deduct(){
            return $this->nis_deduct;
        }

        public function get_taxable(){
            return $this->taxable;
        }

        public function get_monthly_basic(){
            return $this->monthly_basic;
        }

        public function get_daily_rate(){
            return $this->daily_rate;
        }

        public function get_hourly_rate(){
            return $this->hourly_rate;
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

        public function set_salary($salary){
            return $this->salary = $salary;
        }

        public function set_nis_deduct($nis_deduct){
            return $this->nis_deduct = $nis_deduct;
        }

        public function set_taxable($taxable){
            return $this->taxable = $taxable;
        }

        public function set_monthly_basic($monthly_basic){
            return $this->monthly_basic = $monthly_basic;
        }

        public function set_daily_rate($daily_rate){
            return $this->daily_rate = $daily_rate;
        }

        public function set_hourly_rate($hourly_rate){
            return $this->hourly_rate = $hourly_rate;
        }

        public function set_start_date($start_date){
            return $this->start_date = $start_date;
        }

        public function set_end_date($end_date){
            return $this->end_date = $end_date;
        }
        
    }
?>
