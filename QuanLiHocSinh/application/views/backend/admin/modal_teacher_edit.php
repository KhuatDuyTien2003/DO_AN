<?php 
$edit_data		=	$this->db->get_where('teacher' , array('teacher_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo ('Sửa');?>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/teacher/do_update/'.$row['teacher_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Ảnh');?></label>

                    <div class="col-sm-5">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;"
                                data-trigger="fileinput">
                                <img src="<?php echo $this->crud_model->get_image_url('teacher' , $row['teacher_id']);?>"
                                    alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"
                                style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileinput-new">Chọn ảnh mới</span>
                                    <span class="fileinput-exists">Sửa Ảnh</span>
                                    <input type="file" name="userfile" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Họ và Tên');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Ngày sinh');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="datepicker form-control" name="birthday"
                            value="<?php echo $row['birthday'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Giới tính');?></label>
                    <div class="col-sm-5">
                        <select name="sex" class="form-control">
                            <option value="Male" <?php if($row['sex'] == 'Male')echo 'selected';?>><?php echo ('Nam');?>
                            </option>
                            <option value="Female" <?php if($row['sex'] == 'Female')echo 'selected';?>>
                                <?php echo ('Nữ');?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Địa chỉ');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('SĐT');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Email');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Mật khẩu');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="password"
                            value="<?php echo $row['password'];?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Chuyên môn');?></label>
                    <div class="col-sm-5">
                        <select name="sex" class="form-control">
                            <?php 
								$chuyenmon    =    $this->db->get('chuyenmon')->result_array();
								foreach ($chuyenmon as $i) {
									  
								
								?>
                            <option value="Male" <?php if($i['chuyenmon_id'] == $row['chuyenmon_id'])echo 'selected';?>>
                                <?php echo $i['ten_mon']?>
                            </option>
                            <option value="<?php echo $i['chuyenmon_id']?>"><?php echo $i['ten_mon']?></option>
                            <?php  }?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo ('Edit Teacher');?></button>
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