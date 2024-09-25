<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo ('Danh sách tài liệu');?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo ('Thêm tài liệu');?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>


        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0"
                    class="table table-bordered table-hover table-striped datatable" id="table_export">
                    <thead>
                        <tr>
                            <th>
                                <div>#</div>
                            </th>
                            <th>
                                <div><?php echo ('Tên Tài Liệu');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Tác giả');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Mô tả');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Giá');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Lớp');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Trạng thái');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Lựa chọn');?></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;foreach($books as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['author'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td><?php echo $row['price'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
                            <td><span
                                    class="label label-<?php if($row['status']=='available')echo 'success';else echo 'secondary';?>"><?php echo $row['status'];?></span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        Hoạt động <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        <!-- EDITING LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_book/<?php echo $row['book_id'];?>');">
                                                <i class="entypo-pencil"></i>
                                                <?php echo ('Sửa');?>
                                            </a>
                                        </li>
                                        <li class="divider"></li>

                                        <!-- DELETION LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="confirm_modal('<?php echo base_url();?>index.php?admin/book/delete/<?php echo $row['book_id'];?>');">
                                                <i class="entypo-trash"></i>
                                                <?php echo ('Xóa');?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?admin/book/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Tên Tài liệu');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Tác giả');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="author" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Mô tả');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="description" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Giá');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="price" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Lớp');?></label>
                        <div class="col-sm-5">
                            <select name="class_id" class="form-control" style="width:100%;">
                                <?php 
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
										?>
                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                <?php
										endforeach;
										?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ('Trạng thái');?></label>
                        <div class="col-sm-5">
                            <select name="status" class="form-control" style="width:100%;">
                                <option value="available"><?php echo ('Còn tài liệu');?></option>
                                <option value="unavailable"><?php echo ('Hết tài liệu');?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo ('Thêm tài liệu');?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!----CREATION FORM ENDS--->

        </div>
    </div>
</div>