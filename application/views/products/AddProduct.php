<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Product</h1>
    </section>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Product Information</h3>
        </div>
        <div class="box-body">
            <form method="POST" autocomplete="off" action="<?php echo base_url() ?>Product/save_product" enctype="multipart/form-data" >
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
        text-decoration: line-through;
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
            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" required="">
          </div>
          <div class="form-group col-md-12 col-sm-12 col-xs-12" >
             <div style="margin-left: -15px;">
                  <label>Status</label>
              <div>
                <input type="radio" name="category_status" id="category_status" value="Active" checked="checked" >&nbsp;Active&nbsp;&nbsp;
                <input type="radio" name="category_status" id="category_status" value="Inactive" >&nbsp;Inactive
              </div>
             </div>
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
            <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Brand Name" required="">
          </div>
         <div class="form-group col-md-12 col-sm-12 col-xs-12" >
             <div style="margin-left: -15px;">
                  <label>Status</label>
              <div>
                <input type="radio" name="brand_status" id="brand_status" value="Active" checked="checked" >&nbsp;Active&nbsp;&nbsp;
                <input type="radio" name="brand_status" id="brand_status" value="Inactive" >&nbsp;Inactive
              </div>
             </div>
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

<!--  -->
<div id="unitModal" class="modal fade" role="dialog">
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
            <label for="unit_name">Unit Name:</label>
            <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name" required>
          </div>
           <div class="form-group">
            <label for="unit_code">Unit Code:</label>
            <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Unit Code" required>
          </div>
         <div class="form-group col-md-12 col-sm-12 col-xs-12" >
             <div style="margin-left: -15px;">
                  <label>Status</label>
              <div>
                <input type="radio" name="unit_status" id="unit_status" value="Active" checked="checked" >&nbsp;Active&nbsp;&nbsp;
                <input type="radio" name="unit_status" id="unit_status" value="Inactive" >&nbsp;Inactive
              </div>
             </div>
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
<!--  -->
<!--
<div id="unitModal" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Unit</h4>
      </div>
      <div class="modal-body">
        <form action="#" autocomplete="off">
          <div class="form-group">
            <label for="unit_name">Unit Name:</label>
            <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name" required>
          </div>
           <div class="form-group">
            <label for="unit_code">Unit Code:</label>
            <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Unit Code" required>
          </div>
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
-->
<script type="text/javascript">
   $(document).ready(function() {
        $('#add_category').click(function() {        
            var category_name = $('#category_name').val();
            var status = $('#category_status').val();
            var base_url = '<?php echo base_url() ?>'+'Product/add_cateogry';
            if(category_name != ''){
            $.ajax({
                type: 'POST',
                url: base_url,
                data: {'category_name': category_name, 'status': status},
                success: function (data) {                
                    $('#ajax_load_category').append(data);
                    $('#category_hide').remove();
                    $('#category_name').val('');
                }
            });
            }else {
                alert("Category name not empty!");
                $('#category_name').val('');
             }
        });

        /** add brand **/
        $('#add_brand').click(function() {        
            var brand_name = $('#brand_name').val();
            var status = $('#brand_status').val();
            var base_url = '<?php echo base_url() ?>'+'Product/add_brand';
            if(brand_name != ''){
            $.ajax({
                type: 'POST',
                url: base_url,
                data: {'brand_name': brand_name, 'status': status},
                success: function (data) {              
                    $('#ajax_load_brand').append(data);
                    $('#brand_hide').remove();
                    $('#brand_name').val('');
                }
            });
            }else {
                alert("Brand name not empty!");
                $('#brand_name').val('');
            }
        });
        
        /** **/
        $('#add_unit').click(function() {        
            var unit_name = $('#unit_name').val();
            var unit_code = $('#unit_code').val();
            var status = $('#unit_status').val();
            var base_url = '<?php echo base_url() ?>'+'Product/add_unit';
            if(unit_name != ''&& unit_code != ''){
            $.ajax({
                type: 'POST',
                url: base_url,
                data: {'unit_name': unit_name, 'unit_code': unit_code, 'status': status},
                success: function (data) {               
                    $('#ajax_load_unit').append(data);
                    $('#unit_hide').remove();
                    $('#unit_name').val('');
                    $('#unit_code').val('');
                }
            });
            }else{
                alert("Unit name and code not empty!");
                $('#unit_name').val('');
                $('#unit_code').val('');
            }
        });
    });
</script>