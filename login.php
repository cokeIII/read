<?php
require_once "connect.php";
session_start();
$username = $_POST["username"];
$password = $_POST["password"];
if($username == "admin" && $password == "ctcread"){

} else {
    $sql = "select * from student where student_id = '$username' and birthday='$password' and status = '0'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);
    $_SESSION["student_id"] = $row["student_id"];
    $_SESSION["user_status"] = "student";
    header("location: add_log.php");
}


