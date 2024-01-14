
<?php
include('Header.php');
require('Ketnoi.php');
require('toast.php');

//Thanh toán
if (isset($_POST['thanhtoan'])) {
    $tenkh = $_POST['tenkh'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $note = $_POST['note'];
    $prices = total($cart);
    // Kiểm tra nếu bất kỳ trường nào trống thì hiển thị thông báo
    if (empty($tenkh) || empty($email) || empty($sdt) || empty($diachi)) {
        toast("Vui lòng nhập thông tin thanh toán", "error", "Thông báo");
    } else if (preg_match("/\s{2,}/", $tenkh)) {
        toast("Tên ko được nhập dấu cách", "error", "Vui lòng thử lại");
    }
    else if (preg_match("/\s{2,}/", $note)) {
        toast("Ghi chú chứa dấu cách", "error", "Vui lòng thử lại");
    }
    else if (preg_match("/\s{2,}/", $diachi)) {
        toast("Địa chỉ chứa dấu cách", "error", "Vui lòng thử lại");
    }
    else if (!is_numeric($sdt) || strlen($sdt) !== 10) {
        toast("Số điện thoại không hợp lệ !", "error", "Vui lòng thử lại");
    }
    else {
        $sqls = "INSERT INTO oder(`Name`, `Adress`, `Email`, `Phone`, `total`, `Description`) VALUES(
            '$tenkh','$diachi','$email','$sdt','$prices','$note'
        )";
        $kq = mysqli_query($conn, $sqls);
        if ($kq) {
           
            toast("Thanh toán thành công", "success", "Thông báo");
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'check_out.php';
                    }, 3000);
                </script>";

            unset($_SESSION['cart']);
        }
    }
}
?>
<?php include('Menu.php') 

?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .rating {
            display: inline-block;
            direction: rtl;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            width: 25px;
            height: 25px;
            margin: 0;
            padding: 0;
            font-size: 20px;
            line-height: 25px;
        }

        .rating label:before {
            content: '\2605';
            color: #ddd;
        }

        .rating input:checked ~ label:before {
            color: #f90;
        }
    </style>
</head>
<section id="cart">
    <div class="container">            
  <ul class="pager">
  <li><a href="viewcart.php">Giỏ hàng</a></li>
    <li><a href="doixacnhan.php">Đang xác nhận</a></li>
    <li><a href="danggiao.php">Đang giao</a></li>
    <li><a href="damua.php">Đã mua</a></li>
  </ul>
        <?php
        if (isset($_SESSION['client']['user'])) {
            $email = $_SESSION['client']['Email'];
            $getoderQuery = "SELECT * FROM oder WHERE Status = 1 AND Email = '$email'";
            $getoderResult = mysqli_query($conn, $getoderQuery);
            $hasoderZero = mysqli_num_rows( $getoderResult) > 0;
            if (!$hasoderZero) {
               echo ("<h3 style='text-align: center; color:#009966; text-transform: uppercase;'>Giỏ hàng của bạn đang trống !</h3>");
               echo ("<div style=\"display: flex; justify-content: center; align-items: center;\"><img src='./empty.jpg' alt='ảnh cart'></div>");
            }
            else {
           ?>
               <div class="table_cart">
                   <table class="table_cus">
                       <thead>
                           <tr class="cart_menu">
                               <td class="cart_menu_product">Sản phẩm</td>
                               <td class="cart_menu_price">Giá</td>
                               <td class="cart_menu_quanity">Số lượng</td>
                               <td class="cart_menu_thanhtien">Thành tiền</td>
                               <td></td>
                           </tr>
                       </thead>
                       <tbody >
                           <?php
                           $sql = "SELECT 
                           p.Image,
                           p.Name,
                           p.price,
                           od.quantity,
                           p.ProductID,
                           od.value,
                           od.vote,
                           od.ID, p.discount
                           
                       FROM 
                           oder_deltail od
                       JOIN 
                           products p ON od.productID = p.ProductID
                       JOIN 
                           oder o ON od.oderID = o.ID
                       WHERE 
                           o.Status = 1;
                    ";
                     $kq1 = mysqli_query($conn, $sql);
                     if ($kq1) {
                        while ($value = $kq1->fetch_assoc()) { ?>
                            <tr style="border-bottom: 1px solid #C4DFDF;">
                                <td class="cart_img">
                                <?php
                               if($value['discount'] >0)
                                {
                                ?>
                                 <div class="image_main">
                                    <img src="./Image/Product/<?php echo $value['Image']; ?>" alt="<?php echo $value['Name']; ?>">
                                    <div class = "discount" style = "background-color: red;font-size: 14px;"><?php echo '-'.$value['discount'] .'%'?></div>
                                </div>
                                <?php }else{
                                    echo '<img src="./Image/Product/' . $value['Image'] . '" alt="' . $value['Name'] . '">';
                                }
                                ?>
                                    <h4><a><?php echo $value['Name'] ?></a></h4>
                                </td>
                                <?php
                                if($value['discount'] >0)
                                {
                                ?>
                                <td><p style="text-decoration: line-through;" data-productid="<?php echo $value['price']; ?>"><?php echo number_format($value['price']); ?></p>
                                <p data-productid="<?php echo ($value['price']-($value['price']*$value['discount']*0.01)); ?>"><?php echo number_format($value['price']-($value['price']*$value['discount']*0.01)); ?></p></td></td>
                                <?php
                                }else
                                {
                                ?>
                                <td><p data-productid="<?php echo $value['price']; ?>"><?php echo number_format($value['price']); ?></p>
                                
                                <?php
                                }
                                ?>
                                <td>
                                    <form action="cart.php" method="get">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="ProductID" value="<?php echo $value['ProductID'] ?>">
                                        <input class="cart_quantity_input quantity-input" type="number" name="quantity" value="<?php echo $value['quantity']; ?>" data-productid="<?php echo $value['ProductID']; ?>" readonly>
                                </td>
                        
                                <td class="thanhtien">
                                    <p><span class="total"><?php echo number_format(($value['price']-($value['price']*$value['discount']*0.01)) * $value['quantity']); ?></span></p>
                                </td>
                        
                                <td class="delete"><a href="viewcart.php" class="delete-btn" data-productid="<?php echo $value['ProductID']; ?>"><i class="fa-solid fa-trash-can"></i></a></td>
                                </form>
                            </tr>
                        <?php
                        }}
                        ?>
                        
                        
                       
                       </tbody>
                   </table>
               </div>
               
           <?php }
        
        }
        else
        {
            echo ("<h3 style='text-align: center; color:#009966; text-transform: uppercase;'>Giỏ hàng của bạn đang trống !</h3>");
            echo ("<div style=\"display: flex; justify-content: center; align-items: center;\"><img src='./empty.jpg' alt='ảnh cart'></div>");
        }
        ?>

       
        
        
    </div>
