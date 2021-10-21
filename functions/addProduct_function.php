<?php
  session_start();
  //require_once "../db.php";
  require_once "uploadFile.php";

      $connection = new PDO("sqlite:"."../db/dorayaki.db");
      if (isset($_POST["submit1"])){
        $nRow = $connection->query("SELECT count(*) FROM Produk WHERE nama = '$_POST[productName]'")->fetchColumn();
        
        // terdapat jenis varian yang sama pada database 
        if ($nRow > 0){
          $_SESSION['gagal'] = "This Product is Already Exist!!";
        }
        else{

          // set up upload image
          $target_dir = "../img/uploads/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

          // upload file to a folder
          if (checkUploadFile($target_file, "fileToUpload")) {
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

            //input ke database
            try {
              $productLowercase = strtolower($_POST['productName']);
              $picture = $_FILES['fileToUpload']['name'];
              $connection->query("INSERT INTO `Produk` (nama, deskripsi, stok, harga, gambar, nama_terjual) VALUES('$productLowercase', 
              '$_POST[description]', '$_POST[stock]' , '$_POST[price]', '$picture', '$productLowercase')");

              $connection->query("INSERT INTO `Penjualan` (nama, terjual) VALUES('$productLowercase', 2)");
              $_SESSION['sukses'] = "Insert Product Succed";
            } 
            catch(Exception $e) {
                die('connection_unsuccessful: ' . $e->getMessage());
            }
          }
        }
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
      ?>
