<?php
$classes    =    $this->crud_model->get_classes();
$conn = new mysqli("127.0.0.1:3307", "root", "", "schooligniter");
mysqli_set_charset($conn, "utf8");


?>

<style>
.content_table {
    border: 1px solid rgb(207, 218, 228);
    border-radius: 5px;
    width: 95%;
    margin-left: 2.5%;
    margin-bottom: 10px;
    background-color: white;
    padding-left: 10%;
    color: black;
    padding-left: 0;
}

.content_table>h3 {
    font-size: 130%;


}

.btn-group {
    width: 100%;
}

.btn {
    padding: 0;
    width: 100%;
}
</style>
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo ('Thời khóa biểu'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo ('Thêm lịch'); ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>


        <div class="tab-content">
            <!----TABLE LISTING STARTS-->


            <div class="tab-pane active" id="list">
                <div class="panel-group joined" id="accordion-test-2">
                    <?php
                        $toggle = true;
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row) :
                        ?>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-test-2"
                                    href="#collapse<?php echo $row['class_id']; ?>">
                                    <i class="entypo-rss"></i> Lớp <?php echo $row['name']; ?>
                                </a>
                            </h4>
                        </div>

                        <div id="collapse<?php echo $row['class_id']; ?>" class="panel-collapse collapse <?php if ($toggle) {
                               echo 'in';
                            $toggle = false;
                            } ?>">
                            <div class="panel-body">
                                <table cellpadding="0" cellspacing="0" border="0"
                                    class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <td style=" color: black;font-weight: bold; text-align:center;">

                                            </td>
                                            <td
                                                style="background-color:#d8f2ff;color: #35B3F4;font-size: 17px;font-weight: bold; text-align:center;">
                                                Thứ Hai
                                            </td>
                                            <td
                                                style="background-color:#d8f2ff;color: #35B3F4;font-size: 17px;font-weight: bold; text-align:center;">
                                                Thứ Ba
                                            </td>
                                            <td
                                                style="background-color:#d8f2ff;color: #35B3F4;font-size: 17px;font-weight: bold; text-align:center;">
                                                Thứ Tư
                                            </td>
                                            <td
                                                style="background-color:#d8f2ff;color: #35B3F4;font-size: 17px;font-weight: bold; text-align:center;">
                                                Thứ Năm
                                            </td>
                                            <td
                                                style="background-color:#d8f2ff;color: #35B3F4;font-size: 17px;font-weight: bold; text-align:center;">
                                                Thứ Sáu
                                            </td>
                                            <td
                                                style="background-color:#d8f2ff;color: #35B3F4;font-size: 17px;font-weight: bold; text-align:center;">
                                                Thứ Bảy
                                            </td>
                                            <td
                                                style="background-color:#d8f2ff;color: #35B3F4;font-size: 17px;font-weight: bold; text-align:center;">
                                                Chủ Nhật
                                            </td>
                                        </tr>
                                    </thead>


                                    <tbody style="background-color: white;">
                                        <tr style="background-color: white;">
                                            <td style="color: black; font-weight: bold;background-color: #FFFFCE">Buổi
                                                Sáng</td><?php ?>
                                            <?php 
                                            for($day = 1; $day < 7; $day++):
                                                ?>
                                            <td>
                                                <?php
                                                $class_id = $row['class_id'];
                                                $sql = "SELECT DISTINCT class.class_id, class.name, subject.subject_id,subject.subject_name, teacher.teacher_name FROM `teach` INNER JOIN class on class.class_id=teach.class_id INNER JOIN teacher ON teacher.teacher_id=teach.teacher_id INNER JOIN chuyenmon ON teacher.chuyenmon_id=chuyenmon.chuyenmon_id INNER JOIN subject ON subject.chuyenmon_id=chuyenmon.chuyenmon_id WHERE class.class_id = $class_id and class.level_id = subject.level_id";
                                                $result = mysqli_query($conn, $sql);
                                                $class_routine = $this->db ->where('class_id',$row['class_id'])->get('class_routine') ->result_array();                                          
                                                   foreach($class_routine as $row2){
           
                                                        if($row2['time_start'] >= 1 && $row2['time_start'] <= 6 && $row2['day'] == $day):   
                                                            foreach($result as $row1){                 
                                                                if($row1['subject_id'] == $row2['subject_id']){         
                                                 ?>
                                                <div class="content_table">
                                                    <div class="btn-group">
                                                        <button class="btn  dropdown-toggle" data-toggle="dropdown">
                                                            <h3> <?php echo $row1['subject_name'] ?></h3>
                                                            <p>Tiết
                                                                :<?php echo $row2['time_start']. "-" .$row2['time_end']?>
                                                            </p>
                                                            <p>Giáo viên: <?php echo $row1['teacher_name']?> </p>
                                                            <p>Lớp: <?php echo $row1['name']?> </p>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="#"
                                                                    onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_class_routine/<?php echo $row2['class_routine_id'];?>');">
                                                                    <i class="entypo-pencil"></i>
                                                                    <?php echo ('Sửa');?>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#"
                                                                    onclick="confirm_modal('<?php echo base_url();?>index.php?admin/class_routine/delete/<?php echo $row2['class_routine_id'];?>');">
                                                                    <i class="entypo-trash"></i>
                                                                    <?php echo ('Xóa');?>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>

                                                <?php
                                                }
                                                  }
                                                endif;
                                                }
                                          ?>
                                            </td>
                                            <?php
                                                endfor;
                                            ?>
                                            <td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: black; font-weight: bold;background-color: #FFFFCE">Buổi
                                                Chiều</td>
                                            <?php 
                                            for($day = 1; $day < 7; $day++):
                                                ?>
                                            <td>
                                                <?php
                                                $class_id = $row['class_id'];
                                                $sql = "SELECT DISTINCT class.class_id, class.name, subject.subject_id,subject.subject_name, teacher.teacher_name FROM `teach` INNER JOIN class on class.class_id=teach.class_id INNER JOIN teacher ON teacher.teacher_id=teach.teacher_id INNER JOIN chuyenmon ON teacher.chuyenmon_id=chuyenmon.chuyenmon_id INNER JOIN subject ON subject.chuyenmon_id=chuyenmon.chuyenmon_id WHERE class.class_id = $class_id and class.level_id = subject.level_id";
                                                $result = mysqli_query($conn, $sql);
                                                $class_routine = $this->db ->where('class_id',$row['class_id'])->get('class_routine') ->result_array();                                          
                                                   foreach($class_routine as $row2){
           
                                                        if($row2['time_start'] >= 7 && $row2['time_start'] <= 12 && $row2['day'] == $day):   
                                                            foreach($result as $row1){                 
                                                                if($row1['subject_id'] == $row2['subject_id']){         
                                                 ?>
                                                <div class="content_table">
                                                    <div class="btn-group">
                                                        <button class="btn  dropdown-toggle" data-toggle="dropdown">
                                                            <h3> <?php echo $row1['subject_name'] ?></h3>
                                                            <p>Tiết
                                                                :<?php echo $row2['time_start']. "-" .$row2['time_end']?>
                                                            </p>
                                                            <p>Giáo viên: <?php echo $row1['teacher_name']?> </p>
                                                            <p>Lớp: <?php echo $row1['name']?> </p>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="#"
                                                                    onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_class_routine/<?php echo $row2['class_routine_id'];?>');">
                                                                    <i class="entypo-pencil"></i>
                                                                    <?php echo ('Sửa');?>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#"
                                                                    onclick="confirm_modal('<?php echo base_url();?>index.php?admin/class_routine/delete/<?php echo $row2['class_routine_id'];?>');">
                                                                    <i class="entypo-trash"></i>
                                                                    <?php echo ('Xóa');?>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>

                                                <?php
                                                }
                                                  }
                                                endif;
                                                }
                                          ?>
                                            </td>
                                            <?php
                                                endfor;
                                            ?>
                                            <td>
                                            </td>
                                        </tr>
                                        <?php
                                           
                                        ?>
                                    </tbody>
                                </table>
                             

                            </div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                        ?>
                </div>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?admin/class_routine/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Khối'); ?></label>
                        <div class="col-sm-5">
                            <select name="department_id" class="form-control" onchange="show_classes(this.value)"
                                style="float:left;">
                                <option value=""><?php echo ('Chọn khoa'); ?></option>
                                <?php
                                    $departments = $this->db->get('department')->result_array();
                                    foreach ($departments as $row) :
                                    ?>
                                <option value="<?php echo $row['department_id']; ?>"
                                    <?php if ($department_id == $row['department_id']) echo 'selected'; ?>>
                                    Lớp <?php echo $row['department']; ?></option>
                                <?php
                                    endforeach;
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Lớp'); ?></label>
                        <div class="col-sm-5">
                            <!-- <select name="class_id" class="form-control" style="width:100%;" onchange="return get_class_subject(this.value)">
                                <option value=""><?php echo ('Chọn Lớp'); ?></option>
                                <?php
                                $classes = $this->db->get('class')->result_array();
                                foreach ($classes as $row) :
                                ?>
                                    <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select> -->

                            <!-- ================================= -->
                            <?php
                                $departments    =    $this->crud_model->get_departments();
                                foreach ($departments as $row) :
                                ?>
                            <select onchange="show_subjects(this.value)" name="<?php if ($department_id == $row['department_id']) echo 'class_id';
                                                                                        else echo 'temp'; ?>"
                                id="class_id_<?php echo $row['department_id']; ?>"
                                style="display:<?php if ($department_id == $row['department_id']) echo 'block';
                                                                                                                                                                            else echo 'none'; ?>;"
                                class="form-control" style="float:left;">
                                <option value="">Khối <?php echo $row['department']; ?></option>
                                <?php
                                        $classes    =    $this->crud_model->get_classes_by_department($row['department_id']);
                                        // echo "<pre>";
                                        // print_r($classes);
                                        foreach ($classes as $row2) : ?>
                                <option value="<?php echo $row2['class_id']; ?>"
                                    <?php if (isset($class_id) && $class_id == $row2['class_id'])
                                                                                                    echo 'selected="selected"'; ?>><?php echo $row2['name']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <?php endforeach; ?>
                            <select name="temp" id="class_id_0" style="display:<?php if (isset($class_id) && $class_id > 0) echo 'none';
                                                                                    else echo 'block'; ?>;"
                                class="form-control" style="float:left;">
                                <option value="">Chọn khối</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Môn học'); ?></label>
                        <div class="col-sm-5">
                            <?php
                                $classes    =    $this->crud_model->get_classes();
                                foreach ($classes as $row) : ?>

                            <select name="<?php if ($class_id == $row['class_id']) echo 'subject_id';
                                                    else echo 'temp'; ?>"
                                id="subject_id_<?php echo $row['class_id']; ?>"
                                style="display:<?php if ($class_id == $row['class_id']) echo 'block';
                                                                                                                                        else echo 'none'; ?>;"
                                class="form-control" style="float:left;">
                                <option value="">Môn học của lớp <?php echo $row['name']; ?></option>
                                <?php
                                        $subjects    =    $this->crud_model->get_subjects_by_level($row['level_id']);
                                        foreach ($subjects as $row2) : ?>
                                <option value="<?php echo $row2['subject_id']; ?>"
                                    <?php if (isset($subject_id) && $subject_id == $row2['subject_id'])
                                                                                                    echo 'selected="selected"'; ?>>
                                    <?php echo $row2['subject_name']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <?php endforeach; ?>
                            <select name="temp" id="subject_id_0" style="display:<?php if (isset($subject_id) && $subject_id > 0) echo 'none';
                                                                                        else echo 'block'; ?>;"
                                class="form-control" style="float:left;">
                                <option value="">Chọn môn của lớp</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Ngày'); ?></label>
                        <div class="col-sm-5">
                            <select name="day" class="form-control" style="width:100%;">
                                <option value="8">Chủ Nhật</option>
                                <option value="2">Thứ Hai</option>
                                <option value="3">Thứ Ba</option>
                                <option value="4">Thứ Tư</option>
                                <option value="5">Thứ Năm</option>
                                <option value="6">Thứ Sáu</option>
                                <option value="7">Thứ Bảy</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Thời gian bắt đầu'); ?></label>
                        <div class="col-sm-5">
                            <select name="time_start" class="form-control" style="width:100%;">
                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                <option value="<?php echo $i; ?>"><?php echo "Tiết " . $i; ?></option>
                                <?php endfor; ?>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Thời gian kết thúc'); ?></label>
                        <div class="col-sm-5">
                            <select name="time_end" class="form-control" style="width:100%;">
                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                <option value="<?php echo $i; ?>"><?php echo "Tiết " . $i;; ?></option>
                                <?php endfor; ?>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo ('Thêm lịch học'); ?></button>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
            <!----CREATION FORM ENDS-->

        </div>
    </div>
</div>

<script type="text/javascript">
function get_class_subject(class_id) {
    $.ajax({
        url: '<?php echo base_url(); ?>index.php?admin/get_class_subject/' + class_id,
        success: function(response) {
            jQuery('#subject_selection_holder').html(response);
        }
    });
}

function show_classes(department_id) {
    for (i = 0; i <= 100; i++) {

        try {
            document.getElementById('class_id_' + i).style.display = 'none';
            document.getElementById('class_id_' + i).setAttribute("name", "temp");
        } catch (err) {}
    }
    document.getElementById('class_id_' + department_id).style.display = 'block';
    document.getElementById('class_id_' + department_id).setAttribute("name", "class_id");
}

function show_subjects(class_id) {
    for (i = 0; i <= 100; i++) {

        try {
            document.getElementById('subject_id_' + i).style.display = 'none';
            document.getElementById('subject_id_' + i).setAttribute("name", "temp");
        } catch (err) {}
    }
    document.getElementById('subject_id_' + class_id).style.display = 'block';
    document.getElementById('subject_id_' + class_id).setAttribute("name", "subject_id");
}
</script>