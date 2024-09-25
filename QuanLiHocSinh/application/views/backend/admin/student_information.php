<hr />
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/student_add/');"
    class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo ('Thêm học sinh mới'); ?>
</a>
<br>

<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo ('Tất cả học sinh'); ?></span>
                </a>
            </li>
            <?php
            $query = $this->db->get_where('section', array('class_id' => $class_id));
            if ($query->num_rows() > 0) :
                $sections = $query->result_array();
                foreach ($sections as $row) :
            ?>
            <!-- <li>
                <a href="#<?php echo $row['section_id']; ?>" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs"><?php echo ('Section'); ?> <?php echo $row['name']; ?> ( <?php echo $row['nick_name']; ?> )</span>
                </a>
            </li> -->
            <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="home">

                <table class="table table-bordered datatable table-hover table-striped" id="table_export">
                    <thead>
                        <tr>
                            <th width="80">
                                <div><?php echo ('Niên khóa'); ?></div>
                            </th>
                            <th width="80">
                                <div><?php echo ('Ảnh'); ?></div>
                            </th>
                            <th>
                                <div><?php echo ('Họ và Tên'); ?></div>
                            </th>
                            <th class="span3">
                                <div><?php echo ('Địa chỉ'); ?></div>
                            </th>

                            <th>
                                <div><?php echo ('Email'); ?></div>
                            </th>
                            <th>
                                <div><?php echo ('Bố');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Sđt Bố');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Mẹ');?></div>
                            </th>
                            <th>
                                <div><?php echo ('SĐT Mẹ');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Lựa chọn'); ?></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $students   =   $this->db->get_where('student', array('class_id' => $class_id))->result_array();
                        // echo "<pre>";
                        // print_r($students);
                        foreach ($students as $row) : ?>
                        <tr>
                            <td><?php echo $row['nienkhoa']; ?></td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>"
                                    class="img-circle" width="30" /></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['father_name'];?></td>
                            <td><?php echo $row['phone_father'];?></td>
                            <td><?php echo $row['mother_name'];?></td>
                            <td><?php echo $row['phone_mother'];?></td>
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        Hoat động <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        <!-- STUDENT PROFILE LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id']; ?>');">
                                                <i class="entypo-user"></i>
                                                <?php echo ('Trang cá nhân'); ?>
                                            </a>
                                        </li>

                                        <!-- STUDENT EDITING LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_edit/<?php echo $row['student_id']; ?>');">
                                                <i class="entypo-pencil"></i>
                                                <?php echo ('Sửa'); ?>
                                            </a>
                                        </li>
                                        <li class="divider"></li>

                                        <!-- STUDENT DELETION LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/student/<?php echo $class_id; ?>/delete/<?php echo $row['student_id']; ?>');">
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
            <?php
            $query = $this->db->get_where('section', array('class_id' => $class_id));
            if ($query->num_rows() > 0) :
                $sections = $query->result_array();
                foreach ($sections as $row) :
            ?>

            <?php endforeach; ?>
            <?php endif; ?>

        </div>


    </div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">
jQuery(document).ready(function($) {


    var datatable = $("#table_export").dataTable({
        "sPaginationType": "bootstrap",
        "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
        "oTableTools": {
            "aButtons": [

                {
                    "sExtends": "xls",
                    "mColumns": [0, 2, 3, 4]
                },
                {
                    "sExtends": "pdf",
                    "mColumns": [0, 2, 3, 4]
                },
                {
                    "sExtends": "print",
                    "fnSetText": "Press 'esc' to return",
                    "fnClick": function(nButton, oConfig) {
                        datatable.fnSetColumnVis(1, false);
                        datatable.fnSetColumnVis(5, false);

                        this.fnPrint(true, oConfig);

                        window.print();

                        $(window).keyup(function(e) {
                            if (e.which == 27) {
                                datatable.fnSetColumnVis(1, true);
                                datatable.fnSetColumnVis(5, true);
                            }
                        });
                    },

                },
            ]
        },

    });

    $(".dataTables_wrapper select").select2({
        minimumResultsForSearch: -1
    });
});
</script>