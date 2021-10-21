<?php
    // connect to database
    try {
        $connection = new PDO("sqlite:"."db/dorayaki.db");
        
    } 
    catch(Exception $e) {
        die('connection_unsuccessful: ' . $e->getMessage());
    }
?>