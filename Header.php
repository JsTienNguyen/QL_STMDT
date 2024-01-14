<?php
session_start();
ob_start();
require_once 'cart_f.php';
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OWN MALL</title>
    <link rel="icon" href="./Image/logocop.png" type="image/png">

    <!-- Custom css -->
    <link rel="stylesheet" href="./Css/style.css">
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <!-- Jequery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- sweet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.9.0/sweetalert2.min.css">
    <!-- slider -->
    <link rel="stylesheet" href="owlcarousel/assets/owl.theme.green.min.css">
    <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <head>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
            }

            .image_main {
                position: relative;
                display: inline-block;
                /* Để có thể sử dụng position:relative cho .image_main */
            }


            #mainImage {
                z-index: 2;
                width: 100%;
                height: auto;
                display: block;
                /* Loại bỏ khoảng trắng dư thừa dưới hình ảnh */
            }

            .discount {
                position: absolute;
                top: 10px;
                left: 10px;
                color: #fff;
                font-size: 18px;
                font-weight: bold;
                z-index: 2;
                /* Đảm bảo nằm trên phần gradient */
            }
        </style>
    </head>
</head>

<body>

    <!-- thanh cuộn -->

    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
    <!-- Header -->
    <header id="header">
        <!-- Header_top -->
        <div class="header_top">
            <div class="contacinfo">
                <ul class="nav">
                    <li><a href="tel:0999999999"><i class="fa fa-phone"></i> +84 999999999</a></li>
                    <li><a><i class="fa fa-envelope"></i> ownmall.com</a></li>
                </ul>
            </div>
            <div class="media">
                <ul class="nav_media">
                    <li><a href="https://web.facebook.com/NgMinhTienn"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://web.facebook.com/NgMinhTienn"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://web.facebook.com/NgMinhTienn"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="https://web.facebook.com/NgMinhTienn"><i class="fa fa-dribbble"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- header-middle -->
        <div class="header-middle">
            <div class="container_header">
                <!-- Logo -->
                <div class="header_logo">
                    <a href="index.php">
                        <img style="padding-top: 10px;" width="120px;" height="75px;" src="./Image/logocop.png"
                            alt="Logo">
                    </a>
                </div>

                <!-- Tìm kiếm -->
                <div class="header_search">
                    <form action="timkiem.php" method="get">
                        <div class="search">
                            <input type="text" name="search" id="search" placeholder="Vui lòng nhập từ khóa ">
                            <button><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <!-- Login .cart -->
                <div class="header_mid">
                    <ul class="header_mids">
                        <li><i class="fa-solid fa-basket-shopping"></i><span class="aa-cart-notify">
                                <?php
                                $getsum_oderdetail_Query = "SELECT * FROM oder_deltail";
                                $getsum_oderdetail_result = mysqli_query($conn, $getsum_oderdetail_Query);
                                $has_oderdeltail = mysqli_num_rows($getsum_oderdetail_result);
                                echo $has_oderdeltail;
                                ?>
                            </span><a href="viewcart.php">Giỏ Hàng</a></li>
                        <?php
                        if (isset($_SESSION['client']['user'])) {

                            echo "<li> <i class='fa-solid fa-user-tie'></i>Xin chào, {$_SESSION['client']['user']}</li>
                            <li><i class='fa-solid fa-right-from-bracket'></i><a href='Logout.php'>Đăng xuất</a></li>";
                        } else {
                            echo "<li><i class='fa-regular fa-circle-user'></i><a href='registerch.php'>Đăng ký với cửa hàng</a></li>";
                            echo "<li><i class='fa-regular fa-circle-user'></i><a href='Login.php'>Đăng Nhập</a></li>";
                        }

                        ?>
                    </ul>
                </div>
            </div>
        </div>

    </header>
    <div class="fixed-media">
        <a href="https://zalo.me/g/jnddwk747"><img src="https://web.nvnstatic.net/tp/T0298/img/zalo.svg?v=3" alt=""></a>
    </div>
    <div class="fixed-media_call">
        <a href="tel:0372583407"><img src="https://web.nvnstatic.net/tp/T0298/img/hotline.svg?v=3" alt=""></a>
    </div>
    <div class="fixed-media_mess">
        <a href="https://www.facebook.com/messages/t/516522759"><img src="https://janhome.vn/images/icon/messenger.svg"
                alt=""></a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productRatingElements = document.querySelectorAll('.product-rating');

            productRatingElements.forEach((starRatingElement) => {
                const vote = parseFloat(starRatingElement.dataset.vote);

                if (vote === 0) {
                    // Nếu điểm vote là 0, đặt màu trắng cho tất cả ngôi sao
                    for (let i = 0; i < 5; i++) {
                        const star = document.createElement('span');
                        star.classList.add('star');
                        star.innerHTML = '&#9734;'; // Màu trắng cho ngôi sao
                        starRatingElement.appendChild(star);
                    }
                } else {
                    // Nếu điểm vote khác 0, thực hiện hiển thị ngôi sao màu vàng như trước
                    const integerPart = Math.floor(vote);
                    const decimalPart = vote - integerPart;

                    for (let i = 0; i < 5; i++) {
                        const star = document.createElement('span');
                        star.classList.add('star');
                        if (i < integerPart || (i === 0 && vote === 0)) {
                            star.innerHTML = '&#9733;';
                        } else if (i === integerPart) {
                            star.innerHTML = '&#9733;';
                            star.style.clipPath = `polygon(0 0, ${decimalPart * 100}% 0, ${decimalPart * 100}% 100%, 0 100%)`;
                        }

                        starRatingElement.appendChild(star);
                    }
                }
            });
        });

    </script>