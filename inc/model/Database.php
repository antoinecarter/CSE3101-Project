<?php
    class Database {
        protected $connection;

        private $tables = [
            "CREATE TABLE IF NOT EXISTS users(
                id INT NOT NULL AUTO_INCREMENT,
                first_name VARCHAR(30) NOT NULL, 
                last_name VARCHAR(30) NOT NULL,
                email VARCHAR(100) NOT NULL,
                username VARCHAR(30) NOT NULL,
                passcode VARCHAR(100) NOT NULL, 
                employee_no INT,
                role VARCHAR(20) NOT NULL DEFAULT 'USER',
                can_create INT DEFAULT 0 COMMENT '1=Yes, 0=No', 
                can_view INT DEFAULT 0 COMMENT '1=Yes, 0=No',
                can_update INT DEFAULT 0 COMMENT '1=Yes, 0=No', 
                can_delete INT DEFAULT 0 COMMENT '1=Yes, 0=No', 
                can_verify INT DEFAULT 0 COMMENT '1=Yes, 0=No',
                can_approve INT DEFAULT 0 COMMENT '1=Yes, 0=No',
                start_date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
                end_date DATE,
                status VARCHAR(20) NOT NULL, 
                
                PRIMARY KEY (id)
            );",

            "ALTER TABLE users AUTO_INCREMENT=1500;"
            /*,

            "INSERT INTO users (id, first_name, last_name, email, username, passcode, employee_no, role, can_create, can_view, can_update, can_delete, can_verify, can_approve, start_date, end_date, status)
                        VALUES (1500, 'John', 'Doe', 'johndoe@gmail.com', 'johndoe', '27d4370b6492cf2a5f9aa301f042f0c2', 1, 'ADMIN', 'Y','Y','Y','Y','Y','Y','2022-01-01','', 'VERIFY');"
*/
        ];

        public function connect()
        {
            $host_name = "localhost";
            $db_name = "hrmis";
            $user = "root";
            $password = "";

            $dsn = "mysql:host=$host_name;dbname=$db_name;charset=UTF8";

            try {
                $this->connection = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            }catch(PDOException $message){
                echo $message -> getMessage();
            }
        }

        public function init(){
            $this->connect();
            try {
                if($this->connection){
                    foreach($this->tables as $table){
                        $this->connection->exec($table);
                    }
                }
            }catch(PDOException $message){
                echo $message->getMessage();
            }
        }

        public function get_connection(){
            return $this->connection;
        }
    }

?>