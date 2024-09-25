<?php
 
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
                <?php echo form_open(base_url() . 'index.php?admin/grade'); ?>
                <table border="0" cellspacing="0" cellpadding="0"
                    class="table table-bordered table-hover table-striped">
                    <tr>
                        <td><?php echo ('Chọn bài kiểm tra'); ?></td>
                        <td><?php echo ('Chọn khối'); ?></td>
                        <td><?php echo ('Chọn lớp'); ?></td>
                        <td><?php echo ('Chọn môn'); ?></td>
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
                            <select onchange="show_subjects(this.value)" name="<?php if ($department_id == $row['department_id']) echo 'class_id';
                                                                                    else echo 'temp'; ?>"
                                id="class_id_<?php echo $row['department_id']; ?>"
                                style="display:<?php if ($department_id == $row['department_id']) echo 'block';
                                                                                                                                                                            else echo 'none'; ?>;"
                                class="form-control" style="float:left;">
                                <option value="">Lớp <?php echo $row['department']; ?></option>
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
                                <option value="">Chọn lớp</option>
                            </select>
                        </td>
                        <td>
                            <!-----SELECT SUBJECT ACCORDING TO SELECTED CLASS-------->
                            <?php
                            $classes    =    $this->crud_model->get_classes();
                            foreach ($classes as $row) : ?>

                            <select name="<?php if ($class_id == $row['class_id']) echo 'subject_id';
                                                else echo 'temp'; ?>" id="subject_id_<?php echo $row['class_id']; ?>"
                                style="display:<?php if ($class_id == $row['class_id']) echo 'block';
                                                                                                                                        else echo 'none'; ?>;"
                                class="form-control" style="float:left;">
                                <option value="">Môn học của lớp <?php echo $row['name']; ?></option>
                                <?php
                                    $subjects    =    $this->crud_model->get_subjects_by_level($row['level_id']);
                                    foreach ($subjects as $row2) : ?>
                                <option value="<?php echo $row2['subject_id']; ?>"
                                    <?php if (isset($subject_id) && $subject_id == $row2['subject_id'])
                                                                                                echo 'selected="selected"'; ?>><?php echo $row2['subject_name']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <?php endforeach; ?>
                            <select name="temp" id="subject_id_0" style="display:<?php if (isset($subject_id) && $subject_id > 0) echo 'none';
                                                                                        else echo 'block'; ?>;"
                                class="form-control" style="float:left;">
                                <option value="">Chọn môn của lớp</option>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="operation" value="selection" />
                            <input type="submit" value="<?php echo ('Tìm kiếm'); ?>" class="btn btn-info" />

                        </td>
                    </tr>
                </table>
                </form>
            </center>


            <br /><br />


            <?php if ($exam_id > 0 && $department_id > 0 && $class_id > 0) : ?>

            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr style="text-align:center;">
                        <td rowspan="2"><?php echo ('Học sinh'); ?></td>
                        <td colspan="9"><?php echo ('Điểm'); ?></td>
                        <td rowspan="2">DTB</td>
                        <td rowspan="2">Xếp hạng</td>
                        <td rowspan="2"><?php echo ('Đánh giá'); ?></td>

                    </tr>
                    <tr>

                        <td colspan="2"><?php echo ('Điểm miệng'); ?></td>
                        <td colspan="2"><?php echo ("Điểm 15'"); ?></td>
                        <td colspan="2"><?php echo ('Hệ số 1'); ?></td>
                        <td colspan="2"><?php echo ('Hệ số 2'); ?></td>
                        <td><?php echo ('Hệ số 3'); ?></td>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $students    =    $this->crud_model->get_students($class_id);
                        // echo"<pre>";
                        //     print_r($student);

                        // $sql = "SELECT * FROM STUDENT ";
                        // $r = mysqli_query($conn, $sql);
                        // while ($row = mysqli_fetch_assoc($r)) {
                        foreach ($students as $row) :
                            $verify_data    =    array(
                                'exam_id' => $exam_id,
                                'class_id' => $class_id,
                                'subject_id' => $subject_id,
                                'student_id' => $row['student_id']
                            );

                            $query = $this->db->get_where('grade', $verify_data);
                            $grade    =    $query->result_array();
                            // echo"<pre>";
                            // print_r($grade);
                            // $grade   =    $this->crud_model->get_grades();


                            foreach ($grade as $row2) :
                                // echo"<pre>";
                                // print_r($row2);
                        ?>
                    <!-- <?php echo form_open(base_url() . 'index.php?admin/grade'); ?> -->
                    <?php $sum = 0; ?>


                    <tr>
                        <td>
                            <?php echo $row['name']; ?>
                        </td>
                        <td>
                            <input type="number" value="<?php echo $row2['diem_mieng1']; ?>" name="diem_mieng"
                                class="form-control" />
                            <?php $sum +=  $row2['diem_mieng1']; ?>
                        </td>
                        <td>
                            <input type="number" value="<?php echo $row2['diem_mieng2']; ?>" name="diem_mieng"
                                class="form-control" />
                            <?php $sum +=  $row2['diem_mieng2'];
                                        ?>

                        </td>
                        <td>
                            <input type="number" value="<?php echo $row2['diem15_phut1']; ?>" name="diem15_phut"
                                class="form-control" />
                            <?php $sum +=  $row2['diem15_phut1']; ?>

                        </td>
                        <td>
                            <input type="number" value="<?php echo $row2['diem15_phut2']; ?>" name="diem15_phut"
                                class="form-control" />
                            <?php $sum +=  $row2['diem15_phut2']; ?>
                        </td>
                        <td>
                            <input type="number" value="<?php echo $row2['hs1_1']; ?>" name="hs1"
                                class="form-control" />
                            <?php $sum +=  $row2['hs1_1']; ?>
                        </td>
                        <td>
                            <input type="number" value="<?php echo $row2['hs1_2']; ?>" name="hs1"
                                class="form-control" />
                            <?php $sum +=  $row2['hs1_2']; ?>

                        </td>
                        <td>
                            <input type="number" value="<?php echo $row2['hs2_1']; ?>" name="hs2"
                                class="form-control" />
                            <?php $sum +=  $row2['hs2_1'] * 2; ?>

                        </td>
                        <td>
                            <input type="number" value="<?php echo $row2['hs2_2']; ?>" name="hs2"
                                class="form-control" />
                            <?php $sum +=  $row2['hs2_2'] * 2; ?>

                        </td>
                        <td>
                            <input type="number" value="<?php echo $row2['hs3']; ?>" name="hs3" class="form-control" />
                            <?php $sum +=  $row2['hs3'] * 3; ?>

                        </td>
                        <td>
                            <?php
                                        $dtb =  round($sum / 13, 2);
                                        if ($row2['subject_id'] == 'td_6' || $row2['subject_id'] == 'td_7' || $row2['subject_id'] == 'td_8' || $row2['subject_id'] == 'td_9') {
                                            $dtb =  round($sum / 5, 2);
                                        }
                                        echo $dtb;
                                        ?>
                        </td>
                        <td>
                            <?php
                                if($dtb < 5){
                                    echo "Yếu";
                                }
                                else if($dtb >= 5 && $dtb < 6.5){
                                    echo "Trung bình";
                                }            
                                else if($dtb >= 6.5 && $dtb < 8){
                                    echo "Khá";
                                }            
                                else if($dtb >= 8 ){
                                    echo "Giỏi";
                                }            
                            ?>
                        </td>
                        <td>
                            <textarea name="comment" class="form-control"><?php echo $row2['comment']; ?></textarea>
                        </td>
                        <td>
                            <input type="hidden" name="mark_id" value="<?php echo $row2['mark_id']; ?>" />

                            <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>" />
                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                            <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>" />

                        </td>
                    </tr>

                    <?php
                            endforeach;
                            $sub = $row2['subject_id'];
                            $sql1 = "UPDATE `grade` set `dtb` = $dtb WHERE `student_id` = {$row2['student_id']} and `subject_id` = '{$sub}' and `exam_id` = $exam_id";
                            $r = mysqli_query($conn, $sql1);

                            ?>

                    <?php
                        endforeach;
                        ?>
                </tbody>
            </table>

            <?php endif; ?>
        </div>
        <!----TABLE LISTING ENDS-->

    </div>
</div>
</div>

<script type="text/javascript">
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