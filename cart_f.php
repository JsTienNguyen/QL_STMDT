<?php 
    require_once('Ketnoi.php');
    // thành tiền
    function total ($cart){
        $total_cart = 0;
        foreach ($cart as $key => $value) {
            if (isset($value['price'])) {
                // Access the 'price' key
                $price = $value['price'];
            $total_cart += ($value['quantity']*$price);
            }
        }
        return $total_cart;
    }
    
    // Số lượng sản phẩm trong giỏ hàng
    function totalItems($cart) {
        return count($cart);
    }
?>