</section>
<?php include('dangki.php') ?>
<?php include('Footer.php') ?>
<!-- Jequery để update số lượng -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateQuantity(event, ProductID) {
        if (event.key === "Enter") {
            $.ajax({
                type: "POST",
                url: "cart.php",
                data: {
                    action: "update",
                    ProductID: ProductID,
                    quantity: quantity
                },
                success: function(response) {

                }
            });
        }
    }
    
</script>
<script>
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            var productID = $(this).data('productid');
            $.ajax({
                type: 'POST',
                url: 'delete.php',
                data: { productID: productID },
                success: function(response) {
                    alert(response);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.thanhtoanthanhcong').click(function() {
            var ID_HD = $(this).data('productid');
            $.ajax({
                type: 'POST',
                url: 'thanhtoanthanhcong.php',
                data: { ID_HD: ID_HD },
                success: function(response) {
                    alert(response);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.quantity-input').change(function() {
            var productID = $(this).data('productid');
            var newQuantity = $(this).val();

            $.ajax({
                type: 'POST',
                url: 'update.php',
                data: { productID: productID, newQuantity: newQuantity },
                success: function(response) {
                    if (response === "success") {
                       
                    }
                }
            });
        });
    });
</script>
<script>
    // Thay đổi cách chọn các phần tử HTML trong vòng lặp
    function updateTotalPrice(inputElement) {
        var row = inputElement.closest('tr');  // Lấy dòng chứa input
        var priceElement = row.querySelector('[data-productid]');
        var totalElement = row.querySelector('.thanhtien .total');
        var tongtien = row.querySelector(' .total .tong');

        var price = parseFloat(priceElement.dataset.productid);
        var quantity = parseInt(inputElement.value);

        var totalPrice = price * quantity;
        // Cập nhật tổng tiền trong HTML
        totalElement.textContent = totalPrice.toFixed(0);

        // Cập nhật tổng tiền của đơn hàng
        updateGrandTotal();
    }

    // Thêm sự kiện lắng nghe cho tất cả các ô input số lượng
    var quantityInputs = document.querySelectorAll('.cart_quantity_input');
    quantityInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            updateTotalPrice(input);
        });
    });

    function updateGrandTotal() {
        var grandTotal = 0;
        var totalElements = document.querySelectorAll('.thanhtien .total');

        totalElements.forEach(function(element) {
            grandTotal += parseFloat(element.textContent);
        });

        // Cập nhật tổng tiền của đơn hàng
        document.getElementById('grand-total').textContent = grandTotal.toFixed(0)+"VND";
    }
</script>
<script>
    $(document).ready(function() {
        $('.saveRating').click(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var productID = $(this).data('productid');
            var rating = $("input[name='rating_" + productID + "']:checked").val();

            $.ajax({
                type: 'POST',
                url: 'submitRating.php',
                data: { productID: productID, rating: rating },
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        });
    });
</script>
