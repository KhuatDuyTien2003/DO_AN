<?php
$conn = mysqli_connect('127.0.0.1:3307', 'root', '', 'schooligniter');
mysqli_set_charset($conn, 'utf8');

?>
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo ('Danh sách môn học'); ?>
                </a>
            </li>

        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered table-hover table-striped datatable" id="table_export">
                    <thead>
                        <tr>

                            <th>
                                <div><?php echo ('Tên môn học'); ?></div>
                            </th>
                            <th>
                                <div><?php echo ('Mã môn học'); ?></div>
                            </th>
                            <th>
                                <div><?php echo ('Giáo viên'); ?></div>
                            </th>
                            <th>
                                <div><?php echo ('Ngày Sinh'); ?></div>
                            </th>
                            <th>
                                <div><?php echo ('Email'); ?></div>
                            </th>
                            <th>
                                <div><?php echo ('Lựa chọn'); ?></div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                      
                        $sql = "SELECT DISTINCT class.name, subject.subject_name, subject.subject_id, teacher.teacher_name, teacher.birthday, teacher.email FROM `teach` INNER JOIN class on class.class_id=teach.class_id INNER JOIN teacher ON teacher.teacher_id=teach.teacher_id INNER JOIN chuyenmon ON teacher.chuyenmon_id=chuyenmon.chuyenmon_id INNER JOIN subject ON subject.chuyenmon_id=chuyenmon.chuyenmon_id WHERE class.class_id=$class_id and class.level_id = subject.level_id";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            // echo "<pre>";
                            // print_r($row);
                        ?>
                        <tr>
                            <td><?php echo $row['subject_name']; ?></td>
                            <td><?php echo $row['subject_id']; ?></td>
                            <td><?php echo $row['teacher_name']; ?></td>
                            <td><?php echo $row['birthday']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        Lựa chọn <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        <!-- EDITING LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_subject/<?php echo $row['subject_id']; ?>');">
                                                <i class="entypo-pencil"></i>
                                                <?php echo ('Sửa'); ?>
                                            </a>
                                        </li>
                                        <li class="divider"></li>

                                        <!-- DELETION LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/subject/delete/<?php echo $row['subject_id']; ?>/<?php echo $class_id; ?>');">
                                                <i class="entypo-trash"></i>
                                                <?php echo ('Xóa'); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <?php   }
                            ?>
                        </tr>
                    </tbody>
                </table>

            </div>
            <!----TABLE LISTING ENDS--->

            <!----CREATION FORM STARTS---->

            <!----CREATION FORM ENDS-->



        </div>
    </div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">
jQuery(document).ready(function($) {


    var datatable = $("#table_export").dataTable();

    $(".dataTables_wrapper select").select2({
        minimumResultsForSearch: -1
    });
});
</script>