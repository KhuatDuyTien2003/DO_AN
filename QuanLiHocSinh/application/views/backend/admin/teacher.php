<?php
// $teach    =    $this->db->get('teach')->result_array();
// $sub_name    =    $this->db->get('subject')->result_array();
// // echo "<pre>";
// // print_r($sub_name);


// // echo "<pre>";
// // print_r($teach);
// foreach ($teach as $i) {
//     echo "<pre>";
//     print_r($i);
//     $sub_name    =    $this->db->get('subject')->result_array();
//     foreach ($sub_name as $j) {
//         if ($i['subject_id'] == $j['subject_id']) {
//             echo $j['name'];
//         }
//     }
// }

// $subjects    =    $this->db->get('subject')->result_array();
// echo "<pre>";
// print_r($subjects);

?>

<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_teacher_add/');"
    class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('Thêm giáo viên'); ?>
</a>
<br><br>
<table class="table table-bordered table-hover table-striped datatable" id="table_export">
    <thead>
        <tr>
            <th width="80">
                <div><?php echo ('Ảnh'); ?></div>
            </th>
            <th>
                <div><?php echo ('Học và Tên'); ?></div>
            </th>
            <th>
                <div><?php echo ('Ngày sinh'); ?></div>
            </th>
            <th>
                <div><?php echo ('Email'); ?></div>
            </th>
            <th>
                <div><?php echo ('SĐT'); ?></div>
            </th>
            <th>
                <div><?php echo ('Môn dạy'); ?></div>
            </th>
            <th>
                <div><?php echo ('Lớp chủ nhiệm'); ?></div>
            </th>
            <th>
                <div><?php echo ('Lựa chọn'); ?></div>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $teachers    =    $this->db->get('teacher')->result_array();
        // echo "<pre>";
        // print_r($teachers);
        foreach ($teachers as $row) : ?>
        <tr>
            <td><img src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']); ?>"
                    class="img-circle" width="30" /></td>
            <td><?php echo $row['teacher_name']; ?></td>
            <td><?php echo $row['birthday']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td>
                <?php
                    $chuyenmon    =    $this->db->get('chuyenmon')->result_array();
                    foreach ($chuyenmon as $i) {
                        if ($row['chuyenmon_id'] == $i['chuyenmon_id']) {
                            echo $i['ten_mon'] . "  ";
                        }
                    }
                    ?>
            </td>
            <td>
                <?php
                    $class    =    $this->db->get('class')->result_array();
                    foreach ($class as $i) {
                        if ($row['teacher_id'] == $i['teacher_id']) {
                            echo $i['name'] . "  ";
                            break;
                        }
                    }
                    ?>
            </td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                        Hoạt động <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                        <!-- teacher EDITING LINK -->
                        <li>
                            <a href="#"
                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_teacher_edit/<?php echo $row['teacher_id']; ?>');">
                                <i class="entypo-pencil"></i>
                                <?php echo ('Sửa'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>

                        <!-- teacher DELETION LINK -->
                        <li>
                            <a href="#"
                                onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/teacher/delete/<?php echo $row['teacher_id']; ?>');">
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
                    "mColumns": [1, 2]
                },
                {
                    "sExtends": "pdf",
                    "mColumns": [1, 2]
                },
                {
                    "sExtends": "print",
                    "fnSetText": "Press 'esc' to return",
                    "fnClick": function(nButton, oConfig) {
                        datatable.fnSetColumnVis(0, false);
                        datatable.fnSetColumnVis(3, false);

                        this.fnPrint(true, oConfig);

                        window.print();

                        $(window).keyup(function(e) {
                            if (e.which == 27) {
                                datatable.fnSetColumnVis(0, true);
                                datatable.fnSetColumnVis(3, true);
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