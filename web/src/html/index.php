<?php
error_reporting(0);

function sqlwaf($str)
{
    $str = str_ireplace("and", "sqlwaf", $str);
    $str = str_ireplace("or", "sqlwaf", $str);
    $str = str_ireplace("from", "sqlwaf", $str);
    $str = str_ireplace("execute", "sqlwaf", $str);
    $str = str_ireplace("update", "sqlwaf", $str);
    $str = str_ireplace("count", "sqlwaf", $str);
    $str = str_ireplace("chr", "sqlwaf", $str);
    $str = str_ireplace("mid", "sqlwaf", $str);
    $str = str_ireplace("char", "sqlwaf", $str);
    $str = str_ireplace("union", "sqlwaf", $str);
    $str = str_ireplace("select", "sqlwaf", $str);
    $str = str_ireplace("delete", "sqlwaf", $str);
    $str = str_ireplace("insert", "sqlwaf", $str);
    $str = str_ireplace("limit", "sqlwaf", $str);
    $str = str_ireplace("concat", "sqlwaf", $str);
    $str = str_ireplace("\\", "\\\\", $str);
    $str = str_ireplace("&&", "", $str);
    $str = str_ireplace("||", "", $str);
    $str = str_ireplace("%", "\%", $str);
    return $str;
}

$SQL_HOST = "localhost";
$SQL_USERNAME = "root";
$SQL_PASSWORD = "root";
$SQL_DB = "ctf";

// 用户的源输入 用来检测empty
$username = $_POST['user'];
$password = $_POST['pass'];

$user = sqlwaf($_POST['user']);
$pass = sqlwaf($_POST['pass']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0"/>
    <title>Title</title>
    <script crossorigin="anonymous"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script crossorigin="anonymous"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script crossorigin="anonymous"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">
    <style type="text/css">
        body {
            min-height: 800px;
        }

        form {
            margin: 90px auto 50px auto;
        }

        .result {
            margin-top: 50px;
        }

        .footer {
            margin-top: 100px;
        }

        .footer > hr {
            background-color: blanchedalmond;
        }


    </style>
</head>
<body>

<div class="fixed-top" style="text-align: center">
    <h1 class="alert alert-info">Easy SQL-WAF</h1>
</div>

<div class="container">
    <form action="" class="form-group form" method="post" style="width: 400px">
        <div class="form-group">
            <label for="user">UserName:</label>
            <input class="form-control" id="user" name="user" type="text">
            <small class="form-text text-muted">We'll Input Your Name</small>
        </div>

        <div class="form-group">
            <label for="pass">Password:</label>
            <input class="form-control" id="pass" name="pass" type="text">
            <small class="form-text text-muted">We'll Input Your Password</small>
        </div>

        <div class="form-group">
            <input class="btn btn-success submit-btn" type="submit" value="登录">
        </div>

    </form>
    <div class="text-danger result" style="text-align: center">
        <?php
        // 创建连接
        $conn = new mysqli($SQL_HOST, $SQL_USERNAME, $SQL_PASSWORD, $SQL_DB);

        // 检测连接
        if ($conn->connect_error) {
            die("数据库连接失败: " . $conn->connect_error);
        }


        // 判断根目录是否存在敏感资源
        if (file_exists("./ctf.sql")) {
            echo "为了安全已经自动删除根目录下的ctf.sql文件了, 请保证网站根目录只有一个index.php文件";
            unlink("./ctf.sql");
        }

        // 判断是否非空
        if (!empty($username) && !empty($password)) {


            $sql = "SELECT name FROM user WHERE name = '$user' and password = '$pass'";
            echo "Your SQL： " . $sql . "</br>";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // 输出数据
                while ($row = $result->fetch_assoc()) {
                    echo "<span class='text-success' style='font-size: 50px;'>Hello " . $row["name"] . "<br></span>";
                }
            } else {
                echo "<span class='text-danger' style='font-size: 50px;'>用户名或密码不正确!<br></span>";
            }
        }
        // 释放资源
        $conn->close();
        ?>
    </div>

    <footer class="footer">
        <hr>
        <span>@2019 Copyright</span>
        <span>Calendula</span>
        <span>HeliantHuS</span>
    </footer>

</div>
</body>
</html>

