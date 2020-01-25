<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Product</h1>
    </section>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Update Product Information</h3>
        </div>
        <div class="box-body">
            <form method="POST" action="<?php echo base_url() ?>Product/update_product" enctype="multipart/form-data" >
            	<input type="hidden" class="form-control" name="productid" value="<?php echo $product['productID']; ?>" >
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Product Name *</label>
                    <input type="text" class="form-control" name="productName" value="<?php echo $product['productName']; ?>" required >
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Product Code</label>
                    <input type="text" class="form-control" name="productcode" value="<?php echo $product['productcode']; ?>" >
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Warranty</label>
                    <input type="text" class="form-control" name="warranty" value="<?php echo $product['warranty']; ?>" >
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Category *</label>
                    <select name="categoryID" class="form-control" required >
                        <option value="">Select One</option>
                        <?php foreach($category as $value) { ?>
                        <option <?php echo ($product['categoryID'] == $value['categoryID'])?'selected':''?> value="<?php echo $value['categoryID']; ?>"><?php echo $value['categoryName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Brand Name</label>
                    <select name="bandname" class="form-control">
                        <option value="">Select One</option>
                        <?php foreach($brand as $value) { ?>
                        <option <?php echo ($product['brand'] == $value['id'])?'selected':''?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Product Unit *</label>
                    <select name="units" class="form-control" required >
                        <option value="">Select One</option>
                        <?php foreach($unit as $value) { ?>
                        <option <?php echo ($product['units'] == $value['id'])?'selected':''?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Buy Price *</label>
                    <input type="text" class="form-control" name="pprice" value="<?php echo $product['pprice']; ?>" required >
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Sell Price *</label>
                    <input type="text" class="form-control" name="sprice" value="<?php echo $product['sprice']; ?>" required >
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Product Image <small style="color: red;">Only Image</small></label>
                    <input type="file" name="userfile" >
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                    <div class="col-md-9 col-md-offset-4">  
                        <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Update</button>
                        <a href="<?php echo site_url('Product') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>