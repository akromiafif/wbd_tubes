<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
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
    <link href="css/stock.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="img/logo.svg" type="image/x-icon" />
    <title>Dorayaki Shop</title>
    <script>
        function changeStock(max, tipe) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    let result = this.responseText.split(" ");
                    document.getElementById("totalPrice").innerHTML = result[0];
                    document.getElementById("jumlahStock").innerHTML = result[1];
                    document.getElementById("input").setAttribute("max", result[1])
                }
            };
            if(tipe === 'user'){
                if (document.getElementById("input").value < 0 || document.getElementById("input").value > max){
                    return;
                }
                else{
                    var res = document.getElementById("input").value;
                    xmlhttp.open("GET","calculate.php?q="+-res,true);
                    xmlhttp.send();
                }
            }
            else if(tipe === 'admin'){
                if (document.getElementById("input").value < -max){
                    return;
                }
                else{
                    var res = document.getElementById("input").value;
                    if(res < 0){
                        xmlhttp.open("GET","calculate.php?q="+res,true);
                    }
                    else{
                        xmlhttp.open("GET","calculate.php?q="+res,true);
                    }
                    xmlhttp.send();
                }
            }
        }
    </script>
  </head>
  <body>
    <?php
    require_once "navbar.php";
    require_once "db.php";
    $stok = $connection->query("SELECT stok FROM Produk WHERE nama = 'dorayaki'")->fetchColumn();
    $username = $_COOKIE['username'];
    $is_admin = $connection->query("SELECT count(*) FROM member WHERE username = '$username' AND is_admin = 1")->fetchColumn();
    ?>
    <div class="container-detail-produk">
        <div>
            <?php 
                echo $_SESSION['namaProduk'];
            ?>
        </div>
        <?php if($is_admin == 0){?>
            <form onchange="changeStock(<?php echo $stok;?>, 'user')">
                <input type="number" id="input" min="0" max="<?php echo $stok;?>">
            </form>
            <div id="totalPrice"></div>
        <?php
        }
        else{?>
            <form onchange="changeStock(<?php echo $stok;?>, 'admin')">
                <input type="number" id="input" min="<?php echo -$stok;?>" max="">
            </form>
       <?php
        }
        ?>
        <div id="jumlahStock"></div>
    </div>
  </body>

