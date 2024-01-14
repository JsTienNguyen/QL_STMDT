<?php
require('Header_admin.php');
?>
<?php
include('Conect.php');
require('Nav_left.php');
$sql = "SELECT COUNT(*) as tongsanpham FROM products";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $tongsanpham = $row['tongsanpham'];
} else {
    $tongsanpham = 0;
}
?>
<!-- Tin tức -->
<?php
$sql1 = "SELECT COUNT(*) as tongpost FROM post";
$result = mysqli_query($conn, $sql1);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $tongpost = $row['tongpost'];
} else {
    $tongpost = 0;
}
?>
<!-- Doanh Thu -->
<?php
$sql = "SELECT SUM(Totalbuy) as Totalbuys FROM products";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $tongdoanhthu = $row['Totalbuys'];
} else {
    $tongdoanhthu = 0;
}
?>
<!-- Tài khoản -->
<?php
$sql2 = "SELECT COUNT(*) as tongusser FROM user";
$result = mysqli_query($conn, $sql2);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $tongusser = $row['tongusser'];
} else {
    $tongusser = 0;
}
?>
<?php
$sql3 = "SELECT COUNT(*) as tongoder FROM oder";
$result = mysqli_query($conn, $sql3);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $tongoder = $row['tongoder'];
} else {
    $tongoder = 0;
}
?>
<div class="page-container">
    <div class="main-content">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-blue">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">
                                    <?php echo $tongsanpham; ?>
                                </h2>
                                <p class="m-b-0 text-muted">Sản phẩm</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                <i class="fa-solid fa-comment-dollar"></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">
                                    <?php echo $tongoder; ?>
                                </h2>
                                <p class="m-b-0 text-muted">Đơn hàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-purple">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">
                                    <?php echo $tongpost; ?>
                                </h2>
                                <p class="m-b-0 text-muted">Tin tức </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-purple">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">
                                    <?php echo $tongpost; ?>
                                </h2>
                                <p class="m-b-0 text-muted">Số lượng đã bán </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-purple">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">
                                    <?php echo $tongdoanhthu; ?>
                                </h2>
                                <p class="m-b-0 text-muted">Doanh thu </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
            <?php
            $sql1 = "SELECT COUNT(*) as tonglienhe FROM contact";
            $result = mysqli_query($conn, $sql1);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $tonglienhe = $row['tonglienhe'];
            } else {
                $tonglienhe = 0;
            }
            ?>
        </div>
    </div>
    <?php
    require('Footer_Admin.php');
    ?>