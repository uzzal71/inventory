<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Sales</h1>
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
            <h3 class="box-title">Sales List</h3>
            <a href="<?php echo site_url('Sale/newSale') ?>" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i> New Sale</a>
        </div>

        <div class="box-body">
            <div id="table-content">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#SN.</th>
                            <th>Date</th>
                            <th>Company</th>
                            <th>Customer</th>
                            <th>Employee</th>
                            <th>Total Price</th>            
                            <th>Paid Amount</th>
                            <th>Due Amount</th>
                            <th style="width: 12%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($sales as $key => $value) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value['saleDate'])) ?></td>
                            <td><?php echo $value['companyName'] ?></td>
                            <td><?php echo $value['customerName'] ?></td>
                            <td><?php echo $value['employeeName'] ?></td>
                            <td><?php echo number_format($value['totalAmount'], 2) ?></td>
                            <td><?php echo number_format($value['paidAmount'], 2) ?></td>
                            <td><?php echo number_format(($value['totalAmount']-$value['paidAmount']), 2) ?></td>
                            <td>
                                <a class=" btn btn-info btn-sm" href="<?php echo site_url('Sale/view_invoice').'/'.$value['saleID'] ?>"><i class="fa fa-eye"></i></a>
                                <a class=" btn btn-success btn-sm" href="<?php echo site_url('Sale/editSale').'/'.$value['saleID'] ?>"><i class="fa fa-edit"> </i></a>
                                <a href="<?php echo site_url('Sale/delete_sales').'/'.$value['saleID'] ?>" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>   
                        <?php } ?> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#SN.</th>
                            <th>Date</th>
                            <th>Company</th>
                            <th>Customer</th>
                            <th>Employee</th>
                            <th>Total Price</th>            
                            <th>Paid Amount</th>
                            <th>Due Amount</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>