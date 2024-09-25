<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo ('Mẫu nhập học');?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/student/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Họ và tên');?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" data-validate="required"
                            data-message-required="<?php echo ('Value Required');?>" value="" autofocus>
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
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Lớp');?></label>

                    <div class="col-sm-5">
                        <select name="class_id" class="form-control" data-validate="required" id="class_id"
                            data-message-required="<?php echo ('Value Required');?>"
                            onchange="return get_class_sections(this.value)">
                            <?php 
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
									?>
                            <option value="<?php echo $row['class_id'];?>">
                                <?php echo $row['name'];?>
                            </option>
                            <?php
								endforeach;
							  ?>
                        </select>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Section');?></label>
                    <div class="col-sm-5">
                        <select name="section_id" class="form-control" id="section_selector_holder">
                            <option value=""><?php echo ('Select class first');?></option>

                        </select>
                    </div>
                </div> -->

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Ngày sinh');?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Giới tính');?></label>

                    <div class="col-sm-5">
                        <select name="sex" class="form-control">
                            <option value="Male"><?php echo ('Nam');?></option>
                            <option value="Female"><?php echo ('Nữ');?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Địa chỉ');?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="address" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Sđt');?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Bố');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="father_name" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('sdt của Bố');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone_father" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Mẹ');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="mother_name" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Sđt của Mẹ');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone_mother" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Email');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Mật khẩu');?></label>

                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Ảnh');?></label>

                    <div class="col-sm-5">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;"
                                data-trigger="fileinput">
                                <img src="http://placehold.it/200x200" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"
                                style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileinput-new">Chọn ảnh</span>
                                    <span class="fileinput-exists">Sửa</span>
                                    <input type="file" name="userfile" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo ('Thêm học sinh');?></button>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function get_class_sections(class_id) {

    $.ajax({
        url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id,
        success: function(response) {
            jQuery('#section_selector_holder').html(response);
        }
    });

}
</script>