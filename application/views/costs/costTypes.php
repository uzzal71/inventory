  <div class="content-wrapper" style="min-height: 1126px;">    
    <section class="content-header">
      <h1>Expense Type</h1>
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
            <h3 class="box-title">Expense Type List</h3>
          </div>
          <div class="box-body">
            <div id="table-content ">
              <table id="datatable" class="table table-responsive table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#SN.</th>
                    <th>Cost Type Name</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th style="width: 12%;">Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>#SN.</th>
                    <th>Cost Type Name</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  $i = 0;
                  foreach ($cost as $key => $value) {
                  $i++;
                  ?>
                  <tr class="gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value['costName']; ?></td>
                    <td><?php echo $value['status']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($value['regdate'])); ?></td>
                    <td>
                      <button type="button" class="btn btn-success btn-sm cost_edit" data-toggle="modal" data-target=".bs-example-modal-cost_edit" data-id="<?php echo $value['costTypeId']; ?>" onclick="document.getElementById('cost_edit').style.display='block'" ><i class="fa fa-edit"></i></button>
                      <a class="btn btn-danger btn-sm" href="<?php echo site_url('Cost/cost_type_delete').'/'.$value['costTypeId'] ?>" ><i class="fa fa-trash"></i></a></td>
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
            <h3 class="box-title">Expense Type Info.</h3>
          </div>
          <div class="box-body">
            <form method="POST" action="<?php echo base_url() ?>Cost/save_expense_type">
              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label>Expense Type Name *</label>
                <input type="text" class="form-control" name="expensetName" placeholder="Expense Type Name" required >
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

    <div id="cost_edit" class="modal fade bs-example-modal-cost_edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Expense Type Information</h4>
          </div>
          <form action="<?php echo base_url('Cost/update_cost_type');?>" method="post">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <label>Expense Type Name *</label>
              <input type="text" class="form-control" name="expensetName" id="expensetName" required >
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <label>Status</label>
              <select class="form-control" name="status" id="status" >
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
            <input type="hidden" id="cat_id" name="cat_id" >
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
        $(".cost_edit").click(function () {
          var catid = $(this).data('id');
//alert(l_id);
          $('input[name="cat_id"]').val(catid);
        });

        $('.cost_edit').click(function() {
          var id = $(this).data('id');
    //alert(id);
          var url = '<?php echo base_url() ?>Cost/get_Cost_Type_data';
    //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
    //alert(data);
              var HTML = data["costName"];
              var HTML2 = data["status"];
    //alert(HTML);
              $("#expensetName").val(HTML);
              $("#status").val(HTML2);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>
