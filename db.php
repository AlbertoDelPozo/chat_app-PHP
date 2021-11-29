<?php
//we do a function to connect to the database
function connect_pdo() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'chat_app';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {        
         // If we have an error we don't connect to the database       
        exit('Failed to connect to database!');     
    }
}
?>