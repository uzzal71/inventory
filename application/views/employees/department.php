  <div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
      <h1>Department</h1>
    </section>

    <?php
    $exception = $this->session->userdata('exception');
    if(isset($exception))
    {
    echo $exception;
    $this->session->unset_userdata('exception');
    } ?>

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Department List</h3>
        </div>
        <div class="box-body">
          <div id="table-content">
            <table id="datatable" class="table table-responsive table-bordered table-hover">
              <thead>
                <tr>
                  <th style="width: 5%;">#SN.</th>
                  <th>Department</th>
                  <th style="width: 17%;">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>#SN.</th>
                  <th>Department</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                $i = 0;
                foreach ($dept as $key => $value) {
                $i++;
                ?>
                <tr class="gradeX">
                  <td><?php echo $i; ?></td>
                  <td><?php echo $value['dept_name']; ?></td>       
                  <td>
                    <button type="button" class="btn btn-primary btn-sm dept_edit" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="<?php echo $value['dpt_id']; ?>" onclick="document.getElementById('dept_edit').style.display='block'" ><i class="fa fa-edit"></i></button>
                    <a class=" btn btn-danger btn-sm" href="<?php echo site_url('employee/delete_dept').'/'.$value['dpt_id'] ?>" ><i class="fa fa-trash"></i></a>
                  </td>
                </tr>   
                <?php } ?> 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Department</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="<?php echo site_url("Employee/save_department") ?>">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <div class="col-md-5 col-sm-5 col-xs-12">
                <label>Department Name * :</label>
              </div>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" name="department" class="form-control" placeholder="Department Name" required >
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;" >
              <div class="form-group">
                <div class="col-md-9 col-md-offset-4">
                  <button type="submit"class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="dept_edit" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Department Information</h4>
          </div>
          <form action="<?php echo base_url('Employee/update_dept');?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="col-md-12 form-group">
                <label>Department Name *</label>
                <input type="text" class="form-control" name="department" id="department" required >
              </div>
            </div>
            <input type="hidden" id="dept_id" name="dept_id" >
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
        $(".dept_edit").click(function () {
          var catid = $(this).data('id');
//alert(l_id);
          $('input[name="dept_id"]').val(catid);
        });

        $('.dept_edit').click(function() {
          var id = $(this).data('id');
    //alert(id);
          var url = '<?php echo base_url() ?>Employee/get_dept_data';
    //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
    //alert(data);
              var HTML = data["dept_name"];
    //alert(HTML);
              $("#department").val(HTML);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>