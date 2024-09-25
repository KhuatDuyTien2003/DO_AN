<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo ('Học phí');?>
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
                                <div><?php echo ('Mô tả');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Học phí');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Trạng thái');?></div>
                            </th>
                            <th>
                                <div><?php echo ('Ngầy');?></div>
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
                            <td><?php echo $row['description'];?></td>
                            <td><?php echo $row['amount'];?></td>
                            <td>
                                <span
                                    class="label label-<?php if($row['status']=='paid')echo 'success';else echo 'secondary';?>"><?php echo $row['status'];?></span>
                            </td>
                            <td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
                            <td>
                                <?php echo form_open('student/invoice/make_payment');?>
                                <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id'];?>" />
                                <button type="submit" class="btn btn-info"><i class="entypo-paypal"></i> Thanh toán bằng
                                    thẻ
                                </button>
                                </form>


                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->




        </div>
    </div>
</div>