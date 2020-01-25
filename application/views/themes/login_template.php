
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $company->com_name; ?></title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.custom.min.css')?>">

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo site_url('assets/dist/css/AdminLTE.min.css')?>">
		<!-- iCheck -->
		<!-- <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css"> -->
		<link href="<?php echo site_url('assets/plugins/icheck/skins/square/blue.css')?>" rel="stylesheet">
	</head>


	<?php echo $content;?>

			</div>
			<!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

		<!-- jQuery 2.2.3 -->
		<script src="<?php echo site_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
		<!-- Bootstrap 3.3.6 -->
			
		<script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
		<!-- iCheck -->
		<script src="<?php echo site_url('assets/plugins/icheck/icheck.js')?>"></script>

		<script>
			$(function () {
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' // optional
				});
			});
		</script>
	</body>
</html>