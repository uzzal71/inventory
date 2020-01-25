<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Purchase</h1>
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
            <h3 class="box-title">Purchase List</h3>
            <a href="<?php echo site_url('Purchase/newPurchase') ?>" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i> New Purchase</a>
        </div>

        <div class="box-body">
            <div id="table-content">
                <table id="datatable" class="dataTable table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#SN.</th>
                            <th>Challan No</th>
                            <th>Purchase Date</th>
                            <th>Supplier</th>
                            <th>Total Price</th>
                            <th>Paid Amount</th>
                            <th>Due Amount</th>
                            <th style="width: 12%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($purchase as $value){
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value['challanNo'] ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value['purchaseDate'])) ?></td>
                            <td><?php echo $value['supplierName'] ?></td>
                            <td><?php echo number_format($value['totalPrice'], 2) ?></td>
                            <td><?php echo number_format($value['paidAmount'], 2) ?></td>
                            <td><?php echo number_format(($value['totalPrice']-$value['paidAmount']), 2); ?></td>
                            <td>
                                <a href="<?php echo site_url('Purchase/viewPurchase').'/'.$value['purchaseID'] ?>" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></a>
                                <a href="<?php echo site_url('Purchase/edit_purchases').'/'.$value['purchaseID'] ?>" class="btn btn-success btn-sm" ><i class="fa fa-edit"></i></a> 
                                <a href="<?php echo site_url('Purchase/delete_purchases').'/'.$value['purchaseID'] ?>" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <script type="text/javascript">
        $('#example').dataTable( {
        drawCallback: function() {
   var api = this.api();

   // Total over all pages
   var total = api.column(6).data().sum();

   // Total over this page
   var pageTotal = api.column(6, {page:'current'}).data().sum();

   $(api.column(6).footer()).html('$' + pageTotal + ' ( $' + total + ' total)');
        }
    });
    </script>