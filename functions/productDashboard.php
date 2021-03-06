<link href="css/product.css" rel="stylesheet">
<?php

    require_once "db.php";

    $dynamicList = "";
    $showItem = true;
    if(isset($_SESSION['searchitem'])){
        $nrow = $connection->query("SELECT count(*) FROM Produk WHERE nama = '$_SESSION[searchitem]'")->fetchColumn();
        if($nrow > 0){
            $query = "SELECT * FROM Produk, Penjualan WHERE Produk.nama = Penjualan.nama AND Produk.nama = 
            '$_SESSION[searchitem]' ORDER BY Penjualan.terjual DESC;";
        }
        else{
            $showItem = false;
        }
    }
    else{
        $query = "SELECT * FROM Produk, Penjualan WHERE Produk.nama = Penjualan.nama 
        ORDER BY Penjualan.terjual DESC LIMIT 10;";
    }

    if ($showItem){
        $produk = $connection->query($query);
        while($row=$produk->fetch(PDO::FETCH_ASSOC)){
            $product_name = $row["nama"];
            $image = $row["gambar"];
            $description = $row["deskripsi"];
            $sold = $row['terjual'];
            $dynamicList .= '
            <div class="product">
                <img src="img/uploads/'.$image.'" alt="' . $product_name . '" width="180" height="180"/>
                <h2>' . $product_name . '</h2>
                <p class="description">' . $description . '</p>
                <p class="sold">Sold: <span style="color: #562FFA; font-weight: bold;">' . $sold .'</span></p>
                <div class="cart">
                <a href="product.php?id=' . $product_name . '"><p>Detail Product</p>
                </div></a>
            </div>';
        }
    }
    else{
        ?>
        <div class="product not found">Tidak ada produk ditemukan</div>
        <?php
    }
    
?>
<div class="container">
    <?php 
        echo $dynamicList;
        unset($_SESSION['searchitem']);
    ?>
</div>