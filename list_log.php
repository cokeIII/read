<!DOCTYPE html>
<html lang="en">
<?php
require_once "setHead.php";
require_once "connect.php";
$student_id = $_SESSION["student_id"];
?>
<style>

</style>

<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body p-5">
                <table id="listLog">
                    <thead>
                        <th>ลำดับ</th>
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
            },"POST","_blank");

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
                "url": "get_list_log.php",
                "type": "POST",
                "data": function(d) {
                    d.std = true,
                        d.student_id = "<?php echo $student_id; ?>"
                }
            },
            'processing': true,
            "columns": [{
                    "data": "no"
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
</script>