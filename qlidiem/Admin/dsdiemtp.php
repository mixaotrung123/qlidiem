<?php
    //B1: Kết nối đến database
    $con=mysqli_connect('localhost','root','','qlidiemsv') or die('Lỗi kết nối');
    //Hiển thị danh sách sinh viên
    $sql="select * from sinhvien";
    $result=mysqli_query($con,$sql);
    $msv='';$ht='';
    if(isset($_POST['btnluu'])){
        $msv=$_POST['txtmasv'];
        $ht=$_POST['txthoten'];
    }
    $sql="SELECT * FROM diemthanhphan";
    $data=mysqli_query($con,$sql);
    //xử lí nút lưu
   $mtp='';$masv='';$mon='';$dtp='';
   if(isset($_POST['btnluu'])){
        $mtp=$_POST['txtmatp'];
        $msv=$_POST['txtmasv'];
        $mon=$_POST['txtmon'];
        $dtp=$_POST['txtdiemtp'];
   }
   // kiểm tra dữ liệu mã loại rỗng
   if($mtp==''){
    "<script> alert('Yêu cầu nhập mã sinh viên')</script>";
   }
   //kiểm tra trùng khoá chính
   $sql1="SELECT * FROM diemthanhphan WHERE matp ='$mtp'";
   $dt=mysqli_query($con,$sql1);
   if(mysqli_num_rows($dt)>0){
    "<script> alert('Trùng mã')</script>";
   }
   else{
    //tạo và thực hiện truy vấn chèn dữ liệu vào bảng 
    $sql="INSERT INTO diemthanhphan VALUES('$mtp','$msv','$mon','$dtp')";
    $kq=mysqli_query($con,$sql);
    if($kq) echo "<script> alert('Thêm mới thành công')</script>";
    else  " <script>alert('Thêm mới thất bại') </script>";
   }

   //Thêm điểm vào bảng
   $sql="SELECT * FROM sinhvien LEFT JOIN diemthanhphan ON sinhvien.masv=diemthanhphan.diemtp";
   $kq=mysqli_query($con,$sql);

   //Thêm dữ liệu vào bảng
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
                    <h5>ĐIỂM THÀNH PHẦN</h5>
                </td>
            </tr>
            <tr>
            <td class="col1">Mã thành phần</td>
            <td class="col2">
                <input class="form-control" type="text" name="txtmatp">
            </td>
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
            <td class="col1">Điểm thành phần</td>
            <td class="col2">
                <input class="form-control" type="text" name="txtdiemtp">
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
                <tr style="background: #40E0D0">
                     <th>Mã thành phần</th>
                     <th>Mã sinh viên</th>
                     <th>Môn</th>
                     <th>Điểm thành phần</th>
                </tr>
                <?php
                if(isset($data)&&$data!=null){
                    $i=0;
                    while($row=mysqli_fetch_array($data)){
                ?>
      
                <tr>
                    <td> <?php echo $row['matp']?></td>
                    <td> <?php echo $row['masv']?></td>
                    <td> <?php echo $row['mon']?></td>
                    <td> <?php echo $row['diemtp']?></td>
                    <td >
                            <a href="./Suadiemtp.php?mtp=<?php echo $row['matp'] ?>"><span style="color:blue"><u>Sửa</u></span></a>
                            <a href="./Xoadiemtp.php?mtp=<?php echo $row['matp'] ?>"><span style="color:blue"><u>Xóa</u></span></a>
                            
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