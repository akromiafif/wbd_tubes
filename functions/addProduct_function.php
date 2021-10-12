<?php
  session_start();
      $connection = new PDO("sqlite:"."../db/dorayaki.db");
      if (isset($_POST["submit1"])){
        $nRow = $connection->query("SELECT count(*) FROM Produk WHERE nama = '$_POST[productName]'")->fetchColumn(); 
        if ($nRow > 0){
          $_SESSION['gagal'] = "This Product is Already Exist!!";
        }
        else{
          try {
            $connection->query("INSERT INTO `Produk` (nama, deskripsi, stok, gambar, harga) VALUES('$_POST[productName]', 
          '$_POST[description]', '$_POST[stock]' , '$_POST[link_photo]', '$_POST[price]')");
          $_SESSION['sukses'] = "Insert Product Succed";
          } catch(Exception $e) {
              die('connection_unsuccessful: ' . $e->getMessage());
          }
        }
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
      ?>
