<?php
    class Connection
    {
        function mkConnection()
        {
            $con=new mysqli("localhost","root","","hrms");
            return $con;
        }
    }
?>