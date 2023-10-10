<?php
    //B1: Kết nối đến database
    $con=mysqli_connect('localhost','root','','qlidiemsv') or die('Lỗi kết nối');
    $sql="SELECT * FROM sinhvien";
    $data=mysqli_query($con,$sql);
    //xử lí nút lưu
   $msv='';$ht='';$ns='';$dc='';$l='';
   if(isset($_POST['btnluu'])){
        $msv=$_POST['txtmasv'];
        $ht=$_POST['txthoten'];
        $ns=$_POST['txtngaysinh'];
        $dc=$_POST['txtdiachi'];
        $l=$_POST['lop'];
   }
   
   // kiểm tra dữ liệu mã loại rỗng
   if($msv==''){   
   "<script> alert('Yêu cầu nhập mã sinh viên')</script>";
   }
   //kiểm tra trùng khoá chính
   $sql1="SELECT * FROM sinhvien WHERE masv ='$msv'";
   $dt=mysqli_query($con,$sql1);
   if(mysqli_num_rows($dt)>0){
    "<script> alert('Trùng mã')</script>";
   }
   else{
    //tạo và thực hiện truy vấn chèn dữ liệu vào bảng loaisach
    $sql="INSERT INTO sinhvien VALUES('$msv','$ht','$ns','$dc','$l')";
    $kq=mysqli_query($con,$sql);
    if($kq) echo "<script> alert('Thêm mới thành công')</script>";
    else echo " <script>alert('Thêm mới thất bại') </script>";
    header("location:DSsinhvien.php");
   }
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
                        <h5>Thêm sinh viên</h5>
                    </td>
                </tr>
            <tr>
                <td class="col1">Mã sinh viên</td>
                <td class="col2">
                    <input class="form-control" type="text" name="txtmasv" value="<?php echo $msv?>">
                </td>
            </tr>
            <tr>
                <td class="col1">Họ tên</td>
                <td class="col2">
                    <input class="form-control" type="text" name="txthoten" value="<?php echo $ht?>">
                </td>
            </tr>
            <tr>
                <td class="col1">Ngày sinh</td>
                <td class="col2">
                    <input class="form-control" type="date" name="txtngaysinh" value="<?php echo $ns?>">
                </td>
            </tr>
            <tr>
                <td class="col1">Địa chỉ</td>
                <td class="col2">
                    <input class="form-control" type="text" name="txtdiachi" value="<?php echo $dc?>">
                </td>
            </tr>
            <tr>
                <td class="col1">Lớp</td>
                <td class="col2">
                    <select name="lop">
                        <optgroup label="Công nghệ thông tin">
                            <option value="TT01">TT01</option>
                            <option value="TT02">TT02</option>
                            <option value="TT03">TT03</option>
                        </optgroup>
                        <optgroup label="Kế toán">
                            <option value="KT01">KT01</option>
                            <option value="KT02">KT02</option>
                            <option value="KT03">KT03</option>
                        </optgroup>
                        <optgroup label="Kĩ thuật ô tô">
                            <option value="OT01">OT01</option>
                            <option value="OT02">OT02</option>
                            <option value="OT03">OT03</option>
                        </optgroup>
                    </select>
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