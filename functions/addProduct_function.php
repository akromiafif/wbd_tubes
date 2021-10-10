<?php
  session_start();
      $connection = new PDO("sqlite:"."../db/dorayaki.db");
      if (isset($_POST["submit1"])){
        $count = 0;
        $query = $connection->query("SELECT count(*) FROM Produk WHERE nama = '$_POST[productName]';");
        $count = $query->fetch(PDO::FETCH_ASSOC);
        echo $count;
        if ($count > 0){
          $_SESSION['gagal'] = "This Product is Already Exist!!";
        }
        else{
          try {
            $connection->query("INSERT INTO `Produk` (nama, deskripsi, harga, stok, gambar) VALUES('$_POST[productName]', 
          '$_POST[description]', '$_POST[price]', '$_POST[stock]' , '$_POST[link_photo]')");
          $_SESSION['sukses'] = "Insert Product Succed";
          } catch(Exception $e) {
              die('connection_unsuccessful: ' . $e->getMessage());
          }
         
        ?>
        <script type="text/javascript">
          document.getElementById('error').style.display = "none";
          document.getElementById('succes').style.display = "block";
        </script>
      <?php

        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
      ?>