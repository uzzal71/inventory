  <div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
      <h1>Employee</h1>
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
        <h3 class="box-title">Employee List</h3>
        <button type="button" class="btn btn-primary add_emp" data-toggle="modal" data-target=".bs-example-modal-aemp" style="float: right" ><i class="fa fa-plus"></i> New Employee</button>
      </div>
      <div class="box-body">
        <div id="table-content" class="col-md-12 col-sm-12 col-xs-12">
          <table id="datatable" class="table table-responsive table-bordered table-hover">
            <thead>
              <tr>
                <th>#SN.</th>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
                <th>Joining Date</th>
                <th>Salary</th>
                <th>Status</th>
                <th style="width: 8%;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 0;
              foreach ($employees as $key => $value) {
              $i++;
              ?>
              <tr class="gradeX">
                <td><?php echo $i; ?></td>
                <td><?php echo 'EM-'.$value['employeeID']; ?></td>
                <td><?php echo $value['employeeName']; ?></td>
                <td><?php echo $value['phone']; ?></td>
                <td><?php if($value['email']){echo $value['email'];}else{echo '-';} ?></td>
                <td><?php echo $value['empaddress']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($value['joiningDate'])); ?></td>
                <td><?php echo '৳.'.number_format($value['salary'], 2); ?></td>
                <td><?php echo $value['status']; ?></td>        
                <td>
                  <button type="button" class="btn btn-success btn-sm emp_edit" data-toggle="modal" data-target=".bs-example-modal-eemp" data-id="<?php echo $value['employeeID']; ?>" onclick="document.getElementById('emp_edit').style.display='block'" ><i class="fa fa-edit"></i></button>
                  <a class=" btn btn-danger btn-sm" href="<?php echo site_url('employee/delete_Employee').'/'.$value['employeeID'] ?>" ><i class="fa fa-trash"></i></a>
                </td>
              </tr>   
              <?php } ?> 
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div id="add_emp" class="modal fade bs-example-modal-aemp" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Employee Information</h4>
          </div>
          <form action="<?php echo base_url('Employee/SaveEmployee');?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Employee Name *</label>
                <input type="text" class="form-control" name="employeeName" placeholder="Employee Name" required >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Department</label>
                <select name="dpt_id" id="department" class="form-control"  >
                  <option value="">Select One</option>
                  <?php foreach ($dept as $key => $value) { ?>
                  <option value="<?php echo $value['dpt_id']; ?>"><?php echo $value['dept_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Designation</label>
                <select name="desg_id" id="designation" class="form-control" >
                    <option value="">Select Department First</option>
                </select>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Company / Warehouse *</label>
                <select class="form-control" name="company" required >
                  <option value="">Select One</option>
                  <?php foreach($company as $value):?>
                  <option value="<?php echo $value['companyID']; ?>"><?php echo $value['companyName']; ?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Address *</label>
                <input type="text" class="form-control" name="empaddress" placeholder="Address" required >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Mobile Number *</label>
                <input type="text" class="form-control" name="phone" placeholder="Mobile Number" required >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="example@gmail.com" >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Joining Date</label>
                <input type="text" class="form-control datepicker" name="joiningDate" placeholder="Joining Date" >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Salary</label>
                <input type="text" class="form-control" name="salary" placeholder="Salary" >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>NID</label>
                <input type="text" class="form-control" name="nid" placeholder="NID Number" >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12" >
                <label>Status</label>
                <div>
                  <input type="radio" name="status" value="Active" checked="checked" >&nbsp;Active&nbsp;&nbsp;
                  <input type="radio" name="status" value="Inactive" >&nbsp;Inactive
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

    <div id="emp_edit" class="modal fade bs-example-modal-eemp" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" >Update Employee Information</h4>
          </div>
          <form action="<?php echo base_url('Employee/update_Employee');?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Employee Name *</label>
                <input type="text" class="form-control" name="employeeName" id="empname" required >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Department</label>
                <select name="dpt_id" id="empdept" class="form-control"  >
                  <option value="">Select One</option>
                  <?php foreach ($dept as $key => $value) { ?>
                  <option value="<?php echo $value['dpt_id']; ?>"><?php echo $value['dept_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Designation</label>
                <select name="desg_id" id="empdesg" class="form-control" >
                  <option value="">Select Department First</option>
                </select>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Company / Warehouse *</label>
                <select class="form-control" id="warehouse" name="company" required >
                  
                </select>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Address *</label>
                <input type="text" id="empaddress" class="form-control" name="empaddress" required >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Mobile Number *</label>
                <input type="text" id="mobile" class="form-control" name="phone" required >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Email</label>
                <input type="email" class="form-control" id="empemail" name="email" >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Joining Date</label>
                <input type="text" class="form-control datepicker" id="jdate" name="joiningDate" >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Salary</label>
                <input type="text" class="form-control" name="salary" id="salary" >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>NID</label>
                <input type="text" class="form-control" name="nid" id="nid" >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12" >
                <label>Status</label>
                <select class="form-control" name="status" id="status" >
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
            <input type="hidden" id="emp_id" name="emp_id" >
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>

    <script>
        $(document).ready(function() {
         $('#department').change(function() {
          var url = "<?php echo base_url(); ?>Employee/get_designation_data";
          var id = $('#department').val() ;
// alert(url);
// alert(id);
              $.ajax({
                  method: "POST",
                  url     : url,
                  dataType: 'json',
                  data    : {"id" : id},
                  success:function(data){ 
  //alert(data);
                  $('#designation').removeAttr("disabled")
                    var HTML = "<option value=''>Select Designation</option>";
                    for (var key in data) 
                      {if (data.hasOwnProperty(key)) {
                      HTML +="<option value='"+data[key]["desg_id"]+"'>" + data[key]["desg_name"]+"</option>";
                      }}
                    $("#designation").html(HTML);
                   },
                   error:function(data){
                       alert('error');
                   }
              });
          });
        });
    </script>

    <script>
        $(document).ready(function() {
         $('#empdept').change(function() {
          var url = "<?php echo base_url(); ?>Employee/get_designation_data";
          var id = $('#empdept').val() ;
// alert(url);
// alert(id);
              $.ajax({
                  method: "POST",
                  url     : url,
                  dataType: 'json',
                  data    : {"id" : id},
                  success:function(data){ 
  //alert(data);
                  $('#empdesg').removeAttr("disabled")
                    var HTML = "<option value=''>Select Designation</option>";
                    for (var key in data) 
                      {if (data.hasOwnProperty(key)) {
                      HTML +="<option value='"+data[key]["desg_id"]+"'>" + data[key]["desg_name"]+"</option>";
                      }}
                    $("#empdesg").html(HTML);
                   },
                   error:function(data){
                       alert('error');
                   }
              });
          });
        });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $(".emp_edit").click(function () {
          var catid = $(this).data('id');
//alert(l_id);
          $('input[name="emp_id"]').val(catid);
        });

        $('.emp_edit').click(function() {
          var id = $(this).data('id');
    //alert(id);
          var url = '<?php echo base_url() ?>Employee/get_emp_data';
    //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
    //alert(data);
              var HTML = data["employeeName"];
              var HTML2 = data["empaddress"];
              var HTML3 = data["phone"];
              var HTML4 = data["email"];
              var HTML5 = data["joiningDate"];
              var HTML6 = data["salary"];
              var HTML7 = data["nid"];
              var HTML8 = data["status"];
              var HTML9 = "<option value='"+data["companyID"]+"'>"+data["companyName"]+"</option>";
    //alert(HTML);
              $("#empname").val(HTML);
              $("#empaddress").val(HTML2);
              $("#mobile").val(HTML3);
              $("#empemail").val(HTML4);
              $("#jdate").val(HTML5);
              $("#salary").val(HTML6);
              $("#nid").val(HTML7);
              $("#status").val(HTML8);
              $("#warehouse").html(HTML9);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>