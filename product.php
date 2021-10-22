<?php 
    session_start();
    // Connect to the MySQL database
    require_once "db.php";
    //$connection = new PDO("sqlite:"."db/dorayaki.db"); 

    // Check to see the URL variable is set and that it exists in the database
    if (isset($_GET['id'])) {
        
        $id = preg_replace('/%20/', ' ', $_GET['id']) ;
        $produk = $connection->query("SELECT * FROM Produk, Penjualan WHERE Produk.nama = Penjualan.nama AND
        Produk.nama='$id'");
        // get all the product details
        while($row=$produk->fetch(PDO::FETCH_ASSOC)){
            $product_name = $row["nama"];
            $price = $row["harga"];
            $description = $row["deskripsi"];
            $stock = $row["stok"];
            $image = $row["gambar"];
            $sold = $row['terjual'];
        }
        
    } 
?>
<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $product_name; ?></title>
        <link href="css/product.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php 
            require_once 'navbar.php';
            $_SESSION['namaProduk'] = $product_name;
        ?>
        <div class="container-detail-produk">
                <div class="layoutContentHal">
                <?php
               // echo $_SESSION['namaProduk'];
                    if(isset($_POST['button'])){
                ?>
                    <div>Product Has Been Delete</div>
                <?php
                        // delete query in database
                        $connection->query("DELETE FROM Produk WHERE nama = '$id'");
                        $connection->query("DELETE FROM Penjualan WHERE nama = '$id'");
                        // delete photo file
                        unlink("img/uploads/$image");
                    }
                    else{
                ?>
                        <div class='contentHal'>
                            <img src="img/uploads/<?php echo $image;?>" id='gambar' width='200' height='200'>
                        </div>
                        <div class='contentHal' width='200' height='200'>
                            <p id='namaProduk'><strong><?php echo $product_name;?></strong></p>
                            <p id='deskripsi'>Deskripsi : <?php echo $description;?></p>
                            <p id='harga'>Harga &nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo "Rp".$price;?></p>
                            <p id='stok'>Stok &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $stock;?></p>
                            <p id='terjual'>Terjual &nbsp&nbsp&nbsp: <?php echo $sold;?></p>
                            
                        <?php 
                            $username = $_COOKIE['username'];
                            $is_admin = $connection->query("SELECT count(*) FROM member WHERE username = '$username' AND is_admin = 1")->fetchColumn();
                            if ($is_admin == 1){?>
                                <!-- open pop up -->
                                <button class="open-button" onclick="openDelPopUp()">Delete Product</button>
                                <button class="open-button" onclick="openEditPopUp()">Edit Product</button>
                                <form action="productStock.php" method="post">
                                    <button type="submit" class="open-button" name="ubahStock">Change Stock</button>
                                </form>
                               <?php 
                               // masih belom bisa
                               $tes = $_SESSION['errorUpload'];
                               echo $tes;
                                if(isset($_SESSION['errorUpload'])){ echo "tes";?>
                                    <div><?php echo $_SESSION['errorUpload'];?></div>
                              <?php  
                              }
                            }
                            // user
                            else{
                                ?>
                                <form action="productStock.php" method="post">
                                    <button type="submit" class="open-button" name="beli">Buy Product</button>
                                </form>
                        <?php
                            } 
                         ?>
                        </div>
                <?php
                    }
                ?>
                
            </div>
            <div class="popup" id="popUpDelete">
                <form id="form2" name="form2" method="post" action="product.php?id=<?php echo $id; ?>">
                    <input type="submit" name="button" class="btn" id="button" value="Delete"/>
                </form>
                <button type="button" class="btn cancel" onclick="closeDelPopUp()">Close</button>
            </div>
            <div class="popup" id="editPopup">
                <?php 
                    // session untuk edit detail produk
                   // $_SESSION['namaProduk'] = $product_name;
                    $_SESSION['deskripsi'] = $description;
                    $_SESSION['harga'] = $price;
                    $_SESSION['gambar'] = $image;
                ?>
                <form id="form3" class="formedit" name="formEdit" method="post" enctype="multipart/form-data" action="functions/editProduct.php">
                    <p class="font">Nama varian</p>
                    <?php echo '<input type="text" name="productname" value="'.$product_name.'" placeholder="Ex: Takoyaki">' ?>
                    <p class="font">Deskripsi</p>
                    <?php echo '<input type="text" name="description" value="'.$description.'">' ?>
                    <p class="font">Harga</p>
                    <input type="number" name="price" value=<?php echo $price;?>>
                    <p class="font">Gambar</p>
                    <input type="file" name="img">
                    <button type="submit" name="editdata" class="btn">Submit</button>
                </form>
                <button type="button" class="btn cancel" onclick="closeEditPopUp()">Close</button>
            </div>
        </div>
        <script>
            function openDelPopUp() {
                document.getElementById("popUpDelete").style.display = "block";
            }

            function closeDelPopUp() {
                document.getElementById("popUpDelete").style.display = "none";
            }
            function openEditPopUp() {
                document.getElementById("editPopup").style.display = "block";
            }

            function closeEditPopUp() {
                document.getElementById("editPopup").style.display = "none";
            }
        </script>
    </body>
</html>