<?php
header('Content-Type: text/html; charset=utf-8');
$username1 = $_POST['username'];
$userPwd1 = $_POST['userPwd'];
$reuserPwd1 = $_POST['reuserPwd'];
$code1 = $_POST['code'];
//！！接下来四个变量填写自己的数据库信息：
    $servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "test";
//连接数据库：
	$conn = new mysqli($servername, $username, $password, $dbname);
//检测连接：
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$searchName = "select * from user where username='$username1'";
$searchNameResult = $conn->query($searchName);
$row = $searchNameResult->fetch_row();
$sql="insert into user values(null,'".$username1."','".$userPwd1."','".$code1."')";
if ($username1 == "" or $userPwd1 == ""){
    echo '<script>alert("账号或密码不能留空");history.go(-1);</script>';
}
else if ($userPwd1 != $reuserPwd1){
    echo '<script>alert("两次输入的密码不一致");history.go(-1);</script>';
}
else if ($row > 0){
    echo '<script>alert("已有人使用该账户名，请更换一个名字");history.go(-1);</script>';
}
else if ($conn->query($sql) === TRUE) {
    echo '<script>alert("用户注册成功");</script>';
    header("Refresh:0;url=index.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>