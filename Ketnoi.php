<?php
$conn = mysqli_connect("localhost", "root", "", "ql_stmdt");
if (!$conn) {
    die("Lỗi kết nối: " . mysqli_connect_error());
}
?>