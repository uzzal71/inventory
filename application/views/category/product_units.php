  <div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
      <h1>Units</h1>
    </section>

    <?php
    $exception = $this->session->userdata('exception');
    if(isset($exception))
    {
    echo $exception;
    $this->session->unset_userdata('exception');
    } ?>

    <div class="row">
      <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Units List</h3>
          </div>
    
          <div class="box-body">
            <div id="table-content ">
              <table id="datatable" class="table table-responsive table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#SN.</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>#SN.</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  $i = 0;
                  foreach ($unit as $value) {
                  $i++;
                  ?>
                  <tr class="gradeX">      
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['code']; ?></td>
                    <td><?php echo $value['status']; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($value['regdate']))?></td>
                    <td>
                      <button type="button" class="btn btn-success btn-sm unit_edit" data-toggle="modal" data-target=".bs-example-modal-unit_edit" data-id="<?php echo $value['id']; ?>" onclick="document.getElementById('unit_edit').style.display='block'" ><i class="fa fa-edit"></i></button>
                      <a class="btn btn-danger btn-sm" href="<?php echo site_url('Category/delete_units').'/'.$value['id']; ?>" ><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>   
                  <?php } ?> 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Units Information</h3>
          </div>
          <div class="box-body">
            <form method="POST" action="<?php echo base_url() ?>Category/save_units">
              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label>Units Name *</label>
                <input type="text" class="form-control" name="unitName" placeholder="Units Name" required >
              </div>
              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label>Units Code</label>
                <input type="text" class="form-control" name="unitCode" placeholder="Units Code" >
              </div>
              <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                <label>Status</label>
                <div>
                  <input type="radio" name="status" value="Active" checked="checked" >&nbsp;Active&nbsp;&nbsp;
                  <input type="radio" name="status" value="Inactive" >&nbsp;Inactive
                </div>
              </div>
              <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                <div class="col-md-9 col-md-offset-4">
                  <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>


    <div id="unit_edit" class="modal fade bs-example-modal-unit_edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Update Units Information</h4>
          </div>
          <form action="<?php echo base_url('Category/update_units');?>" method="post">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <label>Unit Name *</label>
              <input type="text" class="form-control" name="unitName" id="unitName" required >
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <label>Units Code</label>
              <input type="text" class="form-control" name="unitCode" id="unitCode" >
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <label>Status</label>
              <select class="form-control" name="status" id="status" >
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
              </select>
            </div>
            <input type="hidden" id="unit_id" name="unit_id" >
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <script type="text/javascript">
      $(document).ready(function(){
        $(".unit_edit").click(function () {
          var catid = $(this).data('id');
//alert(l_id);
          $('input[name="unit_id"]').val(catid);
        });

        $('.unit_edit').click(function() {
          var id = $(this).data('id');
    //alert(id);
          var url = '<?php echo base_url() ?>Category/get_unit_data';
    //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
    //alert(data);
              var HTML = data["name"];
              var HTML2 = data["code"];
              var HTML3 = data["status"];
    //alert(HTML);
              $("#unitName").val(HTML);
              $("#unitCode").val(HTML2);
              $("#status").val(HTML3);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>