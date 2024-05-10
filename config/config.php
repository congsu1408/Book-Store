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

        $secret_key = "sk_test_51PEVazRp2vxrKslUxCrEfhnGgudYG8lpT3XX5seA8jowryiidgMjK0ihdXAP8pS9SsyHuOvB8h4ENFWPoZgcikzI00XeowAH56";
