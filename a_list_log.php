<!DOCTYPE html>
<html lang="en">
<?php
require_once "setHead.php";
require_once "connect.php";
require_once "checkLoginAdmin.php";
?>
<style>

</style>

<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-3 pt-2">
                                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">view_list</i>
                                </div>
                                <?php
                                $sqlSum = "select count(read_id) as countRead from read_log";
                                $resSum = mysqli_query($conn, $sqlSum);
                                $rowSum = mysqli_fetch_array($resSum);
                                ?>
                                <div class="text-end pt-1">
                                    <p class="text-md mb-0 text-capitalize">รายการทั้งหมด.</p>
                                    <h4 class="mb-0"><?php echo $rowSum["countRead"]; ?></h4>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $rank = [];
                    // $sqlRank = "select student_group_short_name,count(read_id) as countRead from read_log r
                    // inner join student s on s.student_id = r.student_id
                    // inner join student_group sg on s.group_id = sg.student_group_id
                    // group by s.group_id limit 3";
                    $resRank = mysqli_query($conn, $sqlRank);
                    while ($rowRank = mysqli_fetch_array($resRank)) {
                        array_push($rank, ["group" => $rowRank["student_group_short_name"], "list" => $rowRank["countRead"]]);
                    }
                    $list = array_column($rank, 'list');
                    array_multisort($list, SORT_DESC, $rank);
                    ?>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-3 pt-2">
                                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">looks_one</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-md mb-0 text-capitalize">รายการรวม อันดับ 1</p>
                                    <h4 class="mb-0"><?php echo (count($rank) > 0?$rank[0]["list"]:"0")?></h4>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span><?php echo (count($rank) > 0?$rank[0]["group"]:"ไม่มีรายการ")?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-3 pt-2">
                                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">looks_two</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-md mb-0 text-capitalize">รายการรวม อันดับ 2</p>
                                    <h4 class="mb-0"><?php echo (count($rank) > 1?$rank[1]["list"]:"0")?></h4>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"></span><?php echo (count($rank) > 1?$rank[1]["group"]:"ไม่มีรายการ")?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-header p-3 pt-2">
                                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">looks_3</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-md mb-0 text-capitalize">รายการรวม อันดับ 3</p>
                                    <h4 class="mb-0"><?php echo (count($rank) > 2?$rank[2]["list"]:"0")?></h4>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span><?php echo (count($rank) > 2?$rank[2]["group"]:"ไม่มีรายการ")?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb-5 mt-5">
                    <div class="col-md-3">
                        <select id="group_select" class="form-control">
                            <option value="">เลือกทั้งหมด</option>
                            <?php $sqlG = "select * from student_group where student_group_year >= ((select max(student_group_year) from student_group)-3)";
                            $resG = mysqli_query($conn, $sqlG);
                            while ($rowG = mysqli_fetch_array($resG)) {
                            ?>
                                <option value="<?php echo $rowG["student_group_id"]; ?>"><?php echo $rowG["student_group_short_name"] . "(" . $rowG["student_group_id"] . ")"; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <table id="listLog" class="table responsive display">
                    <thead>
                        <th>ลำดับ</th>
                        <th>
                            ชื่อ - สกุล
                        </th>
                        <th>
                            ระดับชั้น
                        </th>
                        <th>ชื่อหนังสือที่อ่าน</th>
                        <th>เริ่มอ่านวันที่</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?php require_once "setFoot.php"; ?>

</html>
<script>
    $(document).ready(function() {
        $("#group_select").select2()
        $(document).on('change', '#group_select', function() {
            $("#listLog").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "bDestroy": true,
                "responsive": true,
                "autoWidth": false,
                "pageLength": 30,
                "ajax": {
                    "url": "a_get_list_log.php",
                    "type": "POST",
                    "data": function(d) {
                        d.std = true,
                            d.group_id = $("#group_select").val()
                    }
                },
                'processing': true,
                "columns": [{
                        "data": "no"
                    },
                    {
                        "data": "std_name"
                    },
                    {
                        "data": "level"
                    },
                    {
                        "data": "book_name"
                    },
                    {
                        "data": "read_date"
                    },
                    {
                        "data": "print"
                    },
                    {
                        "data": "edit"
                    },
                    {
                        "data": "del"
                    }
                ],
                "language": {
                    'processing': '<img src="img/tenor.gif" width="80">',
                    "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
                    "zeroRecords": "ไม่มีข้อมูล",
                    "info": "กำลังแสดงข้อมูล _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    "search": "ค้นหา:",
                    "infoEmpty": "ไม่มีข้อมูลแสดง",
                    "infoFiltered": "(ค้นหาจาก _MAX_ total records)",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "หน้าต่อไป",
                        "previous": "หน้าก่อน"
                    }
                },
                responsive: true
            });

        })
        $(document).on('click', '.editRead', function() {
            let read_id = $(this).attr("readId")
            $.redirect("form_edit_log.php", {
                read_id: read_id
            });
        })
        $(document).on('click', '.delRead', function() {
            let read_id = $(this).attr("readId")
            if (confirm("ต้องการลบรายการใช่หรือไม่ ?")) {
                $.redirect("delLog.php", {
                    read_id: read_id
                });
            }
        })
        $(document).on('click', '.printRead', function() {
            let read_id = $(this).attr("readId")

            $.redirect("report_read.php", {
                read_id: read_id
            }, "POST", "_blank");

        })

        $("#listLog").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "bDestroy": true,
            "responsive": true,
            "autoWidth": false,
            "pageLength": 30,
            "ajax": {
                "url": "a_get_list_log.php",
                "type": "POST",
                "data": function(d) {
                    d.std = true,
                        d.group_id = ""
                }
            },
            'processing': true,
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "std_name"
                },
                {
                    "data": "level"
                },
                {
                    "data": "book_name"
                },
                {
                    "data": "read_date"
                },
                {
                    "data": "print"
                },
                {
                    "data": "edit"
                },
                {
                    "data": "del"
                }
            ],
            "language": {
                'processing': '<img src="img/tenor.gif" width="80">',
                "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
                "zeroRecords": "ไม่มีข้อมูล",
                "info": "กำลังแสดงข้อมูล _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "search": "ค้นหา:",
                "infoEmpty": "ไม่มีข้อมูลแสดง",
                "infoFiltered": "(ค้นหาจาก _MAX_ total records)",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "หน้าต่อไป",
                    "previous": "หน้าก่อน"
                }
            },
            responsive: true,
            "scrollX": true
        });

    })
</script>
<?php

?>