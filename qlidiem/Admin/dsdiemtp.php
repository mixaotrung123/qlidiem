<?php
    // B1: Kết nối đến database
    $con = mysqli_connect('localhost', 'root', '', 'qlidiemsv') or die('Lỗi kết nối');

    // Hiển thị danh sách sinh viên
    $sql = "SELECT s.*, dt.diemcc, dt.diemgk FROM sinhvien s
            LEFT JOIN diemthanhphan dt ON s.masv = dt.masv";
    $data = mysqli_query($con, $sql);

    // Xử lí nút tìm kiếm
    $msv = '';
    if (isset($_POST['btntim'])) {
        $msv = $_POST['txtmasv'];
        $sqltk = "SELECT s.*, dt.diemcc, dt.diemgk FROM sinhvien s
                  LEFT JOIN diemthanhphan dt ON s.masv = dt.masv
                  WHERE s.masv LIKE '%$msv%'";
        $data = mysqli_query($con, $sqltk);

        // Kiểm tra dữ liệu mã sinh viên rỗng
        if (empty($msv)) {
            echo "<script>alert('Yêu cầu nhập mã sinh viên')</script>";
        }

        // Kiểm tra tồn tại của mã sinh viên
        $sql1 = "SELECT * FROM sinhvien WHERE masv ='$msv'";
        $dt = mysqli_query($con, $sql1);
        if (mysqli_num_rows($dt) == 0) {
            echo "<script>alert('Mã sinh viên không tồn tại')</script>";
        }
    }

    // Đóng kết nối
    mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điểm thành phần</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
</head>
<body>
    <?php
    include_once './headerqlidiem.php';
    ?>
    <div class="asize">
        <form method="post" action="">
            <table>
                <tr>
                    <td colspan="2">
                        <h5>ĐIỂM THÀNH PHẦN</h5>
                    </td>
                </tr>
                <tr>
                    <td class="col1">Mã sinh viên</td>
                    <td class="col2">
                        <input class="form-control" type="text" name="txtmasv">
                    </td>
                </tr>
                <td class="col1"></td>
                <td class="col2">
                    <input class="form-control" type="submit" name="btntim" value="Tìm kiếm">
                    <script>
                        function load(){
                            location.reload();
                        }
                    </script>
                </td>
                </tr>
            </table>
            <table border="solid black" style="width: 80%">
                <tr style="background: #40E0D0">
                    <th>Mã sinh viên</th>
                    <th>Họ tên</th>
                    <th>Lớp</th>
                    <th>Điểm chuyên cần</th>
                    <th>Điểm giữa kì</th>
                    <th></th>
                </tr>
                <?php 
                // B4: Xử lí kết quả truy vấn (hiển thị mảng $data lên bảng)
                if (isset($data) && $data != null) {
                    $i = 0;
                    while ($row = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $row['masv']; ?></td>
                    <td><?php echo $row['hoten']; ?></td>
                    <td><?php echo $row['lop']; ?></td>
                    <td><?php echo $row['diemcc']; ?></td>
                    <td><?php echo $row['diemgk']; ?></td>
                    <td>
                    <a href="./nhapdiemtp.php?masv=<?php echo $row['masv']; ?>">Nhập điểm</a>
                    <a href="./suadiemtp.php?masv=<?php echo $row['masv']; ?>">Sửa điểm</a>
                    </td>
                </tr>
                <?php
                }
                }
                ?>
            </table>
        </form>
    </div>
</body>
</html>
