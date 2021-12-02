<?php
require_once "connect.php";
session_start();
$username = $_POST["username"];
$password = $_POST["password"];
if ($username == "admin" && $password == "ctcread") {
    $_SESSION["user_status"] = "admin";
    header("location: a_list_log.php");
} else {
    $sql = "select * from student where student_id = '$username' and birthday='$password' and status = '0'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    $numRow = mysqli_num_rows($res);
    if ($numRow > 0) {
        $_SESSION["student_id"] = $row["student_id"];
        $_SESSION["user_status"] = "student";
        header("location: add_log.php");
    } else {
        header("location: errPage.php?textErr=ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง กรุณาเข้าสู่ระบบใหม่อีกครั้ง <a href='index.php'>เข้าสู่ระบบ<a/>");
    }
}
