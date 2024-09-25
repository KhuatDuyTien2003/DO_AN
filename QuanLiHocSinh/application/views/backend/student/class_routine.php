<?php
    $conn = new mysqli("127.0.0.1:3307", "root", "", "schooligniter");
    mysqli_set_charset($conn, 'utf8');
    $class_routine = $this->db->where('class_id', 1)->get('class_routine')->result_array();
    $sql = "SELECT DISTINCT class.name, subject.name, subject.subject_id, teacher.teacher_name FROM `teach` INNER JOIN class on class.class_id=teach.class_id INNER JOIN teacher ON teacher.teacher_id=teach.teacher_id INNER JOIN chuyenmon ON teacher.chuyenmon_id=chuyenmon.chuyenmon_id INNER JOIN subject ON subject.chuyenmon_id=chuyenmon.chuyenmon_id WHERE  class.class_id=$class_id and class.level_id = subject.level_id";
    $result = mysqli_query($conn, $sql);
    foreach($class_routine as $row):
         if($row['day'] == 1):
           if($row['time_start'] >= 1 && $row['time_start'] <= 6):
                   foreach ($result as $row3) :
                    # code...
        
                     if($row['subject_id'] == $row3['subject_id']):
  //  while($row3 = mysqli_fetch_assoc($result)){
                            echo "<pre>";
                          // print_r($row);
                           print_r($row3);
     //}    
  endif;
endforeach;
endif;
endif;
 endforeach;
?>

<style>
.content_table {
    border: 1px solid rgb(207, 218, 228);
    border-radius: 5px;
    width: 90%;
    margin-left: 5%;
    margin-bottom: 10px;
    background-color: white;
    padding-left: 10%;
    color: black;
}

.content_table>h3 {
    font-size: 130%;

}
</style>

