<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Designation</h1>
    </section>

    <?php
    $exception = $this->session->userdata('exception');
    if(isset($exception))
    {
    echo $exception;
    $this->session->unset_userdata('exception');
    } ?>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Designation List</h3>
                </div>
                <div class="box-body">
                    <div id="table-content">
                        <table id="datatable" class="table table-responsive table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#SN.</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th style="width: 13%;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#SN.</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($dsg as $key => $value) {
                                $i++;
                                ?>
                                <tr class="gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value['dept_name']; ?></td>
                                    <td><?php echo $value['desg_name']; ?></td>        
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm dsg_edit" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="<?php echo $value['desg_id']; ?>" onclick="document.getElementById('dept_edit').style.display='block'" ><i class="fa fa-edit"></i></button>
                                        <a class=" btn btn-danger btn-sm" href="<?php echo site_url('employee/delete_designation').'/'.$value['desg_id']; ?>" ><i class="fa fa-trash"></i></a>
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
                    <h3 class="box-title">Add Designation</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="<?php echo site_url("Employee/save_designation") ?>">
                        <div class="form-group">
                            <label>Department *</label>
                            <select class="form-control" name="dpt_id" required>
                                <option value="">Select Department</option>
                                <?php foreach($dept as $value):?>
                                <option value="<?php echo $value['dpt_id']; ?>"><?php echo $value['dept_name']; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Designation *</label>
                            <input type="text" name="designation" class="form-control" placeholder="Designation Name" required >
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
    </div>

    <div id="dsg_edit" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Designation Information</h4>
              </div>
              <form action="<?php echo base_url('Employee/update_desg');?>" method="post">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label>Department *</label>
                    <select class="form-control" name="dpt_id" id="department" required readonly >
                       <!--  <?php foreach($dept as $value):?>
                        <option value="<?php echo $value['dpt_id']; ?>"><?php echo $value['department_name']; ?></option>
                        <?php endforeach;?> -->
                    </select>
                    <!-- <input type="hidden" name="dpt_id" class="form-control" id="dpt_id" > -->
                </div>
                <div class="form-group">
                    <label>Designation *</label>
                    <input type="text" name="designation" class="form-control" id="designation" required >
                </div>
              </div>
              <input type="hidden" id="desg_id" name="desg_id" >
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
        $(".dsg_edit").click(function () {
          var catid = $(this).data('id');
//alert(l_id);
          $('input[name="desg_id"]').val(catid);
        });

        $('.dsg_edit').click(function() {
          var id = $(this).data('id');
    //alert(id);
          var url = '<?php echo base_url() ?>Employee/get_desg_data';
    //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
    //alert(data);
              var HTML = data["desg_name"];
              var HTML2 = data["dpt_id"];
              var HTML3 = "<option value='"+data["dpt_id"]+"'>" + data["dept_name"]+"</option>"
              //var HTML3 = data["department_name"];
    //alert(HTML3);
              $("#designation").val(HTML);
              $("#dpt_id").val(HTML2);
              $("#department").html(HTML3);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>