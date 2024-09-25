
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">

			<div class="panel-body">

				<?php echo form_open(base_url() . 'index.php?teacher/student/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo ('Tên'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
					</div>
				</div>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo ('Giới tính'); ?></label>
					<div class="col-sm-5">
						<select name="sex" class="form-control">
							<option value="male">Nam</option>
							<option value="female">Nữ</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo ('Ngày sinh '); ?></label>
					<div class="col-sm-5">
						<input type="date" class="form-control" name="birthday" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
					</div>
				</div>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo ('Địa chỉ'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="address" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
					</div>
				</div>

				
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo ('Email'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="email" value="">
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo ('Password'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="password" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo ('Lớp'); ?></label>
					<div class="col-sm-5">
						<select name="class_id" class="form-control" data-validate="required" id="class_id" data-message-required="<?php echo get_phrase('value_required'); ?>" onchange="return get_class_sections(this.value)">
							<option value=""><?php echo ('Chọn lớp'); ?></option>
							<?php
							$classes = $this->db->get('class')->result_array();
							foreach ($classes as $row) :
							?>
								<option value="<?php echo $row['class_id']; ?>">
									<?php echo $row['name']; ?>
								</option>
							<?php
							endforeach;
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo ('Phụ huynh'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="pname" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
					</div>
				</div>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo ('Giới tính phụ huynh'); ?></label>
					<div class="col-sm-5">
						<select name="psex" class="form-control">
							<option value="male">Nam</option>
							<option value="female">Nữ</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo ('Email'); ?></label>
					<div class="col-sm-5">
						<input type="email" class="form-control" name="pemail" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo ('SDT'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="phone" value="">
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo ('Địa chỉ'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="paddress" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
					</div>
				</div> -->
				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo ('Password'); ?></label>

					<div class="col-sm-5">
						<input type="password" class="form-control" name="ppassword" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo ('Nghề nghiệp'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="profession" value="">
					</div>
				</div>
		
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo ('Photo'); ?></label>

					<div class="col-sm-5">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
								<img src="http://placehold.it/200x200" alt="...">
							</div>
							<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
							<div>
								<span class="btn btn-white btn-file">
									<span class="fileinput-new">Chọn ảnh</span>
									<span class="fileinput-exists">Thay đổi</span>
									<input type="file" name="userfile" accept="image/*">
								</span>
								<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Xóa</a>
							</div>
						</div>
					</div>
				</div>
				<?php
				$parent_id = $_POST['parent_id'];
				echo $parent_id;
				?>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-info"><?php echo ('Thêm học sinh'); ?></button>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function get_class_sections(class_id) {

		$.ajax({
			url: '<?php echo base_url(); ?>index.php?admin/get_class_section/' + class_id,
			success: function(response) {
				jQuery('#section_selector_holder').html(response);
			}
		});

	}
</script>