<?php
    //B1: Kết nối đến database
    $con=mysqli_connect('localhost','root','','qlidiemsv') or die('Lỗi kết nối');
    $sql="SELECT * FROM sinhvien";
    $data=mysqli_query($con,$sql);
   mysqli_close($con)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sinh viên</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
</head>
<body>
    <?php
    include_once './trangchusv.php';
    ?>
    <h2>Danh sách sinh viên</h2>
            </table>
            <table border="solid black" style="width: 80%" >
                    <tr style="background: 	#40E0D0;">
                        <th>Mã sinh viên</th>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>  
                        <th>Địa chỉ</th>
                        <th>Lớp</th>
                        <th></th>
                    </tr>
            <?php
            //B4: Xử lí kết quả truy vấn (hiển thị mảng $data lên bảng)
                        if(isset($data)&&$data!=null){
                        $i=0;
                        while($row=mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td> <?php echo $row['masv']?></td>
                        <td> <?php echo $row['hoten']?></td>
                        <td> <?php echo $row['ngaysinh']?></td>
                        <td> <?php echo $row['diachi']?></td>
                        <td> <?php echo $row['lop']?></td>
                    </tr>
                    <?php
                    //Kt B4
                    }
                }
                    ?>
            </table>
        </form>
    </div>
</body>
</html>