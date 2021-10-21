<!DOCTYPE html>
<html lang="en">
  <?php
    session_start();
  ?>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link href="css/admin.css" rel="stylesheet">
    <link rel="icon" href="img/logo.svg" type="image/x-icon" />
    <title>Dorayaki Shop</title>
  </head>
  <body>
    <div class="bckground">
      <div class="container">
        <form name="form1" action="functions/addProduct_function.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
          <div class="inputText">
            <p class="font">Nama varian</p>
            <input type="text" name="productName" placeholder="Ex: Takoyaki" >
            <p class="font">Harga</p>
            <input type="number" name="price" >
            <p class="font">Stok</p>
            <input type="number" name="stock" >
            <p class="font">Deskripsi</p>
            <input type="text" name="description">
            <p class="font">Gambar Produk</p>
            <input type="file" name="fileToUpload" value="tessiugsiug">
            <button type="submit" name="submit1">Submit</button>
            <?php
            if(isset($_SESSION['gagal'])){
              $error = $_SESSION['gagal'];
              ?>
              <div class="alertFailed" id="error"><?=$error?></div>
              <?php
            }
            elseif(isset($_SESSION['file'])){
              $file = $_SESSION['file'];
              ?>
              <div class="uploadFailed" id="fileError"><?=$file?></div>
              <?php
            }
            elseif(isset($_SESSION['sukses'])){
              $succes = $_SESSION['sukses'];
              ?>
              <div class="alertSucced" id="succes"><?=$succes?></div>
              <?php
            }
            ?>
          </div>
        </form>
      </div>
    </div>
    
    <script type="text/javascript">
      function validateForm() {
        var a = document.forms["form1"]["productName"].value;
        var b = document.forms["form1"]["price"].value;
        var c = document.forms["form1"]["stock"].value;
        var d = document.forms["form1"]["description"].value;
        var e = document.forms["form1"]["fileToUpload"].value;
        if (a == null || a == "", b == null || b == "", c == null || c == "", d == null || d == "", e == null || e == "") {
          alert("Please Fill All Required Field");
          return false;
        }
      }
    </script>
    <?php
      session_unset();
      ?>
  </body>
</html>
