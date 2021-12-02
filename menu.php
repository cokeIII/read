<div class="topnav" id="myTopnav">
  <a href="#home" class="active">โครงการส่งเสริมรักการอ่าน</a>
  <?php
  if (!empty($_SESSION["user_status"])) {
    if ($_SESSION["user_status"] == "student") {
  ?>
      <a href="add_log.php">บันทึกการอ่าน</a>
      <a href="list_log.php">รายการที่บันทึก</a>

    <?php } else if ($_SESSION["user_status"] == "admin") { ?>
      <!-- <a href="dashboard.php">Dashboard</a> -->
      <a href="a_list_log.php">รายการที่บันทึก</a>
    <?php } ?>
    <a href="logout.php"> ออกจากระบบ</a>
  <?php } else { ?>
    <a href="index.php">เข้าสู่ระบบ</a>
  <?php } ?>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>