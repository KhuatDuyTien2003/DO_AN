<?php
$conn = mysqli_connect('127.0.0.1:3307', 'root', '', 'schooligniter');


$level = $this->crud_model->get_levels_by_department(1);

$sql = "SELECT DISTINCT `student_id`,`class_id`,exam_id, `dtk` FROM `grade` WHERE class_id = 1 and exam_id=1";
$kq = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($kq)) {
    // echo "<pre>";
    // print_r($row);
}
?>

<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo ('Quản lí điểm'); ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>


        <!----TABLE LISTING STARTS-->
        <div class="tab-pane  <?php if (!isset($edit_data) && !isset($personal_profile) && !isset($academic_result)) echo 'active'; ?>"
            id="list">
            <center>
                <!-- <?php echo form_open(base_url() . 'index.php?admin/marks'); ?> -->
                <form method="post" action="<?php echo base_url() ?>index.php?admin/marks/ ">

                    <table border="0" cellspacing="0" cellpadding="0"
                        class="table table-bordered table-hover table-striped">
                        <tr>
                            <td><?php echo ('Chọn bài kiểm tra'); ?></td>
                            <td><?php echo ('Chọn khối'); ?></td>
                            <td><?php echo ('Chọn lớp'); ?></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="exam_id" class="form-control" style="float:left;">
                                    <option value=""><?php echo ('Chọn 1 bài kiểm tra'); ?></option>
                                    <?php
                                    $exams = $this->db->get('exam')->result_array();
                                    foreach ($exams as $row) :
                                    ?>

                                    <option value="<?php echo $row['exam_id']; ?>"
                                        <?php if ($exam_id == $row['exam_id']) echo 'selected'; ?>>
                                        <?php echo $row['name']; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </td>
                            <td>
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
                            </td>
                            <td>
                                <!----- SELECT CLASS ACCORDING TO SELECTED DEPARTMENT -------->
                                <?php
                                $departments    =    $this->crud_model->get_departments();
                                foreach ($departments as $row) :
                                ?>
                                <select name="<?php if ($department_id == $row['department_id']) echo 'class_id';
                                                    else echo 'temp'; ?>"
                                    id="class_id_<?php echo $row['department_id']; ?>"
                                    style="display:<?php if ($department_id == $row['department_id']) echo 'block';
                                                                                                                                            else echo 'none'; ?>;"
                                    class="form-control" style="float:left;">
                                    <option value="">Lớp <?php echo $row['department']; ?></option>
                                    <?php
                                        $classes    =    $this->crud_model->get_classes_by_department($row['department_id']);

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
                                    <option value="">Chọn lớp</option>
                                </select>
                            </td>
                            <td>
                                <input type="hidden" name="operation" value="Selection" />
                                <input type="submit" value="<?php echo ('Tìm kiếm'); ?>" class="btn btn-info" />

                            </td>
                        </tr>
                    </table>
                </form>
            </center>


            <br /><br />

            <?php
            if ($exam_id < 3) { ?>

            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <?php
                        $level = $this->crud_model->get_levels_by_department(1);
                        // echo "<pre>";
                        // print_r($level);

                        foreach ($level as $i) {
                            if ($i['class_id'] == $class_id) {
                                // echo $i['level_id'];
                                if ($i['level_id'] == 3 || $i['level_id'] == 4) { ?>
                    <tr style="text-align:center;">
                        <td rowspan="2"><?php echo ('Học sinh'); ?></td>
                        <td colspan="12"><?php echo ('Môn'); ?></td>
                        <td rowspan="2">DTK</td>
                        <td rowspan="2"><?php echo ('Đánh giá'); ?></td>
                    </tr>
                    <?php break;
                                } else { ?>
                    <tr style="text-align:center;">
                        <td rowspan="2"><?php echo ('Học sinh'); ?></td>
                        <td colspan="11"><?php echo ('Môn'); ?></td>
                        <td rowspan="2">DTK</td>
                        <td rowspan="2"><?php echo ('Đánh giá'); ?></td>
                    </tr>
                    <?php continue;
                                }
                            }
                        }  ?>
                    <tr>
                        <?php
                            $students    =    $this->crud_model->get_students($class_id);
                            $subjects = $this->crud_model->get_subjects_by_student($students[0]['student_id'], $class_id, $exam_id);
                            foreach ($subjects as $i) {
                                $sub    =    $this->crud_model->get_subject_info($i['subject_id']);
                                foreach ($sub as $sub_name) {
                                    // echo "<pre>";
                                    // print_r($sub_name);
                            ?>
                        <td> <?php echo $sub_name['subject_name']; ?> </td>
                        <?php  } ?>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // echo form_open(base_url() . 'index.php?admin/marks/');
                        $students    =    $this->crud_model->get_students($class_id);
                        foreach ($students as $row) {
                            $verify_data    =    array(
                                'exam_id' => $exam_id,
                                'class_id' => $class_id,
                                // 'subject_id' => $subject_id,
                                // 'dtb' => $row['dtb'],
                                'student_id' => $row['student_id']
                            );
                            $query = $this->db->get_where('grade', $verify_data);
                            $grade    =    $query->result_array();
                            // echo"<pre>";
                            // print_r($grade);
                            $sum = 0;
                            $count = 0;
                        ?>
                    <!-- <?php echo form_open(base_url() . 'index.php?admin/marks/');
                                    ?> -->
                    <tr>

                        <td>
                            <?php echo $row['name']; ?>
                        </td>
                        <?php
                                foreach ($grade as $row2) :
                                ?>
                        <!-- <?php echo form_open(base_url() . 'index.php?admin/marks/');
                                            ?> -->
                        <td>
                            <input type="number" value="<?php echo $row2['dtb']; ?>" name="dtb" class="form-control" />
                            <?php
                                    $sum += $row2['dtb'];
                                    $count++;
                                endforeach; ?>
                        </td>
                        <td> <?php $dtk = round($sum / $count, 2);
                                            echo $dtk; ?>

                        </td>

                        <td>
                            <textarea name="comment" class="form-control"><?php echo $row2['comment']; ?></textarea>
                        </td>
                        <td>
                            <input type="hidden" name="mark_id" value="<?php echo $row2['mark_id']; ?>" />

                            <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>" />
                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                            <input type="hidden" name="department_id" value="<?php echo $department_id; ?>" />

                        </td>
                    </tr>
                    <?php

                            $sql1 = "UPDATE `grade` set `dtk` = $dtk  WHERE `student_id` = {$row['student_id']} and `exam_id` = {$row2['exam_id']}";
                            $r = mysqli_query($conn, $sql1);
                            ?>
                    <?php } ?>
                </tbody>
            </table>
            <?php
            } else { ?>
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr style="text-align:center;">
                        <td rowspan="2"><?php echo ('Học sinh'); ?></td>
                        <td colspan="3">DTK</td>
                        <td rowspan="2"><?php echo ('Đánh giá'); ?></td>
                    </tr>
                    <tr style="text-align:center;">
                        <td>Kì I</td>
                        <td>Kì II</td>
                        <td>Cả năm</td>
                    </tr>

                </thead>
                <tbody>
                    <?php
                        // $dtk2 = 0;
                        $sum =0;

                        $students    =    $this->crud_model->get_students($class_id);
                        foreach ($students as $i) {
                        ?>
                    <tr>
                        <td>
                            <?php echo $i['name']; ?>
                        </td>

                        <td> <?php
                                $sql = "SELECT DISTINCT `student_id`,`class_id`,exam_id, `dtk` FROM `grade` WHERE class_id = $class_id and exam_id=1 ";
                                $kq = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($kq)) {
                                ?>
                            <?php
                                        if ($i['student_id'] == $row['student_id']) {
                                            echo $row['dtk'];
                                            $sum += $row['dtk'];
                                        }
                                    }
                                        ?>
                        </td>
                        <td>
                            <?php
                                $sql2 = "SELECT DISTINCT `student_id`,`class_id`,exam_id, `dtk` FROM `grade` WHERE class_id = $class_id and exam_id=2 ";
                                $kq2 = mysqli_query($conn, $sql2);
                                while ($row2 = mysqli_fetch_assoc($kq2)) {
                                ?>
                            <?php
                                        if ($i['student_id'] == $row2['student_id']) {
                                            echo $row2['dtk'];
                                            $sum += $row2['dtk'] * 2;

                                        }
                                    }
                                        ?>
                        </td>
                        <td>
                            <?php 
                                       $dtk2 = round($sum / 3, 2); 
                                       echo $dtk2;
                                       ?>
                        </td>
                        <td>
                            <textarea name="comment" class="form-control"><?php echo $row2['comment']; ?></textarea>
                        </td>
                        <td>
                            <input type="hidden" name="mark_id" value="<?php echo $row2['mark_id']; ?>" />
                            <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>" />
                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                            <input type="hidden" name="department_id" value="<?php echo $department_id; ?>" />

                        </td>
                        <?php
                                
                            }
                        }
                        ?>
                    </tr>
                    <?php
                            $sql1 = "UPDATE `grade` set `dtk` = $dtk  WHERE `student_id` = {$row['student_id']} and `exam_id` = {$row2['exam_id']}";
                            $r = mysqli_query($conn, $sql1);
                            ?>
                </tbody>
            </table>

            <!-- ======= FORM ======== -->

        </div>
        <!----TABLE LISTING ENDS-->

    </div>
</div>
</div>

<script type="text/javascript">
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
</script>