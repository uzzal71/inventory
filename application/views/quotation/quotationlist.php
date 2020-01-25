<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Quotation</h1>
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
            <h3 class="box-title">Quotation List</h3>
            <a href="<?php echo site_url('Quotation/new_quotation') ?>" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i> Add New Quotation</a>
        </div>
        <div class="box-body">
            <div id="table-content">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#SN.</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Products</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th style="width: 12%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($quotation as $value) {
                        $id = $value['qutid'];
                        $i++;
                        $pp = $this->db->select('
                                            quotation_product.qutid,
                                            quotation_product.productID,
                                            quotation_product.salePrice,
                                            quotation_product.quantity,
                                            products.productID,
                                            products.productName,
                                            products.productcode')
                                        ->from('quotation_product')
                                        ->join('products','products.productID = quotation_product.productID','left')
                                        ->where('qutid',$value['qutid'])
                                        ->get()
                                        ->result();
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($value['quotationDate'])) ?></td>
                            <td><?php echo $value['customerName']; ?></td>
                            <td>
                                <table>
                                    <?php foreach ($pp as $p) { ?>
                                    <tr>
                                        <td><?php echo $p->productName.'-'.$p->productcode; ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <?php foreach ($pp as $p) { ?>
                                    <tr>
                                        <td><?php echo $p->quantity; ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <?php foreach ($pp as $p) { ?>
                                    <tr>
                                        <td><?php echo number_format($p->salePrice, 2); ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </td>
                            <td><?php echo number_format($value['totalPrice'], 2) ?></td>
                            <td>
                                <a href="<?php echo site_url('Quotation/view_quotation').'/'.$id ?>" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></a>
                                <a href="<?php echo site_url('Quotation/edit_quotation').'/'.$id ?>" class="btn btn-success btn-sm" ><i class="fa fa-edit"></i></a> 
                                <a href="<?php echo site_url('Quotation/delete_quotation').'/'.$id ?>" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#SN.</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Products</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>