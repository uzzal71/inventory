<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="javascript:void(0)"><b>Login Panel</b></a>
      <div >
        <img src="<?php echo base_url($company->com_logo); ?>" style="width: 100%; height: 80px;">
      </div>
    </div>
<!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in By Id Password</p>

      <?php if($this->session->flashdata('msg')){?>
      <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('msg');?>
      </div>
      <?php } ?>

      <form action="<?php echo base_url('login/loginProcess');?>" autocomplete="off" method="POST">
        <div class="form-group has-feedback">
          <input type="text" id="username" name="username" required placeholder="User Name" class="form-control">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="password" name="password" required placeholder="password" class="form-control">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
          <input type="submit" name="submit" class="btn btn-success btn-block btn-flat" value="Sign In"> </div>
        </div>
      </form>