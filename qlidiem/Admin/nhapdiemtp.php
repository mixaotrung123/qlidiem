<?php
// B1: Kết nối đến DB
$con = mysqli_connect('localhost', 'root', '', 'qlidiemsv') or die('Lỗi kết nối');

$msv = '';
$dcc = '';
$dgk = '';
$m='';
$ng='';

if (isset($_GET['masv'])) {
    $msv = $_GET['masv'];
    $sql1 = "SELECT * FROM diemthanhphan WHERE masv='$msv'";
    $data = mysqli_query($con, $sql1);
}

// kiểm tra dữ liệu mã loại rỗng
if($msv==''){   
   echo  "<script> alert('Yêu cầu nhập mã sinh viên')</script>";
    }
    //kiểm tra trùng khoá chính
    $sql1="SELECT * FROM diemthanhphan WHERE masv ='$msv'";
    $dt=mysqli_query($con,$sql1);
    if(mysqli_num_rows($dt)>0){
     echo "<script> alert('Trùng mã')</script>";
    }
    if($dcc&&$dgk==''){
     echo   "<script> alert('Yêu cầu nhập điểm')</script>";
    }


if (isset($_POST['btnluu'])) {
    $msv = $_POST['txtmasv'];
    $m=$_POST['txtmon'];
    $ng=$_POST['txtnganh'];
    $dcc = $_POST['txtdiemcc'];
    $dgk = $_POST['txtdiemgk'];
}
    // Tạo truy vấn cập nhật dữ liệu trong bảng
    $sql = "INSERT INTO `diemthanhphan` VALUES ('$msv','$m','$ng','$dcc','$dgk')";
    $kq = mysqli_query($con, $sql);
    if ($kq) {
       echo "<script> alert('Nhập điểm thành công')</script>";
        header("location:dsdiemtp.php");
        exit();
    } else {
       echo "<script> alert('Yêu cầu nhập lại')</script>";}

// Đóng kết nối
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập điểm thành phần</title>
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
                    <h5>Nhập điểm</h5>
                </tr>
                 <tr>
                     <td class="col1">Mã sinh viên</td>
                      <td class="col2">
                         <input class="form-control" type="text" name="txtmasv">
                     </td>
                </tr>
                <tr>
                     <td class="col1">Môn</td>
                      <td class="col2">
                         <input class="form-control" type="text" name="txtmon">
                     </td>
                </tr>
                <tr>
                     <td class="col1">Ngành</td>
                      <td class="col2">
                         <input class="form-control" type="text" name="txtnganh">
                     </td>
                </tr>
                <tr>
                     <td class="col1">Điểm chuyên cần</td>
                      <td class="col2">
                         <input class="form-control" type="text" name="txtdiemcc">
                     </td>
                </tr>
                <tr>
                     <td class="col1">Điểm giữa kì</td>
                      <td class="col2">
                         <input class="form-control" type="text" name="txtdiemgk">
                     </td>
                </tr>
                <tr>
                <td class="col1"></td>
                <td class="col2">
                    <input class="form-control" type="submit" name="btnluu" value="Lưu">
                </td>
                </tr>
                <?php
                if (isset($data) && $data != null) {
                    while ($row = mysqli_fetch_array($data)) {
                ?>
                  <?php
                    }
                }
                ?>
            </table>
        </form>
    </div>
</body>
</html>
