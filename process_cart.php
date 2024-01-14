<?php
 require('Ketnoi.php');
 session_start();
    $checkStatusQuery = "SELECT * FROM oder WHERE Status = 0";
    $checkStatusResult = mysqli_query($conn, $checkStatusQuery);
    $productID = isset($_POST['productID']) ? $_POST['productID'] : '';
    echo $productID;
    if ($checkStatusResult) {
        $hasStatusZero = mysqli_num_rows($checkStatusResult) > 0;
            $productInfoQuery = "SELECT * FROM products WHERE ProductID = $productID";
            $productInfoResult = mysqli_query($conn, $productInfoQuery);
            $productInfo = mysqli_fetch_assoc($productInfoResult);
            $currentTime = date('Y-m-d H:i:s');
        // Nếu không có dòng nào có Status bằng 0, thêm dòng mới
        if (!$hasStatusZero) {
            // Lấy thông tin từ bảng user
            
            $userInfoQuery = "SELECT * FROM user WHERE UserID = {$_SESSION['client']['UserID']}";
            $userInfoResult = mysqli_query($conn, $userInfoQuery);
           
            
            if ($userInfoResult) {
                $userInfo = mysqli_fetch_assoc($userInfoResult);
                $insertOrderQuery = "INSERT INTO oder ( Name, Adress, Email, Phone, Status, total, Time, Description)
                                    VALUES ('', '{$userInfo['Adress']}', '{$userInfo['Email']}', '{$userInfo['Phone']}', 0, 0, '$currentTime', '')";
                
                    
                $insertOrderResult = mysqli_query($conn, $insertOrderQuery);

                $getIDQuery = "SELECT ID FROM oder WHERE Status = 0";
                $getIDResult = mysqli_query($conn, $getIDQuery);
                $ID = mysqli_fetch_assoc($getIDResult)['ID'];
                $insertOrderDetailQuery ="INSERT INTO `oder_deltail`(`oderID`, `productID`, `quantity`, `price`, `Time`, `value`, `Description`)
                    VALUES ($ID, $productID, 1, {$productInfo['price']}, '$currentTime', 0, '');";
                $insertOrderDetailResult = mysqli_query($conn, $insertOrderDetailQuery);
                if ($insertOrderResult) {
                    echo 'Đã thêm thành công sản phẩm vào giỏ hàng!';                   
                }
            } 
        } else {
            $getIDQuery = "SELECT ID FROM oder WHERE Status = 0";
                $getIDResult = mysqli_query($conn, $getIDQuery);
                $ID = mysqli_fetch_assoc($getIDResult)['ID'];

                $checkProductIDQuery = "SELECT * FROM oder_deltail WHERE productID = $productID and `oderID` = $ID";
                $checkProductIDResult = mysqli_query($conn, $checkProductIDQuery);
                
                if ($checkProductIDResult) {
                    $hasProductIDZero = mysqli_num_rows($checkProductIDResult) > 0;
                
                    if (!$hasProductIDZero) {
                        // Bạn chỉ cần thực hiện INSERT nếu không có bản ghi tồn tại
                        $insertOrderDetailQuery = "INSERT INTO `oder_deltail`(`oderID`, `productID`, `quantity`, `price`, `Time`, `value`, `Description`)
                            VALUES ($ID, $productID, 1, {$productInfo['price']}, '$currentTime', 0, '')";
                        $insertOrderDetailResult = mysqli_query($conn, $insertOrderDetailQuery);
                
                        if ($insertOrderDetailResult) {
                            echo 'Đã thêm thành công sản phẩm vào giỏ hàng!';

                        } 
                    } else {
                        // Bạn không cần thực hiện INSERT ở đây
                        // Hãy thực hiện UPDATE trực tiếp
                        $updateQuery = "UPDATE `oder_deltail` SET `quantity` = `quantity` + 1, `price` = `price` + {$productInfo['price']}
                            WHERE `productID` = $productID AND `oderID` = $ID";
                        $updateResult = mysqli_query($conn, $updateQuery);
                
                        if ($updateResult) {
                            echo 'Đã cập nhật thành công sản phẩm trong giỏ hàng!';
                        } 
                    }
                   
                }
                

        }
        $gettotalQuery = "SELECT oderID, SUM(price) AS total_price FROM oder_deltail WHERE oderID = $ID ";

        $gettotalResult = mysqli_query($conn, $gettotalQuery);
        $total = mysqli_fetch_assoc($gettotalResult)['total_price'];
        $totalQuery = "UPDATE `oder` SET `total` = $total WHERE `ID` = $ID";
        $updatetotal = mysqli_query($conn, $totalQuery);
    } 
?>
