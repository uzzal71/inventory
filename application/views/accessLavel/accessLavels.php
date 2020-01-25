  <div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
      <h1>User Role</h1>
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
            <h3 class="box-title">User Role List</h3>
          </div>
          <div class="box-body">
            <div id="table-content">
              <table id="datatable" class="table table-responsive table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#SN.</th>
                    <th>User Role</th>
                    <th>Discription</th>
                    <th>Staus</th>
                    <th style="width: 13%;">Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>#SN.</th>
                    <th>User Role</th>
                    <th>Discription</th>
                    <th>Staus</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  $i = 0;
                  foreach ($role as $key => $value) {
                  $i++;
                  ?>
                  <tr class="gradeX">      
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value['lavelName']; ?></td>
                    <td><?php echo $value['lavelDiscription']; ?></td>
                    <td><?php echo $value['status']; ?></td>
                    <td>
                      <button type="button" class="btn btn-primary btn-sm urole_edit" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="<?php echo $value['accessLavelId']; ?>" onclick="document.getElementById('urole_edit').style.display='block'" ><i class="fa fa-edit"></i></button>
                      <a class=" btn btn-danger btn-sm" href="<?php echo site_url('accessLavels/delete_user_role').'/'.$value['accessLavelId']?>" ><i class="fa fa-trash"></i></a>
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
            <h3 class="box-title">User Role Information</h3>
          </div>
          <div class="box-body">
            <form method="post" action="<?php echo base_url() ?>AccessLavels/SaveAccessLavel">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label>User Role Name *</label>
                  <input type="text" class="form-control" name="lavelName" required placeholder="Role Name" >
                </div>
                <div class="form-group">
                  <label>Role Discription</label>
                  <textarea type="text" class="form-control" name="lavelDiscription" placeholder="Role Discription" ></textarea>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <div>
                    <input type="radio" name="status" value="Active" checked="cheched" >&nbsp;Active&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="status" value="Inactive" >&nbsp;Inactive
                  </div>
                </div>
              </div>
              <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                <div class="col-md-9 col-md-offset-4">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="urole_edit" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel2">User Role Information</h4>
          </div>
          <form action="<?php echo base_url('accessLavels/update_user_role');?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Role Name *</label>
                <input type="text" class="form-control" name="lavelName" id="lavelName" required >
              </div>
              <div class="form-group">
                <label>Role Discription</label>
                <textarea type="text" class="form-control" name="lavelDiscription" id="lavelDiscription" ></textarea>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" id="status" >
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
            <input type="hidden" id="catid" name="roleid" >
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>


    <script type="text/javascript">
      $(document).ready(function(){
        $(".urole_edit").click(function () {
          var catid = $(this).data('id');
//alert(l_id);
          $('input[name="roleid"]').val(catid);
        });

        $('.urole_edit').click(function() {
          var id = $(this).data('id');
    //alert(id);
          var url = '<?php echo base_url() ?>AccessLavels/get_user_role_data';
    //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
    //alert(data);
              var HTML = data["lavelName"];
              var HTML2 = data["lavelDiscription"];
              var HTML3 = data["status"];
    //alert(HTML);
              $("#lavelName").val(HTML);
              $("#lavelDiscription").val(HTML2);
              $("#status").val(HTML3);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>