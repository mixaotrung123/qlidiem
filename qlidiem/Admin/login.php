<?php
session_start();

if (isset($_POST['login'])) {
    // Lấy giá trị nhập từ người dùng
    $masv = $_POST['masv'];
    $mk = $_POST['matkhau'];
    $vt = $_POST['vaitro'];

    // Kết nối đến cơ sở dữ liệu
    try {
        $conn = new PDO('mysql:host=localhost;dbname=qlidiemsv', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
    }

    // Kiểm tra xem người dùng có tồn tại trong cơ sở dữ liệu không bằng cách sử dụng câu lệnh chuẩn bị
    $sql = 'SELECT * FROM taikhoan WHERE masv = :masv AND vaitro = :vaitro';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':masv', $masv);
    $stmt->bindParam(':vaitro', $vt);

    try {
        $stmt->execute();
        $user = $stmt->fetch();
    } catch (PDOException $e) {
        die("Truy vấn cơ sở dữ liệu thất bại: " . $e->getMessage());
    }

    // Kiểm tra xem người dùng đã được tìm thấy và xác minh mật khẩu
    if ($user && $mk == $user['matkhau']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['masv'] = $user['masv'];
        $_SESSION['vaitro'] = $user['vaitro'];

        if ($vt == 'Admin') {
            header("Location: http://localhost/qlidiem/Admin/headerqlidiem.php");
        } else {
            header("Location: http://localhost/qlidiem/Student/trangchusv.php");
        }
        exit;
    } else {
        // Đăng nhập thất bại
        echo "Đăng nhập thất bại. Vui lòng kiểm tra thông tin đăng nhập của bạn.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
</head>
<body>
    <h1 align="center"><b><font color="red">Đăng nhập</h1></b></font>
    <form action="login.php" method="post">
        <table border="0" align="center">
            <tr>
                <td>Mã sinh viên</td>
                <td>
        <input type="text" name="masv" required>
                </td>   
            </tr>
            <tr>
                <td>Mật khẩu</td>
                <td>
        <input type="password" name="matkhau" required>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
       <select name="vaitro" required>
            <option value="Admin">Admin</option>
            <option value="Student">Sinh viên</option>
        </select>
</td>
            </tr>
            <tr>
                <td></td>
                <td>
        <input type="submit" name="login" value="Đăng nhập">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
