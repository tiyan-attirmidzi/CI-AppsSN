<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $company[0]->company_name; ?> || Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>img/admin/<?php echo $company[0]->company_image; ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/main.css">
</head>
<body>
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url();?>img/admin/<?php echo $company[0]->company_image; ?>" alt="IMG">
				</div>

				<?php echo form_open('admin/home/login','class="login100-form validate-form"'); ?>

					<?php
						if($this->session->flashdata('login'))
						{
                          echo"
                          <div class='alert alert-danger'>".
                            $this->session->flashdata('login')."</div>
                          ";
                        }
                    ?>
					<span class="login100-form-title">Admin Login</span>


					<div class="wrap-input100 validate-input" data-validate = "Username Tidak Boleh Kosong">
						<input class="input100" type="text" name="username_admin" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password Tidak Boleh Kosong">
						<input class="input100" type="password" name="password_admin" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">Login</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="<?php echo base_url(); ?>forgot?token=<?php echo base64_encode(111); ?>">
							Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							<!-- Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
						</a>
					</div>

				<?php form_close(); ?>
			</div>
		</div>
	</div>

    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/vendor/select2/select2.min.js"></script>
	<script src="<?php echo base_url() ?>assets/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="<?php echo base_url() ?>assets/js/main.js"></script>

</body>
</html>