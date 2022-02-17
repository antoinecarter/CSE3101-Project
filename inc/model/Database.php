<?php
    class Database {
        protected $connection;

        private $tables = [
            "CREATE TABLE IF NOT EXISTS users(
                id NUMBER AUTO_INCREMENT NOT NULL,
                first_name VARCHAR(30) NOT NULL, 
                last_name VARCHAR(30) NOT NULL,
                email VARCHAR(100) NOT NULL,
                username VARCHAR(30) NOT NULL,
                passcode VARCHAR(50) NOT NULL, 
                employee_no INT DEFAULT NULL,
                role VARCHAR(20) NOT NULL DEFAULT 'USER',
                can_create INT DEFAULT 0 COMMENT '1=Yes, 0=No', 
                can_view INT DEFAULT 0 COMMENT '1=Yes, 0=No',
                can_update INT DEFAULT 0 COMMENT '1=Yes, 0=No', 
                can_delete INT DEFAULT 0 COMMENT '1=Yes, 0=No', 
                can_verify INT DEFAULT 0 COMMENT '1=Yes, 0=No',
                can_approve INT DEFAULT 0 COMMENT '1=Yes, 0=No',
                start_date DATE NOT NULL DEFAULT SYSDATE,
                end_date DATE DEFAULT NULL,
                status VARCHAR(20) NOT NULL, 
                
                PRIMARY KEY (id)
            );",

            "ALTER TABLE users AUTO_INCREMENT=1500;"

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