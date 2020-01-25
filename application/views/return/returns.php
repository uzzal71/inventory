<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Returns</h1>
    </section>

    <?php
    $exception = $this->session->userdata('exception');
    if(isset($exception))
    {
    echo $exception;
    $this->session->unset_userdata('exception');
    } ?>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"> Return List</h3>
            <a href="<?php echo site_url('Returns/new_return') ?>" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i> New Return</a>
        </div>

        <div class="box-body">
            <div id="content-table-inner">
                <div id="table-content">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#SN.</th>
                                <th>Date</th>
                                <th>Company</th>
                                <th>Salesman / Employee</th>
                                <th>Customer</th>
                                <th>Total Price</th>
                                <th style="width: 12%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($return as $key => $value) {
                            $i++;
                            ?>
                            <tr class="gradeX" style="border: 1px solid #000;">
                                <td><?php echo $i; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($value['returnDate'])); ?></td>
                                <td><?php echo $value['companyName']; ?></td>
                                <td><?php echo $value['employeeName']; ?></td>
                                <td><?php echo $value['customerName']; ?></td>
                                <td><?php echo number_format($value['totalPrice'], 2); ?></td>
                                <td>
                                    <a class=" btn btn-info btn-sm" href="<?php echo site_url('Returns/viewReturns').'/'.$value['returnId'] ?>"><i class="fa fa-eye"></i></a>
                                    <a class=" btn btn-success btn-sm" href="<?php echo site_url('Returns/editReturns').'/'.$value['returnId'] ?>"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo site_url('Returns/deleteReturns').'/'.$value['returnId'] ?>" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>   
                            <?php } ?> 
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#SN.</th>
                                <th>Date</th>
                                <th>Company</th>
                                <th>Salesman / Employee</th>
                                <th>Customer</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
