<?php 
$edit_data		=	$this->db->get_where('subject' , array('subject_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo ('Sửa môn học');?>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?teacher/subject/do_update/'.$row['subject_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Tên môn học');?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="subject_name"
                            value="<?php echo $row['subject_name'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Mã môn học');?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="subject_id"
                            value="<?php echo $row['subject_id'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Khối');?></label>
                    <div class="col-sm-5 controls">
                        <select name="class_id" class="form-control">
                            <?php 
                            $classes = $this->db->get('level')->result_array();
                            foreach($classes as $row2):
                            ?>
                            <option value="<?php echo $row2['level'];?>"
                                <?php if($row['level_id'] == $row2['level_id'])echo 'selected';?>>
                                <?php echo $row2['level'];?>
                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ('Chuyên môn');?></label>
                    <div class="col-sm-5 controls">
                        <select name="teacher_id" class="form-control">
                            <option value=""></option>
                            <?php 
                            $chuyenmon = $this->db->get('chuyenmon')->result_array();
                            foreach($chuyenmon as $row2):
                            ?>
                            <option value="<?php echo $row2['chuyenmon_id'];?>"
                                <?php if($row['chuyenmon_id'] == $row2['chuyenmon_id'])echo 'selected';?>>
                                <?php echo $row2['ten_mon'];?>
                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo ('Sửa môn');?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>