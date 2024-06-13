<?php
    $host = 'localhost';
    $dbname = 'taskManager';
    $dbuser = 'root';
    $dbpwd = '';

    $dsn = "mysql:host=$host;dbname=$dbname";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        
        $pdo = new PDO($dsn, $dbuser, $dbpwd, $options);
    } catch (PDOException $error) {
        echo "Connection failed: " . $error->getMessage();
    }