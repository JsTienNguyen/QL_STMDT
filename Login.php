<?php
session_start();
ob_start();
require('Ketnoi.php');
require('toast.php');

if (isset($_POST['login'])) {
    if (isset($_POST['user']) && isset($_POST['pass'])) {
        $user = $_POST['user'];
        $pass = trim($_POST['pass']);
        $pass = md5($pass);
        $email = $_POST['email'];
        if (empty($user) || empty($pass)) {
            toast("Vui lòng nhập thông tin đăng nhập", "error", "Vui lòng nhập lại");
        } else {
            $sql = "SELECT * FROM `user` WHERE user = '$user' AND Password='$pass' AND 	Email='$email' ";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                if ($row['RoleID'] == 3) {
                    $_SESSION['admin']['user'] = $user;
                    $redirectUrl = getRedirectUrl(3);
                } else {
                    $_SESSION['client']['user'] = $user;
                    $_SESSION['client']['UserID'] = $row['UserID'];
                    $_SESSION['client']['Email'] = $row['Email'];
                    $redirectUrl = getRedirectUrl(3);
                }
                toast("Đăng Nhập Thành Công", "success", "Chuyển hướng sau 3s");
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '$redirectUrl';
                    }, 3000);
                </script>";
            } else {
                toast("Sai thông tin đăng nhập", "error", "Vui lòng nhập lại");
            }
        }
    }
}

function getRedirectUrl($roleId)
{
    switch ($roleId) {
        case 1:
            return 'http://localhost/QLSTMDT/QL_STMDT/Admin/index.php';
        case 2:
            return 'http://localhost/QLSTMDT/QL_STMDT/index.php';
        case 3:
            return 'http://localhost/QLSTMDT/QL_STMDT/Admin_Store/index.php';
        default:
            return 'index.php';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/login.css">
    <title>Đăng Nhập</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <p class="title">Đăng Nhập</p>
            <form class="form" method="post" action="Login.php">
                <input type="text" value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user']) : ''; ?>"
                    name="user" class="input" placeholder="Tài khoản">
                <input type="text"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" name="email"
                    class="input" placeholder="Email">

                <input type="password"
                    value="<?php echo isset($_POST['pass']) ? htmlspecialchars($_POST['pass']) : ''; ?>" name="pass"
                    class="input" placeholder="Mật khẩu">
                <button class="form-btn" name="login">Đăng nhập</button>
            </form>
            <p class="sign-up-label">
                Bạn chưa có tài khoản?<span class="sign-up-link">
                    <a href="register.php">Đăng kí</a>
                </span>
            </p>
        </div>
    </div>
</body>

</html>