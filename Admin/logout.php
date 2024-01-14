<?php
session_start();
ob_start();
session_destroy();
include("thongbao.php");
toast("Đã đăng xuất", "success", "Thông báo");
echo "<script>
                  setTimeout(function() {
                  window.location.href = 'http://localhost/QLSTMDT/QL_STMDT/Login.php';
                  }, 3000)
                  </script>";