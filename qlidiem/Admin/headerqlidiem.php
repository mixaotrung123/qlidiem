<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        .wrapper {
            width: 1000px;
            margin: 0px auto;
            background: black;
            font-size: 14px;
            line-height: 1.5 line;
        }

        header {
            height: 100px;
            background-color: #20B2AA;
            color: black;
            margin-bottom: 20px;
            display: block;
        }

        header h1 {
            padding-top: 60px;
            font-size: 30px;
        }

        .nav-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            justify-content: space-evenly;
            display: flex;
        }

        h1 {
            text-align: center
        }

        .nav-menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .nav-menu > ul > li {
            float: left;
        }

        .nav-menu > ul > li:hover {
            display: block;
            background: #939393;
        }

        .nav-menu > ul > li > a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .article {
            padding-bottom: 30px;
            width: 17%;
            background-color: #20B2AA;
            float: left;
            height: 600px; 
        }

        .article > ul {
            padding: 0px;
        }

        .article > ul > li {
            list-style: none;
            padding: 10px 5px;
            border: #B1B1B1 dotted 1px;
        }
        .article > ul > li > a{
            font-size: large;
            color: #EEE8AA;
            font-weight: bold;
        }


        .article > ul > li:hover {
            background: #939393;
        }

        .article > ul > li > ul > li {
            list-style: none;
            text-decoration: none;
            font-size: medium;
            margin-left: 20px;
            color: #000;
        }

        .article > ul > li >ul >li >a{
            color:#F4A460;
        }

        .article ul ul {
            display: none;
        }

        .article ul li:hover ul {
            display: block; 
        }

        table {
            width: 80%;
            padding-top: 20px;
        }

        .col1 {
            list-style-type: none;
            width: 20%;
            text-align: left;
            height: 25px;
            padding: 5px 35px;
        }

        .col2 {
            width: 55%;
            text-align: left;
            height: 25px;
            padding: 5px;
        }

        .aside {
            height: 600px;
            background-color: #f3f1f0;
        }

        footer {
            height: 70px;
            background: #4f3590;
        }

        .dd1 {
            width: 250px;
            height: 20px;
        }

        tr {
            height: 40px;
        }

        .dd2 {
            width: 30%;
            padding-left: 80px;
            font-size: 18px;
        }

        .dd3 {
            width: 70%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Trang quản lí điểm sinh viên</h1>
    </header>
    <nav class="nav-menu">
        <ul>
            <li><a href="./headerqlidiem.php">Trang chủ</a></li>
            <li><a href="./login.php">Đăng nhập</a></li>
        </ul>
    </nav>
    <div class="article">
        <ul>
            <li><a href="">Quản lí sinh viên</a>
                <ul>
                    <li><a href="./DSsinhvien.php">Thêm sinh viên</a></li>
                </ul>
            </li>
            <li><a href="">Quản lí điểm</a>
                <ul>
                    <li><a href="./dsdiemtp.php">Điểm thành phần</a></li>
                    <li><a href="./dsdiemthi.php">Điểm thi</a></li>
                </ul>
            </li>
        </ul>
    </div>
</body>
</html>
