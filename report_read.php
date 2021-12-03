<?php
// Require composer autoload
date_default_timezone_set("Asia/Bangkok");

require_once 'vendor/autoload.php';
require_once 'vendor/mpdf/mpdf/mpdf.php';
require_once 'connect.php';
error_reporting(error_reporting() & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);

header('Content-Type: text/html; charset=utf-8');
// เพิ่ม Font ให้กับ mPDF
$mpdf = new mPDF();
date_default_timezone_set("asia/bangkok");
function DateThai($strDate)
{
    $exDate = explode("/", $strDate);
    $strDate = ($exDate[2]) . "-" . $exDate[1] . "-" . $exDate[0];
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    // return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
    return "$strDay $strMonthThai $strYear";
}
ob_start(); // Start get HTML code
$read_id = $_POST["read_id"];
$sql = "select *,c.name as c_name from read_log r 
inner join category c on c.id = r.book_category
inner join student s on s.student_id = r.student_id
inner join student_group sg on s.group_id = sg.student_group_id
where read_id = '$read_id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Report 1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/ovec-removebg.ico" />
    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "thsarabun";
            font-size: 21px;
        }

        .text-center {
            text-align: center;
        }

        .dott {
            text-decoration: none;
            border-bottom: 2px dotted black !important;
        }

        .responsive {
            max-height: 160px;
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body class="content">
    <table width="100%">
        <tr>
            <td width="100%"><img src="img/logo_report.png" alt=""></td>
        </tr>
    </table>
    <h3 class="text-center">แบบบันทึกโครงการส่งเสริมรักการอ่าน</h3>

    <table width="100%">
        <tr>
            <td width="5%"><strong>ชื่อ</strong></td>
            <td class="dott text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row["stu_fname"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
            <td width="8%"><strong>นามสกุล</strong></td>
            <td class="dott text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row["stu_lname"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
            <td width="13%"><strong>รหัสประจำตัว</strong></td>
            <td class="dott text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row["student_id"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="9%"><strong>ระดับชั้น</strong></td>
            <td class="dott text-center"><?php echo $row["grade_name"] . "/" . (int)$row["student_group_no"]; ?></td>
            <td width="9%"><strong>แผนกวิชา</strong></td>
            <td class="dott text-center"><?php echo $row["major_name"]; ?></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="15%"><strong>ชื่อหนังสือที่อ่าน</strong></td>
            <td class="dott text-center"><?php echo $row["book_name"]; ?></td>
            <td width="11%"><strong>เริ่มอ่านวันที่</strong></td>
            <td class="dott text-center"><?php echo $row["read_date"]; ?></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="9%"><strong>ชื่อผู้แต่ง</strong></td>
            <td class="dott text-center"><?php echo $row["author"]; ?></td>
            <td width="10%"><strong>สำนักพิมพ์</strong></td>
            <td class="dott text-center"><?php echo $row["publisher"]; ?></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="12%"><strong>หมวดหนังสือ</strong></td>
            <td class="dott text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row["c_name"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
            <td width="11%"><strong>จำนวนหน้า</strong></td>
            <td class="dott text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row["page"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="12%"><strong>สาระสำคัญที่ได้จากการอ่าน</strong></td>
        </tr>
        <tr>
            <td class="dott"><?php echo $row["essence"]; ?></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td><strong>ข้อคิดที่ได้จากการอ่าน</strong></td>
        </tr>
        <tr>
            <td class="dott"><?php echo $row["idea"]; ?></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td><strong>การนำไปประยุกต์ใช้ในชีวิตประจำวัน</strong></td>
        </tr>
        <tr>
            <td class="dott"><?php echo $row["apply"]; ?></td>
        </tr>
    </table>
    <strong>ภาพหน้าปกหนังสือที่อ่าน</strong>
    <br>
    <img src="uploads/<?php echo $row["book_cover"]; ?>" alt="" class="responsive">

</body>

</html>
<?php
$html = ob_get_contents();
// $mpdf->AddPage('L');
$mpdf->WriteHTML($html);
$taget = "pdf/report_read.pdf";
$mpdf->Output($taget);
ob_end_flush();
echo "<script>window.location.href='$taget';</script>";
exit;
?>