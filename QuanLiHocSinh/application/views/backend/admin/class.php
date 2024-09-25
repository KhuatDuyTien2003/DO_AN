<?php
// echo"<pre>";
// print_r($classes);

?>
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo ('Danh sách lớp học'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo ('Thêm lớp học'); ?>
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
                                <div>Niên khóa</div>
                            </th>
                            <th>
                                <div><?php echo ('Tên Lớp'); ?></div>
                            </th>
                            <th>
                                <div><?php echo ('Khối'); ?></div>
                            </th>

                            <th>
                                <div><?php echo ('Giáo viên chủ nhiệm'); ?></div>
                            </th>
                            <th>
                                <div><?php echo ('Chỉnh sửa'); ?></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($classes as $row) : ?>
                        <tr>
                            <td>
                                <?php
                                    $nienkhoa = $this->db->get('nienkhoa')->result_array();
                                    echo $nienkhoa[0]['nienkhoa'];
                                    ?>
                            </td>
                            <td><?php echo $row['name']; ?></td>
                            <td>
                                <?php
                                    $levels = $this->db->get('level')->result_array();
                                    // echo "<pre>";
                                    //     print_r($levels);
                                    foreach ($levels as $level) {
                                        if ($row['level_id'] == $level['level_id']) {
                                            echo $level['level'];
                                        }
                                    }
                                    ?>
                            </td>
                            <td>
                                <?php
                                    $teachers = $this->db->get('teacher')->result_array();
                                    foreach($teachers as $teacher)
                                    {
                                        if($row['teacher_id'] == $teacher['teacher_id'])
                                        {
                                            echo $teacher['teacher_name'];
                                        }
                                    }
                                    ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        Hoạt động <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        <!-- EDITING LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_class/<?php echo $row['class_id']; ?>');">
                                                <i class="entypo-pencil"></i>
                                                <?php echo ('Sửa'); ?>
                                            </a>
                                        </li>
                                        <li class="divider"></li>

                                        <!-- DELETION LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/classes/delete/<?php echo $row['class_id']; ?>');">
                                                <i class="entypo-trash"></i>
                                                <?php echo ('Xóa'); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->

            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?admin/classes/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Niên khóa</label>
                            <div class="col-sm-5">
                                <select name="<?php echo 'nienkhoa_id'; ?>" style="block" class="form-control"
                                    style="float:left;">

                                    <?php
                                    $nienkhoa = $this->db->get('nienkhoa')->result_array();
                                    foreach ($nienkhoa as $i) {
                                    ?>
                                    <option value="<?php echo $i['nienkhoa_id']; ?>"><?php echo $i['nienkhoa'] ?>
                                    </option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ('Tên Khoa '); ?></label>
                            <div class="col-sm-5">
                                <select name="<?php echo 'department_id'; ?>" style="display:block" class="form-control"
                                    style="float:left;">
                                    <?php
                                    $levels = $this->db->get('department')->result_array();
                                    foreach ($levels as $i) {
                                    ?>
                                    <option value="<?php echo $i['department_id'] ?>">
                                        <?php echo $i['department']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ('Tên Khối'); ?></label>
                            <div class="col-sm-5">
                                <select id="department_id" onchange="getDepartment()" name="level_id"
                                    style="display:block" class="form-control" style="float:left;">
                                    <?php
                                       $departments = $this->db->get('level')->result_array();
                                        foreach ($departments as $i) {
                                    ?>
                                    <option value="<?php echo $i['level_id']; ?>"><?php echo $i['level']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ('Tên lớp'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" value="" class="form-control" id="class_name" name="name" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ('Giáo viên chủ nhiệm'); ?></label>
                            <div class="col-sm-5">
                                <select name="teacher_id" class="form-control" style="width:100%;">
                                    <?php
                                    $teachers = $this->db->get('teacher')->result_array();
                                    foreach ($teachers as $row) :
                                    ?>
                                    <option value="<?php echo $row['teacher_id']; ?>">
                                        <?php echo $row['teacher_name']; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo ('Thêm lớp'); ?></button>
                        </div>
                    </div>

                </div>
            </div>


            <!----CREATION FORM ENDS-->
        </div>
    </div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">
function setClass(level_id) {
    document.getElementById(`class_id1`).value = level_id;
    for (let i = 0; i < 100; i++) {
        if (i == level_id) {
            document.getElementById(`class_id ${i}`).style.display = 'block';
            document.getElementById(`class_id ${i}`).setAttribute('name', 'class_id');
        } else {
            document.getElementById(`class_id ${i}`).style.display = none;
            //document.getElementById(`class_id ${i}`).setAttribute('name', 'class_id');
        }
    }
}

function getDepartment() {
    var department_id = document.getElementById('department_id').value;

    $.ajax({
        url: '<?php echo base_url(); ?>index.php?admin/classes/get_class_name',
        type: 'POST',
        data: {
            department_id: department_id
        },
        dataType: 'json',
        success: function(response) {
            document.getElementById('class_name').value = response.class_name
            //$('#class_name').val(response.class_name);
        }
    });
}


jQuery(document).ready(function($) {


    var datatable = $("#table_export").dataTable();

    $(".dataTables_wrapper select").select2({
        minimumResultsForSearch: -1
    });
});
</script>