<div class="topnav" id="myTopnav">
  <a href="#home" class="active">หน้าแรก</a>
  <?php if (!empty($_SESSION["user_status"])) { ?>
    <a href="#news">บันทึกการอ่าน</a>
    <a href="#contact">รายการที่บันทึก</a>
    <a href="logout.php"> ออกจากระบบ</a>
  <?php } else { ?>
    <a href="index.php">เข้าสู่ระบบ</a>
  <?php } ?>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>