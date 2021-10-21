<?php
  session_start();

  // set up upload image
  $target_dir = "../img/uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      $connection = new PDO("sqlite:"."../db/dorayaki.db");
      if (isset($_POST["submit1"])){
        $nRow = $connection->query("SELECT count(*) FROM Produk WHERE nama = '$_POST[productName]'")->fetchColumn();
        
        // terdapat jenis varian yang sama pada database 
        if ($nRow > 0){
          $_SESSION['gagal'] = "This Product is Already Exist!!";
        }
        else{

          // Check if image file is a actual image or fake image
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            $uploadOk = 1;
          } else {
            $_SESSION['file'] = "File is not an image";
            $uploadOk = 0;
          }

          // Check if file already exists
          if (file_exists($target_file)) {
            $_SESSION['file'] = "Sorry, file already exists";
            $uploadOk = 0;
          }

          // Check file size
          if ($_FILES["fileToUpload"]["size"] > 500000) {
            $_SESSION['file'] = "Sorry, your file is too large";
            $uploadOk = 0;
          }

          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
            $_SESSION['file'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
            $uploadOk = 0;
          }

          // if everything is ok, try to upload file
          if ($uploadOk != 0 && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

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
