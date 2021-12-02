<!DOCTYPE html>
<html lang="en">
<?php
require_once "setHead.php";
require_once "connect.php";
require_once "checkLogin.php";
$read_id = $_POST["read_id"];
$sql = "select * from read_log r 
inner join student s on s.student_id = r.student_id
inner join student_group sg on s.group_id = sg.student_group_id
where read_id = '$read_id'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($res);
?>
<style>

</style>

<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body p-5">
                <form action="editLog.php" method="post" enctype="multipart/form-data">
                    <h4 class="text-center">แบบบันทึกโครงการส่งเสริมรักการอ่าน</h4>
                    <hr>
                    <input type="hidden" name="read_id" value="<?php echo $read_id; ?>">
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
                            <input type="text" name="book_name" id="book_name" class="form-control" value="<?php echo $row["book_name"] ?>" required>
                        </div>
                        <div class="col-md-5">
                            <label><strong>เริ่มอ่านวันที่</strong></label>
                            <input type="date" name="read_date" id="read_date" class="form-control" value="<?php echo $row["read_date"] ?>" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label><strong>ชื่อผู้แต่ง</strong></label>
                            <input type="text" name="author" id="author" class="form-control" value="<?php echo $row["author"] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>สำนักพิมพ์</strong></label>
                            <input type="text" name="publisher" id="publisher" class="form-control" value="<?php echo $row["publisher"] ?>" required>
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
                                    <option value="<?php echo $rowCat["id"]; ?>" <?php echo ($row["book_category"] == $rowCat["id"]?"selected":"")?>><?php echo $rowCat["name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label><strong>จำนวนหน้า</strong></label>
                            <input type="number" name="page" id="page" class="form-control" value="<?php echo $row["page"] ?>" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>สาระสำคัญที่ได้จากการอ่าน</strong></label>
                            <textarea name="essence" id="essence" cols="30" rows="5" class="form-control" required><?php echo $row["essence"] ?></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>ข้อคิดที่ได้จากการอ่าน</strong></label>
                            <textarea name="idea" id="idea" cols="30" rows="5" class="form-control" required><?php echo $row["idea"] ?></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>การนำไปประยุกต์ใช้ในชีวิตประจำวัน</strong></label>
                            <textarea name="apply" id="apply" cols="30" rows="5" class="form-control" required><?php echo $row["apply"] ?></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>ภาพหน้าปกหนังสือที่อ่าน</strong></label>
                            <input type="file" name="book_cover" id="book_cover" class="form-control">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-warning rounded mx-auto d-block">แก้ไขรายการ</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
<?php require_once "setFoot.php"; ?>

</html>
<script>
    $(document).ready(function() {

    })
</script>