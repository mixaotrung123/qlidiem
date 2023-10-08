<?php
//B1: Kết nối đến database
$con=mysqli_connect('localhost','root','','qlidiemsv') or die('Lỗi kết nối');

//xử lí nút lưu
$mdt='';$mon='';$dts='';$dtc='';$msv='';
if(isset($_POST['btnluu'])){
    $mdt=$_POST['txtmdt'];
    $mon=$_POST['txtmon'];
    $dts=$_POST['txtdts'];
    $dtc=$_POST['txtdtc'];
}

// kiểm tra dữ liệu mã loại rỗng
if($mdt==''){
 "<script> alert('Yêu cầu nhập mã')</script>";
}
//kiểm tra trùng khoá chính
$sql1="SELECT * FROM diemthi WHERE madiemthi ='$mdt'";
$dt=mysqli_query($con,$sql1);
if(mysqli_num_rows($dt)>0){
 "<script> alert('Trùng mã')</script>";
}
else{
 //tạo và thực hiện truy vấn chèn dữ liệu vào bảng loaisach
$sql="INSERT INTO diemthi VALUES('$mdt','$msv','$mon','$dts','$dtc')";
$kq=mysqli_query($con,$sql);
if($kq) echo "<script> alert('Thêm mới thành công')</script>";
else echo " <script>alert('Thêm mới thất bại') </script>";
}

//lấy dữ liệu từ bảng sinhvien
$sql="SELECT masv, hoten, lop FROM sinhvien";
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
    include_once './headerqlidiem.php';
    ?>
<div class="asize">
    <form method="post" action="">
        <table>
            <tr>
                <td colspan="2">
                    <h5>Thêm điểm thi</h5>
                </td>
            </tr>
            <tr>
            <td class="col1">Mã điểm thi</td>
            <td class="col2">
                <input class="form-control" type="text" name="txtmdt">
            </td>
        </tr>
        <tr>
            <td class="col1">Mã sinh viên</td>
            <td class="col2">
                <input class="form-control" type="text" name="txtmsv">
            </td>
        </tr>
        <tr>
            <td class="col1">Môn</td>
            <td class="col2">
                <input class="form-control" type="text" name="txtmon">
            </td>
        </tr>
        <tr>
            <td class="col1">Điểm thi số</td>
            <td class="col2">
                <input class="form-control" type="text" name="txtdts">
            </td>
        </tr>
        <tr>
            <td class="col1">Điểm thi chữ</td>
            <td class="col2">
                <input class="form-control" type="text" name="txtdtc">
            </td>
        </tr>   
        <tr>
                <td class="col1"></td>
                <td class="col2">
                <input class="form-control" type="submit" name="btnluu" value="Lưu">
                <script>
                    function load(){
                        location.reload(); 
                    }
                    </script>
            </td>
        </tr>
        </table>
        <table border="solid black" style="width: 80%" >
                <tr style="background: violet;">
                    <th>Mã điểm thi</th>
                     <th>Mã sinh viên</th>
                     <th>Họ tên</th>
                     <th>Lớp</th>
                     <th>Môn</th>
                    <th>Điểm thi số</th>
                    <th>Điểm thi chữ</th>
                </tr>
                <?php
                if(isset($data1)&&$data1!=null){
                    $i=0;
                    while($row=mysqli_fetch_array($data1)){
                ?>
      
                <tr>
                    <?php
                    //hiển thị dữ liệu
while($row=mysqli_fetch_assoc($data)){
    echo "<tr>";
    echo "<td>".$row['masv']."</td>";
    echo "<td>".$row['hoten']."</td>";
    echo "<td>".$row['lop']."</td>";
    echo "</tr>";
   }
   ?>
                    <td> <?php echo $row['masv']?></td>
                    <td> <?php echo $row['hoten']?></td>
                    <td> <?php echo $row['mon']?></td>
                    <td> <?php echo $row['diemthiso']?></td>
                    <td> <?php echo $row['diemthichu']?></td>
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