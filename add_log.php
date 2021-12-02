<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "setHead.php"; ?>
</head>
<?php
require_once "connect.php";
require_once "checkLogin.php";
$student_id = $_SESSION["student_id"];
$sql = "
select * from student s
inner join student_group sg on s.group_id = sg.student_group_id
where s.student_id = '$student_id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
?>

<body>
    <?php require_once "menu.php"; ?>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <form action="insertLog.php" method="post" enctype="multipart/form-data">
                    <h4 class="text-center">แบบบันทึกโครงการส่งเสริมรักการอ่าน</h4>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label><strong>ชื่อ</strong></label>
                            <input type="text" name="stu_fname" id="stu_fname" class="form-control" value="<?php echo $row["stu_fname"] ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label><strong>นามสกุล</strong></label>
                            <input type="text" name="stu_lname" id="stu_lname" class="form-control" value="<?php echo $row["stu_lname"] ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label><strong>รหัสประจำตัว</strong></label>
                            <input type="text" name="student_id" id="student_id" class="form-control" value="<?php echo $row["student_id"] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label><strong>ระดับชั้น</strong></label>
                            <input type="text" name="grade_name" id="grade_name" class="form-control" value="<?php echo $row["grade_name"] . "/" . (int)$row["student_group_no"] ?>" readonly>
                        </div>
                        <div class="col-md-8">
                            <label><strong>แผนกวิชา</strong></label>
                            <input type="text" name="major_name" id="major_name" class="form-control" value="<?php echo $row["major_name"] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-7">
                            <label><strong>ชื่อหนังสือที่อ่าน</strong></label>
                            <input type="text" name="book_name" id="book_name" class="form-control" required>
                        </div>
                        <div class="col-md-5">
                            <label><strong>เริ่มอ่านวันที่</strong></label>
                            <input type="date" name="read_date" id="read_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label><strong>ชื่อผู้แต่ง</strong></label>
                            <input type="text" name="author" id="author" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>สำนักพิมพ์</strong></label>
                            <input type="text" name="publisher" id="publisher" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <?php
                            $sqlCat = "select * from category";
                            $resCat = mysqli_query($conn, $sqlCat);
                            ?>
                            <label><strong>หมวดหนังสือ</strong></label>
                            <select name="book_category" id="book_category" class="form-control" required>
                                <?php while ($rowCat = mysqli_fetch_array($resCat)) { ?>
                                    <option value="<?php echo $rowCat["id"]; ?>"><?php echo $rowCat["name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label><strong>จำนวนหน้า</strong></label>
                            <input type="number" name="page" id="page" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>สาระสำคัญที่ได้จากการอ่าน</strong></label>
                            <textarea name="essence" id="essence" cols="30" rows="5" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>ข้อคิดที่ได้จากการอ่าน</strong></label>
                            <textarea name="idea" id="idea" cols="30" rows="5" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>การนำไปประยุกต์ใช้ในชีวิตประจำวัน</strong></label>
                            <textarea name="apply" id="apply" cols="30" rows="5" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>ภาพหน้าปกหนังสือที่อ่าน</strong></label>
                            <input type="file" name="book_cover" id="book_cover" class="form-control" required>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success rounded mx-auto d-block">บันทึกรายการ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php require_once "setFoot.php"; ?>