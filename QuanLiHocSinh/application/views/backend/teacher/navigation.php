<div class="sidebar-menu">
    <header class="logo-env">

        <!-- logo -->
        <div class="logo" style="">
            <a style="display: flex;" href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png" style="max-height:60px;" />
                <h4 style="color: white; padding-top: 10px; padding-left: 7px;">Trường THCS <br> <span
                        style="padding-left:40px; font-size: 18px;">nhóm
                        High</span></h4>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo ('Trang chủ'); ?></span>
            </a>
        </li>

        <!-- STUDENT -->
        <li class="<?php
                    if (
                        $page_name == 'student_add' ||
                        $page_name == 'student_information' ||
                        $page_name == 'student_marksheet'
                    )
                        echo 'opened active has-sub';
                    ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo ('Học sinh'); ?></span>
            </a>
            <ul>
                <!-- STUDENT ADMISSION -->

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'student_information') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> <?php echo ('Thông tin học sinh'); ?></span>
                    </a>
                    <ul>
                        <?php
                        $teacher_id =  $this->session->userdata('teacher_id');
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row) :
                        ?>
                        <li
                            class="<?php if ($page_name == 'student_information' && $class_id == $row['class_id']) echo 'active'; ?>">
                            <a
                                href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_information/<?php echo $row['class_id']; ?>">
                                <span><?php echo ('Lớp'); ?> <?php echo $row['name']; ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- STUDENT MARKSHEET -->
                <li class="<?php if ($page_name == 'student_marksheet') echo 'opened active'; ?> ">
                    <a
                        href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_marksheet/<?php echo $row['class_id']; ?>">
                        <span><i class="entypo-dot"></i> <?php echo ('Bảng điểm học sinh'); ?></span>
                    </a>
                    <ul>
                        <?php $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row) :
                        ?>
                        <li
                            class="<?php if ($page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                            <a
                                href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_marksheet/<?php echo $row['class_id']; ?>">
                                <span><?php echo ('Lớp'); ?> <?php echo $row['name']; ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </li>

        <!-- TEACHER -->
        <!-- <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/teacher_list">
                <i class="entypo-users"></i>
                <span><?php echo ('Giáo viên'); ?></span>
            </a>
        </li> -->



        <!-- SUBJECT -->
        <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span><?php echo ('Môn học'); ?></span>
            </a>
            <ul>
                <?php $classes = $this->db->get('class')->result_array();
                $teacher_id =  $this->session->userdata('teacher_id');
                foreach ($classes as $row) :
                    if ($row['teacher_id'] ==  $teacher_id) {
                    
                ?>
                <li class="<?php if ($page_name == 'subject' && $class_id == $row['class_id']) echo 'active'; ?>">
                    <a
                        href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/subject/<?php echo $row['class_id']; ?>">
                        <span><?php echo ('Lớp'); ?> <?php echo $row['name']; ?></span>
                    </a>
                </li>
                <?php } endforeach; ?>
            </ul>
        </li>

        <!-- CLASS ROUTINE -->
        <li class="<?php if ($page_name == 'class_routine') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/class_routine">
                <i class="entypo-target"></i>
                <span><?php echo ('Lịch học'); ?></span>
            </a>
        </li>

        <!-- STUDY MATERIAL -->
        <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/study_material">
                <i class="entypo-book-open"></i>
                <span><?php echo ('Tài liệu học tập'); ?></span>
            </a>
        </li>

        <!-- DAILY ATTENDANCE -->
        <!-- <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
            <a
                href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_attendance/<?php echo date("d/m/Y"); ?>">
                <i class="entypo-chart-area"></i>
                <span><?php echo ('Daily Attendance'); ?></span>
            </a>

        </li> -->

        <!-- EXAMS -->
        <li class="<?php
                    if (
                        $page_name == 'exam' ||
                        $page_name == 'grade' ||
                        $page_name == 'marks'
                    )
                        echo 'opened active';
                    ?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo ('Bài kiểm tra'); ?></span>
            </a>
            <ul>

                <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/marks">
                        <span><i class="entypo-dot"></i> <?php echo ('Quản lí điểm'); ?></span>
                    </a>
                </li>
            </ul>
        </li>


        <!-- LIBRARY -->
        <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/book">
                <i class="entypo-book"></i>
                <span><?php echo ('Thư viện'); ?></span>
            </a>
        </li>

        <!-- TRANSPORT -->
        <!-- <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/transport">
                <i class="entypo-location"></i>
                <span><?php echo ('Transport'); ?></span>
            </a>
        </li> -->

        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo ('Bảng tin'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/message">
                <i class="entypo-mail"></i>
                <span><?php echo ('Thư từ'); ?></span>
            </a>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo ('Tài khoản'); ?></span>
            </a>
        </li>

    </ul>

</div>