
<div class="new">
   <div class="product_new wow fadeInDown">
      <div class="product_title">
         <h3 >Sản phẩm giảm giá</h3>
      </div>
      <div class="product_newcart owl-carousel owl-theme">
         <?php
         require_once('Ketnoi.php');
         $sql = 'SELECT * FROM products where discount >0';
         $result = mysqli_query($conn, $sql);
         if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
               $tensanpham = $row["Name"];
               $image = $row['Image'];
               $gia = $row['price'];
               $discount = $row["discount"];
               $vote = $row['vote'];
         ?>
               <div class="cart_item">
               <div class="image_main">
                  <img src="./Image/Product/<?php echo $image; ?>" alt="<?php echo $tensanpham; ?>">
                  <div class = "discount" style = "background-color: red;"><?php echo '-'.$discount .'%'?></div>
               </div>
                  <a href="product_deltail.php?ProductID=<?php echo $row["ProductID"] ?>"><?php echo $tensanpham; ?></a> <br>
                  <span style="text-decoration: line-through;"><?php echo number_format($gia); ?>đ</span><br>
                  <span><?php echo number_format($gia-($gia * $discount*0.01)); ?>đ</span><br>
               <?php echo '<div class="star-rating product-rating" data-vote="' . $vote . '"></div>';
 ?>
               </div>

         <?php
            }
         } else {
            echo "Không tìm thấy sản phẩm nào.";
         }
         ?>

      </div>


   </div>
</div>