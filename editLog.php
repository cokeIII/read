<?php
require_once "connect.php";
session_start();
$student_id = $_POST["student_id"];
$read_id = $_POST["read_id"];
$book_name = $_POST["book_name"];
$read_date = $_POST["read_date"];
$author = $_POST["author"];
$publisher = $_POST["publisher"];
$book_category = $_POST["book_category"];
$page = $_POST["page"];
$essence = $_POST["essence"];
$idea = $_POST["idea"];
$apply = $_POST["apply"];

$target_dir = "uploads/";
$book_cover = date("Ymdhis") . basename($_FILES["book_cover"]["name"]);
echo $target_file = $target_dir . $book_cover;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image{
$check = getimagesize($_FILES["book_cover"]["tmp_name"]);
if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    $sql = "update read_log set
    book_name = '$book_name',
    read_date = '$read_date',
    author = '$author',
    publisher = '$publisher',
    book_category = '$book_category',
    page = '$page',
    essence = '$essence',
    idea = '$idea',
    apply = '$apply'
    where read_id = '$read_id'
    ";
} else {
    if (move_uploaded_file($_FILES["book_cover"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["book_cover"]["name"])) . " has been uploaded.";
        $sql = "update read_log set
        book_name = '$book_name',
        read_date = '$read_date',
        author = '$author',
        publisher = '$publisher',
        book_category = '$book_category',
        page = '$page',
        essence = '$essence',
        idea = '$idea',
        apply = '$apply',
        book_cover = '$book_cover'
        where read_id = '$read_id'
        ";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

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
