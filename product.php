<?php 
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
    $connection = new PDO("sqlite:"."db/dorayaki.db"); 
    
	$id = $_GET['id'];
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
        <?php require_once 'navbar.php';?>
        <div class="layoutContentHal">
            <?php
                if(isset($_POST['button'])){
            ?>
                <div>Product Has Been Delete</div>
            <?php
                    // delete query in database
                    $connection->query("DELETE FROM Produk WHERE nama = '$id'");
                    $connection->query("DELETE FROM Penjualan WHERE nama = '$id'");
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
                        <form id="form2" name="form2" method="post" action="product.php?id=<?php echo $id; ?>">
                            <input type="hidden" name="pid" id="pid" value="<?php echo $id;?>" />
                            <input type="submit" name="button" id="button" value="Delete" onclick="clicked(event)"/>
                        </form>
                    </div>
            <?php
                }
            ?>
            <script>
                function clicked(e) {
                    if(!confirm('Are you sure?')) {
                        e.preventDefault();
                    }
                }
            </script>
        </div>
    </body>
</html>