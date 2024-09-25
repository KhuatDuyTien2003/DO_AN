<?php
$conn = mysqli_connect('127.0.0.1:3307', 'root', '', 'schooligniter');
mysqli_set_charset($conn, 'utf8');


?>
<style>
@font-face {
    font-family: newFont;
    /* đặt tên font */
    src: url(/system/fonts/OpenSans-VariableFont_wdth,wght.ttf);
    /* tải font chữ */
}
</style>
<div class="row" style="font-family: newFont;">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo ('Danh sách môn học'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo ('Thêm môn học'); ?>
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
                                <div><?php echo ('Ngày sinh'); ?></div>
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
                   
                        $sql = "SELECT DISTINCT class.name,  subject.subject_name, subject.subject_id, teacher.teacher_name, teacher.email, teacher.birthday FROM `teach` INNER JOIN class on class.class_id=teach.class_id INNER JOIN teacher ON teacher.teacher_id=teach.teacher_id INNER JOIN chuyenmon ON teacher.chuyenmon_id=chuyenmon.chuyenmon_id INNER JOIN subject ON subject.chuyenmon_id=chuyenmon.chuyenmon_id WHERE class.class_id=$class_id and class.level_id = subject.level_id";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            // echo "<pre>";
                            // print_r($row);
                        ?>
                        <tr>
                            <td style="font-family:newFont ;"><?php echo $row['subject_name']; ?>
                            </td>
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
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">

                    <?php echo form_open(base_url() . 'index.php?admin/subject/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ('Tên'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" data-validate="required"
                                    data-message-required="<?php echo ('Value Required'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ('Mã môn học '); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="subject_id" data-validate="required"
                                    data-message-required="<?php echo ('Value Required'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ('Khối'); ?></label>
                            <div class="col-sm-5">
                                <select name="level_id" class="form-control" style="width:100%;">
                                    <?php
                                    $levels = $this->db->get('level')->result_array();
                                    foreach ($levels as $row) :
                                    ?>
                                    <option value="<?php echo $row['level_id']; ?>"><?php echo $row['level']; ?>
                                    </option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ('Chuyên môn'); ?></label>
                            <div class="col-sm-5">
                                <select name="chuyenmon_id" class="form-control" style="width:100%;">
                                    <?php
                                    $teacher = $this->db->get('teacher')->result_array();
                                    $chuyenmon = $this->db->get('chuyenmon')->result_array(); ?>
                                    <?php
                                    // foreach ($teacher as $row) :
                                    foreach ($chuyenmon as $row2) :
                                        // if ($row['chuyenmon_id'] == $row2['chuyenmon_id']) {
                                    ?>
                                    <option value=" <?php echo $row2['chuyenmon_id']; ?>">
                                        <?php  foreach ($teacher as $row) :
                                                    if($row['chuyenmon_id'] == $row2['chuyenmon_id'])
                                                    {
                                                        $teacher_id = $row['teacher_id'];
                                                        $sql = "INSERT INTO teach(class_id , teacher_id)  VALUES('$class_id', '$teacher_id')";
                                                        $kq = mysqli_query($conn, $sql);
                                                    }
                                                ?>

                                        <?php echo $row2['ten_mon']; ?></option>
                                    <?php
                                                // }
                                                endforeach;
                                            endforeach;
                                ?>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo ('Thêm môn học'); ?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
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