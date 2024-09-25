<hr />

<div class="row">
    <?php echo form_open(base_url() . 'index.php?admin/system_settings/do_update' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
    <div class="col-md-6">

        <div class="panel panel-primary">

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo ('Cài đặt Chung');?>
                </div>
            </div>

            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Tên hệ thống');?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="system_name"
                            value="<?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Tiêu để hệ thống');?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="system_title"
                            value="<?php echo $this->db->get_where('settings' , array('type' =>'system_title'))->row()->description;?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Địa chỉ');?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="address"
                            value="<?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Điện thoại');?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="phone"
                            value="<?php echo $this->db->get_where('settings' , array('type' =>'phone'))->row()->description;?>">
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Paypal email');?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="paypal_email"
                            value="<?php echo $this->db->get_where('settings' , array('type' =>'paypal_email'))->row()->description;?>">
                    </div>
                </div> -->

                <!-- <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('TIền');?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="currency"
                            value="<?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?>">
                    </div>
                </div> -->

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Email Hệ thống');?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="system_email"
                            value="<?php echo $this->db->get_where('settings' , array('type' =>'system_email'))->row()->description;?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Ngôn ngữ');?></label>
                    <div class="col-sm-9">
                        <select name="language" class="form-control">
                            <?php
									$fields = $this->db->list_fields('language');
									foreach ($fields as $field)
									{
										if ($field == 'phrase_id' || $field == 'phrase')continue;
										
										$current_default_language	=	$this->db->get_where('settings' , array('type'=>'language'))->row()->description;
										?>
                            <option value="<?php echo $field;?>"
                                <?php if ($current_default_language == $field)echo 'selected';?>> <?php echo $field;?>
                            </option>
                            <?php
									}
									?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Căn lề');?></label>
                    <div class="col-sm-9">
                        <select name="text_align" class="form-control">
                            <?php $text_align	=	$this->db->get_where('settings' , array('type'=>'text_align'))->row()->description;?>
                            <option value="left-to-right" <?php if ($text_align == 'left-to-right')echo 'selected';?>>
                                Trái qua phải</option>
                            <option value="right-to-left" <?php if ($text_align == 'right-to-left')echo 'selected';?>>
                                Phải qua trái</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info"><?php echo ('Lưu');?></button>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php echo form_close();?>

    <?php 
        $skin = $this->db->get_where('settings' , array(
          'type' => 'skin_colour'
        ))->row()->description;
      ?>

    <div class="col-md-6">

        <div class="panel panel-primary">

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo ('Cài đặt chủ đề');?>
                </div>
            </div>

            <div class="panel-body">

                <div class="gallery-env">

                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="default">
                                    <img src="assets/images/skins/default.png"
                                        <?php if ($skin == 'default') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="default">
                                    <i class="entypo-check"></i>
                                    <?php echo ('Default');?>
                                </a>
                            </header>
                        </article>
                    </div>

                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="black">
                                    <img src="assets/images/skins/black.png"
                                        <?php if ($skin == 'black') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="black">
                                    <i class="entypo-check"></i>
                                    <?php echo ('Lựa chọn chủ đề');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="blue">
                                    <img src="assets/images/skins/blue.png"
                                        <?php if ($skin == 'blue') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="blue">
                                    <i class="entypo-check"></i>
                                    <?php echo ('Lựa chọn chủ đề');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="cafe">
                                    <img src="assets/images/skins/cafe.png"
                                        <?php if ($skin == 'cafe') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="cafe">
                                    <i class="entypo-check"></i>
                                    <?php echo ('Lựa chọn chủ đề');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="green">
                                    <img src="assets/images/skins/green.png"
                                        <?php if ($skin == 'green') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="green">
                                    <i class="entypo-check"></i>
                                    <?php echo ('Lựa chọn chủ đề');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="purple">
                                    <img src="assets/images/skins/purple.png"
                                        <?php if ($skin == 'purple') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="purple">
                                    <i class="entypo-check"></i>
                                    <?php echo ('Lựa chọn chủ đề');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="red">
                                    <img src="assets/images/skins/red.png"
                                        <?php if ($skin == 'red') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="red">
                                    <i class="entypo-check"></i>
                                    <?php echo ('Lựa chọn chủ đề');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="white">
                                    <img src="assets/images/skins/white.png"
                                        <?php if ($skin == 'white') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="white">
                                    <i class="entypo-check"></i>
                                    <?php echo ('Lựa chọn chủ đề');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="yellow">
                                    <img src="assets/images/skins/yellow.png"
                                        <?php if ($skin == 'yellow') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="yellow">
                                    <i class="entypo-check"></i>
                                    <?php echo ('Lựa chọn chủ đề');?>
                                </a>
                            </header>
                        </article>
                    </div>

                </div>
                <center>
                    <div class="label label-primary" style="font-size: 12px;">
                        <i class="entypo-check"></i> <?php echo ('Chủ đề bạn chọn đã được thay đổi');?>
                    </div>
                </center>
            </div>

        </div>

        <?php echo form_open(base_url() . 'index.php?admin/system_settings/upload_logo' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

        <div class="panel panel-primary">

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo ('Thay đổi  logo');?>
                </div>
            </div>

            <div class="panel-body">


                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo ('Ảnh');?></label>

                    <div class="col-sm-9">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;"
                                data-trigger="fileinput">
                                <img src="<?php echo base_url();?>uploads/logo.png" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"
                                style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileinput-new">Lựa chọn ảnh</span>
                                    <span class="fileinput-exists">Thay đổi</span>
                                    <input type="file" name="userfile" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info"><?php echo ('Tải lên');?></button>
                    </div>
                </div>

            </div>

        </div>

        <?php echo form_close();?>


    </div>

</div>

<script type="text/javascript">
$(".gallery-env").on('click', 'a', function() {
    skin = this.id;
    $.ajax({
        url: '<?php echo base_url();?>index.php?admin/system_settings/change_skin/' + skin,
        success: window.location = '<?php echo base_url();?>index.php?admin/system_settings/'
    });
});
</script>