<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo ('Thời khóa biểu');?>
                </a>
            </li>

        </ul>
        <!------CONTROL TABS END------>


        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-spane active" id="list">
                <div class="panel-group joined" id="accordion-test-2">
                    <?php 
					$toggle = true;
					$classes = $this->db->where('class_id', $class_id)->get('class')->result_array();
					foreach($classes as $row):
						?>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-test-2"
                                    href="#collapse<?php echo $row['class_id'];?>">
                                    <i class="entypo-rss"></i> Lớp <?php echo $row['name'];?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse<?php echo $row['class_id'];?>"
                            class="panel-collapse collapse <?php if($toggle){echo 'in';$toggle=false;}?>">
                            <div class="panel-body">
                                <table cellpadding="0" cellspacing="0" border="0"
                                    class="table table-hover table-striped table-bordered">
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
                                    <tbody>
                                        <tr>
                                            <td style="color: black; font-weight: bold; background-color: #FFFFCE">Buổi
                                                Sáng</td>
                                            <?php
                                                  for($day = 1; $day < 7; $day++):
                                                ?>
                                            <td>
                                                <?php
                                                $class_routine = $this->db->where('class_id', $class_id)->get('class_routine')->result_array();
                                                $sql = "SELECT DISTINCT class.name, subject.subject_name, subject.subject_id, teacher.teacher_name FROM `teach` INNER JOIN class on class.class_id=teach.class_id INNER JOIN teacher ON teacher.teacher_id=teach.teacher_id INNER JOIN chuyenmon ON teacher.chuyenmon_id=chuyenmon.chuyenmon_id INNER JOIN subject ON subject.chuyenmon_id=chuyenmon.chuyenmon_id WHERE  class.class_id=$class_id and class.level_id = subject.level_id";
                                                $result = mysqli_query($conn, $sql);
                                                foreach($class_routine as $row1):
                                                    if($row1['time_start'] >= 1 && $row1['time_start'] <= 6):
                                                        if($row1['day'] == $day):
                                                            foreach ($result as $row3) :
                                                                  if($row1['subject_id'] == $row3['subject_id']){
                                                 ?>
                                                <div class="content_table">


                                                    <h3> <?php echo $row3['subject_name'] ?></h3>
                                                    <p>Tiết :<?php echo $row1['time_start']. "-" .$row1['time_end']?>
                                                    </p>
                                                    <p>Giáo viên: <?php echo $row3['teacher_name']?> </p>
                                                    <p>Lớp: <?php echo $row['name']?> </p>



                                                </div>
                                                <?php
                                                }
                                                        endforeach;
                                                            endif;
                                                            endif;
                                                             endforeach;
                                                        ?>

                                            </td>
                                            <?php
                                            endfor
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
                                                $class_routine = $this->db->where('class_id', $class_id)->get('class_routine')->result_array();
                                                $sql = "SELECT DISTINCT class.name, subject.subject_name, subject.subject_id, teacher.teacher_name FROM `teach` INNER JOIN class on class.class_id=teach.class_id INNER JOIN teacher ON teacher.teacher_id=teach.teacher_id INNER JOIN chuyenmon ON teacher.chuyenmon_id=chuyenmon.chuyenmon_id INNER JOIN subject ON subject.chuyenmon_id=chuyenmon.chuyenmon_id WHERE  class.class_id=$class_id and class.level_id = subject.level_id";
                                                $result = mysqli_query($conn, $sql);
                                                foreach($class_routine as $row1):
                                                    if($row1['time_start'] >= 7 && $row1['time_start'] <= 12):
                                                        if($row1['day'] == $day):
                                                            foreach ($result as $row3) :
                                                                  if($row1['subject_id'] == $row3['subject_id']){
                                                 ?>
                                                <div class="content_table">


                                                    <h3> <?php echo $row3['subject_name'] ?></h3>
                                                    <p>Tiết :<?php echo $row1['time_start']. "-" .$row1['time_end']?>
                                                    </p>
                                                    <p>Giáo viên: <?php echo $row3['teacher_name']?> </p>
                                                    <p>Lớp: <?php echo $row['name']?> </p>



                                                </div>
                                                <?php
                                                }
                                                        endforeach;
                                                            endif;
                                                            endif;
                                                             endforeach;
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
                                <!-- <table cellpadding="0" cellspacing="0" border="0"
                                    class="table table-hover table-striped table-bordered">
                                    <tbody>
                                        <?php 
                                                for($d=1;$d<=7;$d++):
                                                
                                                    if($d==1) {$day='sunday';
                                                        $ngay = 'Chủ Nhật';
                                                }
                                              
                                                else if($d==2){$day='monday';
                                                    $ngay = 'Thứ Hai';
                                                }
                                                else if($d==3){$day='tuesday';
                                                    $ngay = 'Thứ Ba';}
                                                else if($d==4){$day='wednesday';
                                                    $ngay = 'Thứ Tư';}
                                                else if($d==5){$day='thursday';
                                                    $ngay = 'Thứ Năm';}
                                                else if($d==6){$day='friday';
                                                    $ngay = 'Thứ Sáu';}
                                                else if($d==7){$day='saturday';
                                                    $ngay = 'Thứ Bảy';
                                                }
                                                ?>
                                        <tr class="gradeA">
                                            <td width="100"><?php echo ($ngay);?></td>
                                            <td>
                                                <?php
														$this->db->order_by("time_start", "asc");
														$this->db->where('day' , $d);
														$this->db->where('class_id' , $class_id);
														 $routines	=	$this->db->get('class_routine')->result_array();
														foreach($routines as $row2):
                                                        
														?>
                                                <div class="btn-group">
                                                    <button class="btn btn-primary dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        <?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?>
                                                        <?php echo '('.$row2['time_start'].'-'.$row2['time_end'].')';?>

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
                                                <?php endforeach;?>

                                            </td>
                                        </tr>
                                        <?php endfor;?>

                                    </tbody>
                                </table> -->

                            </div>
                        </div>
                    </div>
                    <?php
					endforeach;
					?>
                </div>
            </div>
            <!----TABLE LISTING ENDS--->



            <!----CREATION FORM ENDS-->

        </div>
    </div>
</div>

<script type="text/javascript">
function get_class_subject(class_id) {
    $.ajax({
        url: '<?php echo base_url();?>index.php?admin/get_class_subject/' + class_id,
        success: function(response) {
            jQuery('#subject_selection_holder').html(response);
        }
    });
}
</script>