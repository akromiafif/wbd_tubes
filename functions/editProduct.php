<?php
    session_start();
    $connection = new PDO("sqlite:"."../db/dorayaki.db");
    if (isset($_POST['editdata'])){

        $produk = $_POST["productname"];
        $harga = $_POST["price"];
        $deskripsi = $_POST["description"];

        if ($produk !=  $_SESSION['namaProduk']){
            $res = $connection->prepare("UPDATE Produk SET nama = '$produk'");
            $res->execute();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        if($harga != $_SESSION['harga']){
            $res = $connection->prepare("UPDATE Produk SET harga = '$harga'");
            $res->execute();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        if($deskripsi != $_SESSION['deskripsi']){
            $res = $connection->prepare("UPDATE Produk SET deskripsi = '$deskripsi'");
            $res->execute();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else{
            echo '<script>alert("Edit Failed");</script>';
        }
    }
    unset($_SESSION['namaProduk']);
    unset($_SESSION['harga']);
    unset($_SESSION['deskripsi']);
?>

