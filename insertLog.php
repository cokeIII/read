<?php
require_once "connect.php";

$student_id = $_POST["student_id"];
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
} else {
    if (move_uploaded_file($_FILES["book_cover"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["book_cover"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
if ($uploadOk) {
    $sql = "insert into read_log (
        student_id,
        book_name,
        read_date,
        author,
        publisher,
        book_category,
        page,
        essence,
        idea,
        apply,
        book_cover
        ) value(
            '$student_id',
            '$book_name',
            '$read_date',
            '$author',
            '$publisher',
            '$book_category',
            '$page',
            '$essence',
            '$idea',
            '$apply',
            '$book_cover'
        )";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        header("location: list_log.php");
    } else {
        echo $sql;
    }
}
