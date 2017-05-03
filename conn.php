<?php

        $server = 'localhost';
        $database = 'hotornot';
        $username = 'root';
        $password = '';
        try{ // connect till databasen
            $db = new PDO("mysql:host=$server;dbname=$database", $username, $password);
            }
        catch(exception $e){
            die("ERROR : ".$e->getMessage());
        }


?>
