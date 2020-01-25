  <div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
      <h1>Company Profile</h1>
    </section>

    <?php
    $exception = $this->session->userdata('exception');
    if(isset($exception))
    {
    echo $exception;
    $this->session->unset_userdata('exception');
    } ?>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Company Profile Information</h3>
          </div>
          <div class="box-body">
            <form method="post" action="<?php base_url() ?>Cost/save_company_profile" enctype = 'multipart/form-data' >
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Company Name *</label>
                <input type="text" class="form-control" name="com_name" placeholder="Company Name" required >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Company Address *</label>
                <input type="text" class="form-control" name="com_address" placeholder="Company Address" required >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Mobile Number *</label>
                <input type="text" class="form-control" name="com_mobile" placeholder="Mobile Number" required >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Email</label>
                <input type="email" class="form-control" name="com_email" placeholder="exemple@sunshine.com" >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Website</label>
                <input type="text" class="form-control" name="com_web" placeholder="Company Website" >
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Company Logo *</label>
                <input type="file" name="userfile" required >
              </div>
              <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                <div class="col-md-9 col-md-offset-4">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>