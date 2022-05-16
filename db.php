<?php

        try{

            $server="localhost";
            $username="root";
            $password="root";
            $database="lele_news";

            $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
            return $conn;
        }
        catch(PDOException $error){
            die("Connection failed " . $error->getMessage());
        }

?>