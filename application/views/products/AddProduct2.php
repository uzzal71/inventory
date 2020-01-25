<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Product</h1>
    </section>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Product Information</h3>
        </div>
        <div class="box-body">
            <form method="POST" action="<?php echo base_url() ?>Product/save_product" enctype="multipart/form-data" >
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Product Name *</label>
                    <input type="text" class="form-control" name="productName" placeholder="Product Name" required >
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Product Code</label>
                    <input type="text" class="form-control" name="productcode" placeholder="Product Code" >
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Warranty</label>
                    <input type="text" class="form-control" name="warranty" placeholder="Warranty" >
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-12" id="ajax_load_category">
                    <div id="category_hide">
                        <label>Category *</label>
                        <select name="categoryID" class="form-control" required >
                        <option value="">Select One</option>
                        <?php foreach($category as $value) { ?>
                        <option value="<?php echo $value['categoryID']; ?>"><?php echo $value['categoryName']; ?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
                <!-- modal button -->
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <button type="button" style="margin-top: 27px" data-toggle="modal" data-target="#categoryModal">+</button>
                </div>
                <!-- modal button -->
                <div class="form-group col-md-3 col-sm-3 col-xs-12" id="ajax_load_brand">
                    <div id="brand_hide">
                        <label>Brand Name</label>
                    <select name="bandname" class="form-control">
                        <option value="">Select One</option>
                        <?php  foreach($brand as $value) { ?>
                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
                <!-- modal button -->
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <button type="button" style="margin-top: 27px" data-toggle="modal" data-target="#brandModal">+</button>
                </div>
                <!-- modal button -->
                <div class="form-group col-md-3 col-sm-3 col-xs-12" id="ajax_load_unit">                     
                    <div id="unit_hide">
                        <label>Product Unit *</label>
                    <select name="units" class="form-control" required >
                        <option value="">Select One</option>
                        <?php  foreach($unit as $value) { ?>
                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                        <?php } ?>
                    </select>
                    </div>                  
                </div>
                <!-- modal button -->
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <button type="button" style="margin-top: 27px" data-toggle="modal" data-target="#unitModal">+</button>
                </div>
                <!-- modal button -->
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Buy Price *</label>
                    <input type="text" class="form-control" name="pprice" placeholder="Amount" required >
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Sale Price *</label>
                    <input type="text" class="form-control" name="sprice" placeholder="Amount" required >
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    <label>Product Image <small style="color: red;">Only Image</small></label>
                    <input type="file" name="userfile" >
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                    <div class="col-md-9 col-md-offset-4">  
                        <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Submit</button>
                        <a href="<?php echo site_url('Product') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style type="text/css">
    .hide {
        display: none;
    }
</style>
<!-- Category Modal -->
<div id="categoryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        <form action="#" autocomplete="off">
          <div class="form-group">
            <label for="category_name">Category Name:</label>
            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name">
          </div>
          <div class="form-group">
            <label for="category_status">Status:</label>
            <select id="category_status" class="form-control" required>
                <option value="0">Select Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>   
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" id="add_category" class="btn btn-success" data-dismiss="modal">Submit</button>
      </div>
    </div>

  </div>
</div>

<!-- Brand Modal -->
<div id="brandModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Brand</h4>
      </div>
      <div class="modal-body">
        <form action="#" autocomplete="off">
          <div class="form-group">
            <label for="brand_name">Brand Name:</label>
            <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Brand Name">
          </div>
          <div class="form-group">
            <label for="brand_status">Status:</label>
            <select id="brand_status" class="form-control" required>
                <option value="0">Select Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>   
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="add_brand" data-dismiss="modal">Submit</button>
      </div>
    </div>

  </div>
</div>

<!-- Brand Modal -->
<div id="unitModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Unit</h4>
      </div>
      <div class="modal-body">
        <form action="#" autocomplete="off">
          <div class="form-group">
            <label for="unit_name">Unit Name:</label>
            <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name">
          </div>
           <div class="form-group">
            <label for="unit_code">Unit Code:</label>
            <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Unit Code">
          </div>
          <div class="form-group">
            <label for="unit_status">Status:</label>
            <select id="unit_status" class="form-control" required>
                <option value="0">Select Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>   
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="add_unit" data-dismiss="modal">Submit</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
   $(document).ready(function() {
        $('#add_category').click(function() {        
            var category_name = $('#category_name').val();
            var status = $('#category_status').val();
            var base_url = '<?php echo base_url() ?>'+'Product/add_cateogry';
            $.ajax({
                type: 'POST',
                url: base_url,
                data: {'category_name': category_name, 'status': status},
                success: function (data) {                
                    $('#ajax_load_category').append(data);
                     var element = document.getElementById("category_hide");
                        element.classList.add("hide");
                }
            });
        });

        /** add brand **/
        $('#add_brand').click(function() {        
            var brand_name = $('#brand_name').val();
            var status = $('#brand_status').val();
            var base_url = '<?php echo base_url() ?>'+'Product/add_brand';
            $.ajax({
                type: 'POST',
                url: base_url,
                data: {'brand_name': brand_name, 'status': status},
                success: function (data) {              
                    $('#ajax_load_brand').append(data);
                     var element = document.getElementById("brand_hide");
                        element.classList.add("hide");
                }
            });
        });
        
        /** **/
        $('#add_unit').click(function() {        
            var unit_name = $('#unit_name').val();
            var unit_code = $('#unit_code').val();
            var status = $('#unit_status').val();
            var base_url = '<?php echo base_url() ?>'+'Product/add_unit';
            $.ajax({
                type: 'POST',
                url: base_url,
                data: {'unit_name': unit_name, 'unit_code': unit_code, 'status': status},
                success: function (data) {               
                    $('#ajax_load_unit').append(data);
                     var element = document.getElementById("unit_hide");
                        element.classList.add("hide");
                }
            });
        });
    });
</script>