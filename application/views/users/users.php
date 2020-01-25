<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Users List</h1>
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
            <h3 class="box-title">User List</h3>
            <button type="button" class="btn btn-primary add_user" data-toggle="modal" data-target=".bs-example-modal-auser" style="float: right" ><i class="fa fa-plus"></i> New User</button>
        </div>
        <div class="box-body">
            <div id="table-content ">
                <table id="datatable" class="table table-responsive table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#SN.</th>
                            <th>User Name</th>
                            <th>Employee Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th style="width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#SN.</th>
                            <th>User Name</th>
                            <th>Employee Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($users as $key => $value) {
                        $i++;
                        ?>
                        <tr class="gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value['user_name']; ?></td>
                            <td><?php echo $value['employeeName']; ?></td>
                            <td><?php echo $value['lavelName']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $value['phone']; ?></td>
                            <td><?php echo $value['status']; ?></td>        
                            <td>
                                <button type="button" class="btn btn-success btn-sm user_edit" data-toggle="modal" data-target=".bs-example-modal-euser" data-id="<?php echo $value['user_id']; ?>" onclick="document.getElementById('user_edit').style.display='block'" ><i class="fa fa-edit"></i></button>
                                <a class=" btn btn-danger btn-sm" href="<?php echo site_url('user/delete_user') . '/' . $value['user_id']; ?>" onclick="return confirm('Are you sure you want to delete this user ?');" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>   
                        <?php } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="add_user" class="modal fade bs-example-modal-auser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" >User Information</h4>
                </div>
                <form action="<?php echo base_url('User/SaveUser');?>" method="post">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>Select Employee * :</label>
                                <select class="form-control" name="emp" required >
                                    <option value="">Select One</option>
                                    <?php foreach ($emp as $value){ ?> 
                                    <option value="<?php echo $value->employeeID; ?>"><?php echo $value->employeeName; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>User Type * :</label>
                                <select class="form-control" name="utype" required >
                                    <option value="">Select One</option>
                                    <?php foreach ($accessLavels as $key => $accessLavel) { ?>
                                    <option value="<?php echo $accessLavel['accessLavelId']; ?>"><?php echo $accessLavel['lavelName']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>User Name * :</label>
                                <div>
                                    <div class="col-md-1 col-sm-1 col-xs-1" id="gname-status"></div>
                                    <div class="col-md-10 col-sm-10 col-xs-10" >
                                        <input type="text" class="form-control" name="uname" id="uname" placeholder="User Name" required >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>Password * :</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" required >
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>Status :</label>
                                <select class="form-control" name="status" >
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="user_edit" class="modal fade bs-example-modal-euser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" >Update User Information</h4>
                </div>
                <form action="<?php echo base_url('User/update_User');?>" method="post">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="">Employee * :</label>
                                <input type="hidden" class="form-control" name="emp" id="empid" required >
                                <input type="text" class="form-control" id="empname" readonly >
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>User Type * :</label>
                                <select class="form-control" name="utype" required >
                                    <option value="">Select One</option>
                                    <?php foreach ($accessLavels as $key => $accessLavel) { ?>
                                    <option value="<?php echo $accessLavel['accessLavelId']; ?>"><?php echo $accessLavel['lavelName']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="password" id="password" required >
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>User Name * :</label>
                                <div>
                                    <div class="col-md-1 col-sm-1 col-xs-1" id="gname2-status"></div>
                                    <div class="col-md-10 col-sm-10 col-xs-10" >
                                        <input type="text" class="form-control" name="uname" id="uname2" placeholder="User Name" required >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>Status :</label>
                                <select class="form-control" name="status" id="status" >
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="user_id" name="user_id" >
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
    
      $('#uname').on('change', function ()
        {
        var id = $('#uname').val() ;
        //alert(id);
        var base_url = '<?php echo base_url() ?>'+'User/check_username/';
    //alert(base_url);
        $.ajax({
          type: 'POST',
          async: false,
          url: base_url,
          data:{'id' : id},
          dataType: 'json',
          success: function (data) {
    //alert(data);                            
            if(data == 1){
              $('#gname-status').html("<span class='glyphicon glyphicon-ok form-control-feedback' style='color:green;'></span>");
              }
            else{
              $('#gname-status').html("<span class='glyphicon glyphicon-remove form-control-feedback' style='color:red;'></span>");
              }
            }
          });
        });
    </script>

    <script type="text/javascript">
    
      $('#uname2').on('change', function ()
        {
        var id = $('#uname2').val() ;
        //alert(id);
        var base_url = '<?php echo base_url() ?>'+'User/check_username/';
    //alert(base_url);
        $.ajax({
          type: 'POST',
          async: false,
          url: base_url,
          data:{'id' : id},
          dataType: 'json',
          success: function (data) {
    //alert(data);                            
            if(data == 1){
              $('#gname2-status').html("<span class='glyphicon glyphicon-ok form-control-feedback' style='color:green;'></span>");
              }
            else{
              $('#gname2-status').html("<span class='glyphicon glyphicon-remove form-control-feedback' style='color:red;'></span>");
              }
            }
          });
        });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $(".user_edit").click(function () {
          var catid = $(this).data('id');
//alert(l_id);
          $('input[name="user_id"]').val(catid);
        });

        $('.user_edit').click(function() {
          var id = $(this).data('id');
    //alert(id);
          var url = '<?php echo base_url() ?>User/get_user_data';
    //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
    //alert(data);
              var HTML = data["employeeName"];
              var HTML2 = data["empid"];
              var HTML3 = data["user_name"];
              var HTML4 = data["password"];
              var HTML5 = data["role"];
              var HTML6 = data["status"];
    //alert(HTML);
              $("#empname").val(HTML);
              $("#empid").val(HTML2);
              $("#uname2").val(HTML3);
              $("#password").val(HTML4);
              $("#role").val(HTML5);
              $("#status").val(HTML6);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>