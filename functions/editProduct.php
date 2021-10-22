<?php
    session_start();
    require_once "uploadFile.php";

    $connection = new PDO("sqlite:"."../db/dorayaki.db");
    if (isset($_POST['editdata'])){

        $produk = strtolower($_POST["productname"]);
        $harga = $_POST["price"];
        $deskripsi = $_POST["description"];
        $gambar = $_FILES["img"]["name"];

        // alamaat return
        $ip = $_SERVER['HTTP_REFERER'];

        if ($produk !=  $_SESSION['namaProduk']){
            $res = $connection->prepare("UPDATE Produk SET nama = '$produk', nama_terjual = '$produk' WHERE nama = '$_SESSION[namaProduk]'");
            $res->execute();
            $res = $connection->prepare("UPDATE Penjualan SET nama = '$produk' WHERE nama = '$_SESSION[namaProduk]'");
            $res->execute();
            $ip = "../product.php?id=$produk";
        }
        if($harga != $_SESSION['harga']){
            $res = $connection->prepare("UPDATE Produk SET harga = '$harga' WHERE nama_terjual = '$_SESSION[namaProduk]'");
            $res->execute();
        }
        if($deskripsi != $_SESSION['deskripsi']){
            $res = $connection->prepare("UPDATE Produk SET deskripsi = '$deskripsi' WHERE nama_terjual = '$_SESSION[namaProduk]'");
            $res->execute();
        }
        if($gambar != ""){
            $pic = $_SESSION['gambar'];

            // set up image 
            $target_dir = "../img/uploads/";
            $target_file = $target_dir . basename($_FILES["img"]["name"]);

            if (checkUploadFile($target_file, "img")){
                $res = $connection->prepare("UPDATE Produk SET gambar = '$gambar' WHERE nama = '$_SESSION[namaProduk]'");
                $res->execute();
                move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                unlink("../img/uploads/$pic");
            }
        }
        else{
            echo '<script>alert("Edit Failed");</script>';
        }
        echo $_SESSION['file'];
        header('Location: ' .$ip);
    }
    unset($_SESSION['namaProduk']);
    unset($_SESSION['harga']);
    unset($_SESSION['deskripsi']);
    unset($_SESSION['image']);
?>

