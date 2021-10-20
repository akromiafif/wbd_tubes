<link href="css/product.css" rel="stylesheet">
<?php
    try {
        $connection = new PDO("sqlite:"."db/dorayaki.db");
        
    } 
    catch(Exception $e) {
        die('connection_unsuccessful: ' . $e->getMessage());
    }

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
        ORDER BY Penjualan.terjual DESC;";
    }

    if ($showItem){
        $produk = $connection->query($query);
        while($row=$produk->fetch(PDO::FETCH_ASSOC)){
            $product_name = $row["nama"];
            $image = $row["gambar"];
            $price = $row["harga"];
            $dynamicList .= '
            <table cellpadding="10">
                <tr>
                    <td valign="center">
                        <a href="product.php?id=' . $product_name . '">
                            <img src="img/uploads/'.$image.'" alt="' . $product_name . '" width="200" height="200"/>
                        </a>
                    </td>
                    <td valign="center">
                    <a href="product.php?id=' . $product_name . '">
                        ' . $product_name . '<br/>
                        Rp' . $price . '
                    </a>
                    </td>
                </tr>
            </table>';
        }
    }
    else{
        ?>
        <div class="product not found">Tidak ada produk ditemukan</div>
        <?php
    }
    
?>
<div class="table1">
    <?php 
    echo $dynamicList;
    unset($_SESSION['searchitem']);
    ?>
</div>