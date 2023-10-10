<?php
// B1: Kết nối đến database
$con = mysqli_connect('localhost', 'root', '', 'qlidiemsv') or die('Lỗi kết nối');

// B2: Lấy mã sinh viên từ URL
$masv = isset($_GET['masv']) ? $_GET['masv'] : '';

// B3: Kiểm tra nút Lưu đã được nhấn hay chưa
if (isset($_POST['btnluu'])) {
    // B4: Lấy dữ liệu mới từ form
    $dcc = $_POST['txtdiemcc'];
    $dgk = $_POST['txtdiemgk'];

    // B5: Tạo truy vấn SQL để cập nhật điểm
    $sqlUpdateDiem = "UPDATE diemthanhphan SET diemcc='$dcc', diemgk='$dgk' WHERE masv='$masv'";

    // B6: Thực hiện truy vấn cập nhật
    $resultUpdateDiem = mysqli_query($con, $sqlUpdateDiem);
    if ($resultUpdateDiem) {
        echo "Cập nhật điểm thành công!";
        header("location:dsdiemtp.php");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($con);
    }
}

// B7: Truy vấn để lấy dữ liệu điểm hiện tại
$sqlGetDiem = "SELECT * FROM diemthanhphan WHERE masv='$masv'";
$resultGetDiem = mysqli_query($con, $sqlGetDiem);

// Kiểm tra xem có dữ liệu trả về không
if ($resultGetDiem && mysqli_num_rows($resultGetDiem) > 0) {
    $diemData = mysqli_fetch_assoc($resultGetDiem);
} else {
    // Xử lý trường hợp không tìm thấy dữ liệu
    echo "Không tìm thấy dữ liệu điểm cho sinh viên này.";
    exit;
}


// B8: Đóng kết nối
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa điểm thành phần</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
</head>
<body>
    <?php
    include_once './headerqlidiem.php';
    ?>
    <div class="aside">
        <form action="" method="post">
            <table>
                <tr>
                    <h5>Sửa điểm</h5>
                </tr>
                <tr>
                    <td class="col1">Điểm chuyên cần</td>
                    <td class="col2">
                    <input type="text" name="txtdiemcc" value="<?php echo $diemData['diemcc'] ?> ">
                    </td>
                </tr>
                <tr>
                    <td class="col1">Điểm giữa kỳ</td>
                    <td class="col2">
                    <input type="text" name="txtdiemgk" value="<?php echo $diemData['diemgk'] ?> ">
                    </td>
                </tr>
                <tr>
                <td class="col1"></td>
                <td class="col2">
                    <input class="form-control" type="submit" name="btnluu" value="Lưu">
                </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>