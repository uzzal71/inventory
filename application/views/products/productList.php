<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Product</h1>
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
            <h3 class="box-title">Product List</h3>
            <a href="<?php echo site_url('Product/NewProduct') ?>" class="btn btn-primary" style="float: right" ><i class="fa fa-plus"></i>  Add New Product</a>
        </div>
        <div class="box-body">
            <div id="table-content">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#SN.</th>
                            <th>Image</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Units</th>
                            <th>Purchase Price</th>
                            <th>Sale Price</th>
                            <th style="width: 9%;">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#SN.</th>
                            <th>Image</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Units</th>
                            <th>Purchase Price</th>
                            <th>Sale Price</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($product as $key => $value) {
                        $i++;
                        ?>
                        <tr class="gradeX">
                            <td><?php echo $i; ?></td>
                            <td>
                                <?php if($value['image'] == null) { ?>
                                <i class="fa fa-shopping-cart fa-4x" aria-hidden="true" ></i>
                                <?php } else{ ?> 
                                <img src="<?php echo base_url().'/upload/product/'.$value['image']; ?>" style="width: 50px; height: 50px;">
                                <?php } ?> 
                            </td>
                            <td><?php echo $value['productcode'] ?></td>
                            <td><?php echo $value['productName'] ?></td>
                            <td><?php echo $value['categoryName'] ?></td>
                            <td><?php echo $value['name'] ?></td>              
                            <td><?php echo number_format($value['pprice'], 2) ?></td>
                            <td><?php echo number_format($value['sprice'], 2) ?></td>
                            <td>
                                <a href="<?php echo site_url('Product/edit_products').'/'.$value['productID'] ?>" class="btn btn-primary" ><i class="fa fa-edit"></i></a>
                                <a href="<?php echo site_url('Product/delete_products').'/'.$value['productID'] ?>" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>   
                        <?php } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>