<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
$datalist = array();
$group_id = $_POST["group_id"];
if(empty($group_id)){
    $sql = "select * from read_log r
    inner join student s on s.student_id = r.student_id
    inner join student_group sg on s.group_id = sg.student_group_id
    ";
}else{
    $sql = "select * from read_log r
    inner join student s on s.student_id = r.student_id
    inner join student_group sg on s.group_id = sg.student_group_id
    where s.group_id = '$group_id'";
}

$i = 0;
$datalist["data"][$i]["no"] = "ไม่มีข้อมูล";
$datalist["data"][$i]["std_name"] = "";
$datalist["data"][$i]["level"] = "";
$datalist["data"][$i]["book_name"] = "";
$datalist["data"][$i]["read_date"] = "";
$datalist["data"][$i]["print"] ="";
$datalist["data"][$i]["edit"] = "";
$datalist["data"][$i]["del"] = "";

$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $datalist["data"][$i]["no"] = $i + 1;
    $datalist["data"][$i]["std_name"] = $row["stu_fname"]." ".$row["stu_lname"];
    $datalist["data"][$i]["level"] = $row["student_group_short_name"];
    $datalist["data"][$i]["book_name"] = $row["book_name"];
    $datalist["data"][$i]["read_date"] = $row["read_date"];
    $datalist["data"][$i]["print"] = '<button class="btn btn-success printRead" readId="' . $row["read_id"] . '"><i class="fas fa-print"></i></button>';
    $datalist["data"][$i]["edit"] = '<button class="btn btn-warning editRead" readId="' . $row["read_id"] . '"><i class="fas fa-edit"></i></button>';
    $datalist["data"][$i]["del"] = '<button class="btn btn-danger delRead" readId="' . $row["read_id"] . '"><i class="fas fa-trash-alt"></i></button>';
    $i++;
}
echo json_encode($datalist, JSON_UNESCAPED_UNICODE);
