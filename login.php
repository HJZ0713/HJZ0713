<?php
header('Content-Type: text/html; charset=utf-8');
$username1 = $_POST['username'];
$userPwd = $_POST['userPwd'];
//2、
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";
//！！接下来四个变量填写自己的数据库信息：
$conn = new mysqli($servername,$username,$password,$dbname);
//检测连接：
if ($conn->connect_error){
    die("连接失败".$conn->connect_error);
}
//检查数据库：
$sql = "select userPwd from user where username='".$username1."'";
$allSql = "select * from user where username='".$username1."'";
$result = $conn->query($sql);
$allResult = $conn->query($allSql);
if ($username1 == "" or $userPwd == ""){
    echo '<script>alert("账号或密码不能留空");history.go(-1);</script>';
}
else if($result->num_rows > 0){
    $row = $result->fetch_row();
    $db_userpwd = $row[0];
    if($db_userpwd==$userPwd){
        echo '欢迎用户'.$username1.'登录';
    }else{
        echo '<script>alert("账号或密码错误"); history.go(-1);</script>';
    }
}else {
    echo '<script>alert("用户不存在"); history.go(-1);</script>';
}
$conn->close();
?>