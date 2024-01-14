<div class="new">
                <div class="product_new ">
                    <div class="product_title">
                        <h3>Sản phẩm Bán chạy nhất</h3>
                    </div>
                    <div class="product_newcart owl-carousel owl-theme wow fadeInDown">
                        <?php
                        require_once('Ketnoi.php');
                        $sql = 'SELECT * FROM products ORDER BY Totalbuy DESC LIMIT 10';
                        $result = mysqli_query($conn, $sql);
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $tensanpham = $row["Name"];
                                $image = $row['Image'];
                                $gia = $row['price'];
                                $vote = $row['vote'];
                                $discount = $row['discount'];
                                echo '<div class="cart_item">';
                                if($discount >0)
                                {
                                ?>
                                 <div class="image_main">
                                    <img src="./Image/Product/<?php echo $image; ?>" alt="<?php echo $tensanpham; ?>">
                                    <div class = "discount" style = "background-color: red;"><?php echo '-'.$discount .'%'?></div>
                                </div>
                                <?php }else{
                                    echo '<img src="./Image/Product/' . $image . '" alt="' . $tensanpham . '">';

                                ?>
                                <?php
                                }
                                echo '<a href="product_deltail.php?ProductID=' . $row["ProductID"] . '">' . $tensanpham . '</a><br>';
                               
                                if($discount>0)
                                {
                                 ?>
                                  <bdi style="text-decoration: line-through;"><?= number_format($gia) ?>đ</bdi><br>
                                 <bdi><?= number_format($gia - ($discount * $gia *0.01)) ?>đ</bdi>
                                 <?php
                                }
                                else
                                {
                                 ?>
                                  <bdi ><?= number_format($gia) ?>đ</bdi><br>
                                 <?php
                                }
                                 
                                echo '<div class="star-rating product-rating" data-vote="' . $vote . '"></div>';
                                echo '</div>';
                            }
                            ?>
                            
                        <?php
                            
                        } else {
                            echo "Không tìm thấy sản phẩm bán chạy nào.";
                        }
                        ?>
                        
                    </div>


                </div>
            </div>
