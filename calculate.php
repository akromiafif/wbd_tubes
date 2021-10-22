<?php
    session_start();
    $quantity = intval($_GET['q']);
    require_once "db.php";
    $produk = $connection->query("SELECT * FROM Produk WHERE nama = 'dorayaki'");
    while($row=$produk->fetch(PDO::FETCH_ASSOC)){
        $price = $row['harga'];
        $stock = $row['stok'];
    }
    $stokUpdated = $stock + $quantity;

    $res = $connection->prepare("UPDATE Produk SET stok = '$stokUpdated' WHERE nama = 'dorayaki'");
    $res->execute();

    echo -$quantity*$price . " " .$stokUpdated;
?>
