<?php 
$teacher_id =  $this->session->userdata('teacher_id');
// $conn = mysqli_connect('127.0.0.1:3307', 'root', '', 'schooligniter');
// $sql = "SELECT DISTINCT class.name, subject.name, subject.subject_id, teacher.teacher_name FROM `teach` INNER JOIN class on class.class_id=teach.class_id INNER JOIN teacher ON teacher.teacher_id=teach.teacher_id INNER JOIN chuyenmon ON teacher.chuyenmon_id=chuyenmon.chuyenmon_id INNER JOIN subject ON subject.chuyenmon_id=chuyenmon.chuyenmon_id WHERE class.class_id= 1 and class.level_id = subject.level_id";
// $result = mysqli_query($conn, $sql);
// while ($row = mysqli_fetch_assoc($result)) {
//     echo "<pre>";
//     print_r($row); 
// }
?>
<div class="row">
    <div class="col-md-8">
        <div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo ('Lịch sự kiện');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">

                <div class="tile-stats tile-red">
                    <a href="<?php echo base_url(); ?>index.php?student<?php echo $class_routine; ?>/class_routine">
                        <div class="icon"><i class="fa fa-group"></i></div>
                        <h3><?php echo ('Lịch dạy trong ngày');?></h3>
                        <?php
                            $day = date("Y-m-d");
                            $thu =  date("N", strtotime($day));
                            $check	=	array(	'day' => $thu );
							$query = $this->db->get_where('class_routine' , $check);
							$present_today		=	$query->num_rows();
                   
                        ?>
                        <div class="num" data-start="0" data-end="<?php echo $present_today;?>" data-postfix=""
                            data-duration="1500" data-delay="0">0</div>
                        <!-- <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/dashboard">
                                <i class="entypo-gauge"></i> 
                                <span><?php echo ('Trang chủ'); ?></span>
                            </a>
                        </li> -->
                </div>

            </div>
            <div class="col-md-12">

                <div class="tile-stats tile-green">
                    <a href="<?php echo base_url(); ?>index.php?student<?php echo $class_routine; ?>/subject">
                        <div class="icon"><i class="entypo-users"></i></div>
                        <h3><?php echo ('Môn Học');?></h3>
                        <?php
                            $check1	=	array(	'student_id' => $student_id );
                     $query1 = $this->db->get_where('student' , $check1) -> row();
                    
                            $check2	=	array(	'class_id' => $query1->class_id );
                    $query2 = $this->db->get_where('class' , $check2)->row();
                            $check3	=	array(	'level_id' => $query2->level_id );
                $query3 = $this->db->get_where('subject' , $check3);
							$subjects	=	$query3->num_rows();
                   
                        ?>
                        <div class="num" data-start="0" data-end="<?php echo $subjects;?>" data-postfix=""
                            data-duration="1500" data-delay="0">0</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="tile-stats tile-cyan">
                    <div class="icon"><i class="entypo-credit-card"></i></div>
                    <a href="<?php echo base_url(); ?>index.php?student<?php echo $class_routine; ?>/noticeboard">
                        <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('noticeboard');?>"
                            data-postfix="" data-duration="500" data-delay="0">0</div>

                        <h3><?php echo ('Thông báo hiện có');?></h3>

                </div>

            </div>
            <!-- <div class="col-md-12">
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-user"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('parent');?>"
                        data-postfix="" data-duration="500" data-delay="0">0</div>

                    <h3><?php echo ('Phụ huynh');?></h3>
                    <p>Total parents</p>
                </div>

            </div> -->
            <!-- <div class="col-md-12">
            
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                   
         
                    		data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3><?php echo ('Attendance');?></h3>
                   <p>Total present student today</p>
                </div>
                
            </div> -->
        </div>
    </div>

</div>



<script>
$(document).ready(function() {

    var calendar = $('#notice_calendar');

    $('#notice_calendar').fullCalendar({
        header: {
            left: 'title',
            right: 'today prev,next'
        },

        //defaultView: 'basicWeek',

        editable: false,
        firstDay: 1,
        height: 530,
        droppable: false,

        events: [
            <?php 
						$notices	=	$this->db->get('noticeboard')->result_array();
						foreach($notices as $row):
						?> {
                title: "<?php echo $row['notice_title'];?>",
                start: new Date(<?php echo date('Y',$row['create_timestamp']);?>,
                    <?php echo date('m',$row['create_timestamp'])-1;?>,
                    <?php echo date('d',$row['create_timestamp']);?>),
                end: new Date(<?php echo date('Y',$row['create_timestamp']);?>,
                    <?php echo date('m',$row['create_timestamp'])-1;?>,
                    <?php echo date('d',$row['create_timestamp']);?>)
            },
            <?php 
						endforeach
						?>

        ]
    });
});
</script>