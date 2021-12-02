<?php require_once "connect.php";
session_start();
$read_id = $_POST["read_id"];
$sql = "delete from read_log where read_id = '$read_id'";
$res = mysqli_query($conn, $sql);
if ($res) {
    if (!empty($_SESSION["user_status"])) {
        if ($_SESSION["user_status"] == "admin") {
            header("location: a_list_log.php");
        } else {
            header("location: list_log.php");
        }
    }
} else {
    echo $sql;
}
