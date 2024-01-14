<?php
require('Ketnoi.php');
$productID = isset($_POST['productID']) ? intval($_POST['productID']) : 0;
echo $productID;

if ($productID > 0) {
    $getIDQuery = "SELECT ID FROM oder WHERE Status = 0";
    $getIDResult = mysqli_query($conn, $getIDQuery);
    $ID = mysqli_fetch_assoc($getIDResult)['ID'];

    $getdeleteQuery = "DELETE FROM oder_deltail WHERE productID = {$productID}";
    $getdeleteResult = mysqli_query($conn, $getdeleteQuery);

    $gettotalQuery = "SELECT oderID, SUM(price) AS total_price FROM oder_deltail GROUP BY oderID;";
                $gettotalResult = mysqli_query($conn, $gettotalQuery);
                $total = mysqli_fetch_assoc($gettotalResult)['total_price'];
                if($total>0)
                {
                $totalQuery = "UPDATE `oder` SET `total` = $total WHERE `ID` = $ID";
                $updatetotal = mysqli_query($conn, $totalQuery);
                }
                else
                {
                    $totalQuery = "UPDATE `oder` SET `total` = 0 WHERE `ID` = $ID";
                    $updatetotal = mysqli_query($conn, $totalQuery);
                }
                
    if ($getdeleteResult) {
        echo "Xóa thành công!";
    } else {
        echo "Lỗi trong quá trình xóa: " . mysqli_error($conn);
    }
} else {
    echo "Lỗi: Không có ProductID hợp lệ.";
}
?>
