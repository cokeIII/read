<!DOCTYPE html>
<html lang="en">
<?php require_once "setHead.php"; ?>
<style>
    .logo-login {
        width: 150px;
        height: 150px;
        background-position: center;
        background-size: cover;
        text-align: center;
    }
</style>

<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body p-5">
                <form action="login.php" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <img src="img/login-logo.png" class="logo-login rounded mx-auto d-block">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-md-4">
                            <h4 class="text-center">โครงการส่งเสริมรักการอ่าน</h4>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-md-4">
                            <label><strong>Username</strong></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="รหัสนักศึกษา">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-md-4">
                            <label><strong>Password</strong></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="รหัสผ่าน วัน/เดือน/ปีเกิด">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-4 d-flex">
                            <button type="submit" class="w-100 btn btn-primary rounded mx-auto d-block">login</button>
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