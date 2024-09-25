<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo ('Thêm giáo viên');?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/teacher/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Họ và Tên');?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" data-validate="required"
                            data-message-required="<?php echo ('Value Required');?>" value="" autofocus>
                    </div>
                </div>

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
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('SĐT');?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone" value="">
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
                    <label for="field-2" class="col-sm-3 control-label"><?php echo ('Chuyên môn');?></label>

                    <div class="col-sm-5">
                        <select name="chuyenmon" class="form-control">
                            <?php 
								$chuyenmon    =    $this->db->get('chuyenmon')->result_array();
								foreach ($chuyenmon as $i) {
									  
								
								?>
                            <option value="<?php echo $i['chuyenmon_id']?>"><?php echo $i['ten_mon']?></option>
                            <?php  }?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Photo');?></label>

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
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="userfile" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo ('Thêm giáo viên');?></button>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>