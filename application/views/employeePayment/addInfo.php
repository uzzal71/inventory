  <div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
      <h1>Employee Payment Information</h1>
    </section>

    <div class="box">
      <div class="box-body">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <form action="<?php echo base_url('Employee_payment/SaveInfo'); ?>" method="POST">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Month *</label>
                <select class="form-control" name="month" id="smonth" required >
                  <option value="">Select Month</option>
                  <option value="01">January</option>
                  <option value="02">February</option>
                  <option value="03">March</option>
                  <option value="04">April</option>
                  <option value="05">May</option>
                  <option value="06">June</option>
                  <option value="07">July</option>
                  <option value="08">August</option>
                  <option value="09">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                  <label>Year *</label>
                  <select class="form-control" name="year" id="syear" required >
                    <option value="">Select Year</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px" >
              <table class="table table-bordered table-striped">
                <thead>
                  <tr style="background: #000; color: #fff;">
                    <th><input type="checkbox" id="select-all" ></th>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Degnation</th>               
                    <th>Joning Date</th>
                    <th>Salary</th>
                  </tr>
                </thead>
                <tbody id="empsalary">
                
                </tbody>
              </table>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px" >
              <div class="form-group col-md-4 col-sm-6 col-xs-12">
                <label>Account Type *</label>                        
                <select class="form-control" name="accountType" id="accountType" required >
                  <option value="">Select One</option>
                  <option value="Cash">Cash</option>
                  <option value="Bank">Bank</option>
                  <option value="Mobile">Mobile</option>
                </select>
              </div>
              <div class="form-group col-md-4 col-sm-6 col-xs-12">
                <label>Account No *</label>                        
                <select class="form-control" name="accountNo" id="accountNo" required >
                  <option value="">Select One</option>
                </select>
              </div>
              <div class="form-group col-md-4 col-sm-6 col-xs-12">
                <label>Note</label>                        
                <input type="text" class="form-control" placeholder="if have any Note" name="note">
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px" >
              <div class="form-group">
                <div class="col-md-9 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="<?php echo site_url('Employee_payment')?>" class="btn btn-danger" style="margin-right:10px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

      <script>
        $(document).ready(function () {
          $('#syear').change(function() {
            var url = "<?php echo base_url(); ?>Employee_payment/get_emp_salary";
            var id = $('#syear').val();
            var id2 = $('#smonth').val();
            var id3 = $('#company').val();
      //alert(id3);alert(id);alert(id2);
            $.ajax({
              method: "POST",
              url     : url,
              dataType: 'json',
              data    : {'id':id,'id2':id2,'id3':id3},
              success:function(data){ 
      //alert(data);
            var HTML = '';
              for (var key in data) 
                {
                HTML +='<tr><td>'+'<input type="checkbox" name="checkbox[]" value="'+data[key]['employeeID']+'"></td><td>'+ data[key]['employeeName']+'<input type="text" class="hidden" name="empname[]" value="'+data[key]['employeeID']+'"></td><td>'+ data[key]['dept_name']+'<input type="text" class="hidden" name="department[]" value="'+data[key]['dpt_id']+'"></td><td>'+ data[key]['desg_name']+'<input type="text" class="hidden" name="degnation[]" value="'+data[key]['desg_id']+'"></td><td>'+ data[key]['joiningDate']+'<input type="text" class="hidden" name="joiningDate[]" value="'+data[key]['joiningDate']+'"></td><td>'+ data[key]['salary']+'<input type="text" class="hidden" name="salary[]" value="'+data[key]['salary']+'"></td><tr>';
                  }
              $("#empsalary").html(HTML);
                },
              error:function(data){
              alert('error');
              }
            });
          });
        });
      </script>

      <script type="text/javascript">

        var url = '<?php echo site_url('Sale/getAccountNo') ?>';

        $('#accountType').on('change',function() {
          var value = $(this).val();
          $('#accountNo').empty();
          getAccountNo(value, '#accountNo');
          });

        function getAccountNo(value, place) {
            $(place).empty();
            if (value != '') {
                $.ajax({
                    url: url,
                    async: false,
                    dataType: "json",
                    data: 'id=' + value,
                    type: "POST",
                    success: function (data) {
                        $(place).append(data);
                        $(place).trigger("chosen:updated");
                        }
                    });
                }
            else {
                $.alert({
                    title: 'Alert!',
                    content: 'Select Account Type',
                    type: "red",
                    icon: 'fa fa-warning',
                    theme: "material",
                    });
                }
            }
      </script>

    

      <script type="text/javascript">
        $('#select-all').click(function(event) {   
          if(this.checked) {
                // Iterate each checkbox
            $(':checkbox').each(function() {
              this.checked = true;                        
              });
            }
          else
            {
            $(':checkbox').each(function() {
              this.checked = false;                       
              });
            }
          });
      </script>