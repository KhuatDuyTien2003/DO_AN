<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo ('Danh sách hóa đơn');?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo ('Thêm hóa đơn');?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered table-hover table-striped datatable" id="table_export">
                    <thead>
                        <tr>
                            <th>
                                <div><?php echo ('Học sinh');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Tiêu đề');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Tổng tiền');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Thanh toán');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Trạng thái');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Ngày');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Lựa chọn');?></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($invoices as $row):?>
                        <tr>
                            <td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
                            <td><?php echo $row['title'];?></td>
                            <td><?php echo $row['amount'];?></td>
                            <td><?php echo $row['amount_paid'];?></td>
                            <td>
                                <span
                                    class="label label-<?php if($row['status']=='paid')echo 'success';else echo 'secondary';?>"><?php echo $row['status'];?></span>
                            </td>
                            <td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        <?php if ($row['due'] != 0):?>

                                        <li>
                                            <a href="#"
                                                onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_take_payment/<?php echo $row['invoice_id'];?>');">
                                                <i class="entypo-bookmarks"></i>
                                                <?php echo ('Thanh toán');?>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <?php endif;?>

                                        <!-- VIEWING LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');">
                                                <i class="entypo-credit-card"></i>
                                                <?php echo ('Xem hóa đơn');?>
                                            </a>
                                        </li>
                                        <li class="divider"></li>

                                        <!-- EDITING LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');">
                                                <i class="entypo-pencil"></i>
                                                <?php echo ('Sửa');?>
                                            </a>
                                        </li>
                                        <li class="divider"></li>

                                        <!-- DELETION LINK -->
                                        <li>
                                            <a href="#"
                                                onclick="confirm_modal('<?php echo base_url();?>index.php?admin/invoice/delete/<?php echo $row['invoice_id'];?>');">
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
                <?php echo form_open(base_url() . 'index.php?admin/invoice/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo ('Thông tin hóa đơn');?></div>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ('Học sinh');?></label>
                                    <div class="col-sm-9">
                                        <select name="student_id" class="form-control" style="">
                                            <?php 
                                            $this->db->order_by('class_id','asc');
                                            $students = $this->db->get('student')->result_array();
                                            foreach($students as $row):
                                            ?>
                                            <option value="<?php echo $row['student_id'];?>">
                                                class <?php echo $this->crud_model->get_class_name($row['class_id']);?>
                                                -
                                                roll <?php echo $row['roll'];?> -
                                                <?php echo $row['name'];?>
                                            </option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ('Tiêu đề');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="title" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ('Nội dung');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="description" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ('Ngày');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="datepicker form-control" name="date" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo ('Thông tin hóa đơn');?></div>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ('Tổng tiền');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount"
                                            placeholder="<?php echo ('Nhập tổng tiền');?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ('Thanh toán');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount_paid"
                                            placeholder="<?php echo ('Nhập số tiền thanh toán');?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ('Status');?></label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control">
                                            <option value="paid"><?php echo ('Đã thanh toán');?></option>
                                            <option value="unpaid"><?php echo ('Chưa thanh toán');?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ('Phương thức');?></label>
                                    <div class="col-sm-9">
                                        <select name="method" class="form-control">
                                            <option value="1"><?php echo ('Tiền mặt');?></option>

                                            <option value="3"><?php echo ('Thẻ');?></option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo ('Thêm hóa đơn');?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
            <!----CREATION FORM ENDS-->

        </div>
    </div>
</div>