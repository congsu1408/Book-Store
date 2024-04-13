<?php

        //host name
        $host = "localhost";
        //database name
        $db_name = "BookStore";
        //database username
        $user="root";
        //database password
        $pass ="";
        //connect
        $conn = new PDO("mysql:host=$host;dbname=$db_name",$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

