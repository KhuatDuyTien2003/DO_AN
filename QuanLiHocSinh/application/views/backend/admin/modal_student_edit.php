<?php 
$edit_data		=	$this->db->get_where('student' , array('student_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo ('Sửa học sinh');?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/student/'.$row['class_id'].'/do_update/'.$row['student_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>



                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Ảnh');?></label>

                    <div class="col-sm-5">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;"
                                data-trigger="fileinput">
                                <img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>"
                                    alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"
                                style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileinput-new">Chọn ảnh mới</span>
                                    <span class="fileinput-exists">Thay đổi</span>
                                    <input type="file" name="userfile" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Niên Khóa');?></label>

                    <div class="col-sm-5">
                        <select name="nienkhoa" class="form-control">
                            <option value="2021-2022">2021-2025</option>
                            <option value="2022-2023">2022-2026</option>
                            <option value="2023-2024">2023-2027</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Họ và Tên');?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" data-validate="required"
                            data-message-required="<?php echo ('Value Required');?>" value="<?php echo $row['name'];?>">
                    </div>
                </div>



                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Lớp');?></label>

                    <div class="col-sm-5">
                        <select name="class_id" class="form-control" data-validate="required" id="class_id"
                            data-message-required="<?php echo ('Value Required');?>"
                            onchange="return get_class_sections(this.value)">
                            <option value=""><?php echo ('Select');?></option>
                            <?php 
									$classes = $this->db->get('class')->result_array();
									foreach($classes as $row2):
										?>
                            <option value="<?php echo $row2['class_id'];?>"
                                <?php if($row['class_id'] == $row2['class_id'])echo 'selected';?>>
                                <?php echo $row2['name'];?>
                            </option>
                            <?php
									endforeach;
								  ?>
                        </select>
                    </div>
                </div>







                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Ngày sinh');?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control datepicker" name="birthday"
                            value="<?php echo $row['birthday'];?>" data-start-view="2">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Giới tính');?></label>

                    <div class="col-sm-5">
                        <select name="sex" class="form-control">

                            <option value="Male" <?php if($row['sex'] == 'Male')echo 'selected';?>>
                                <?php echo ('Nam');?></option>
                            <option value="Female" <?php if($row['sex'] == 'Female')echo 'selected';?>>
                                <?php echo ('Nữ');?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Địa chỉ');?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Sdt');?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Email');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Bố');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="father_name"
                            value="<?php echo $row['father_name'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Sđt của Bố');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone_father"
                            value="<?php echo $row['phone_father'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Mẹ');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="mother_name"
                            value="<?php echo $row['mother_name'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Sđt của mẹ');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone_mother"
                            value="<?php echo $row['phone_mother'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo ('Sửa');?></button>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>

<script type="text/javascript">
function get_class_sections(class_id) {

    $.ajax({
        url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id,
        success: function(response) {
            jQuery('#section_selector_holder').html(response);
        }
    });

}

var class_id = $("#class_id").val();

$.ajax({
    url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id,
    success: function(response) {
        jQuery('#section_selector_holder').html(response);
    }
});
</script>