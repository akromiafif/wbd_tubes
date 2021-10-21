<?php
    //including the database connectionection
    //require_once '../database.php';

    function checkIsAdmin() {
        $connection = new PDO("sqlite:"."../db/dorayaki.db");
        $username = $_COOKIE['username'];

        $is_admin = $connection->query("SELECT count(*) FROM member WHERE username = '$username' AND is_admin = 1")->fetchColumn();

        if ($is_admin > 0) {
            return true;
        }

        return false;
    }
?>