<?php
require('Ketnoi.php');
$getIDQuery = "SELECT ID FROM oder WHERE Status = 0";
$getIDResult = mysqli_query($conn, $getIDQuery);
$ID = mysqli_fetch_assoc($getIDResult)['ID'];

    $productID = isset($_POST['productID']) ? intval($_POST['productID']) : 0;
    $newQuantity = isset($_POST['newQuantity']) ? intval($_POST['newQuantity']) : 0;
   
     $updateQuery = "UPDATE oder_deltail SET quantity = $newQuantity WHERE productID = $productID";
     mysqli_query($conn, $updateQuery);

     $getpriceQuery = "SELECT price, discount FROM products WHERE productID = $productID";
    $getpriceResult = mysqli_query($conn, $getpriceQuery);
     $productData = mysqli_fetch_assoc($getpriceResult);
    $price = $productData['price'];
    $discount = $productData['discount'];
     $update_price_Query = "UPDATE oder_deltail SET price = $newQuantity*($price-($price*$discount*0.01)) WHERE productID = $productID";
       mysqli_query($conn, $update_price_Query);           

     $gettotalQuery = "SELECT oderID, SUM(price) AS total_price FROM oder_deltail where oderID = $ID ;";
     $gettotalResult = mysqli_query($conn, $gettotalQuery);
     $total = mysqli_fetch_assoc($gettotalResult)['total_price'];
     echo $total;
     $totalQuery = "UPDATE `oder` SET `total` = $total WHERE `ID` = $ID";
     $updatetotal = mysqli_query($conn, $totalQuery);
?>
