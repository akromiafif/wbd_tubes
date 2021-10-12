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
    <form name="form1" action="functions/addProduct_function.php" method="POST" onsubmit="return validateForm()">
      <div class="boxProduk">
          <label class="namaProduk">Nama varian</label>
          <input type="text" name="productName" placeholder="Ex: Takoyaki" >
      </div>
      <div class="boxProduk">
          <label class="hargaProduk">Harga</label>
          <input type="number" name="price" >
      </div>
      <div class="boxProduk">
          <label class="stok">Stok</label>
          <input type="number" name="stock" >
      </div>
      <div class="boxProduk">
          <label class="deskripsi">Deskripsi</label>
          <input type="text" name="description" >
      </div>
      <div class="boxProduk">
          <label class="gambarProduk">Gambar Produk</label>
          <input type="url" name="link_photo" placeholder="https://example.com" >
      </div>
      <div class="newline"></div>
      <div class="save">
        <button type="submit" name="submit1">Save</button>
      </div>
    </form>
    <script type="text/javascript">
      function validateForm() {
        var a = document.forms["form1"]["productName"].value;
        var b = document.forms["form1"]["price"].value;
        var c = document.forms["form1"]["stock"].value;
        var d = document.forms["form1"]["description"].value;
        var e = document.forms["form1"]["link_photo"].value;
        if (a == null || a == "", b == null || b == "", c == null || c == "", d == null || d == "", e == null || e == "") {
          alert("Please Fill All Required Field");
          return false;
        }
      }
    </script>
    <?php
      if(isset($_SESSION['gagal'])){
        $error = $_SESSION['gagal'];
        ?>
        <div class="alertFailed" id="error"><?=$error?></div>
        <?php
      }
      elseif(isset($_SESSION['sukses'])){
        $succes = $_SESSION['sukses'];
        ?>
        <div class="alertSucced" id="succes"><?=$succes?></div>
        <?php
      }
      session_unset();
      ?>
  </body>
</html>
