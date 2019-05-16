<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password</title>
    <link rel="icon" type="image/png" href="<?php echo base_url();?>img/admin/<?php echo $company[0]->company_image; ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/main.css">
    <style>
        .wrap-login100 {
            padding: 99px 130px 99px 95px;
        }
		.forgot-page
		{
			background : #00bcd4;
        }
        @media (max-width: 992px) {
            .wrap-login100 {
                padding: 99px 90px 99px 85px;
            }

            .login100-pic {
                width: 35%;
            }

            .login100-form {
                width: 50%;
            }
        }

            @media (max-width: 768px) {
            .wrap-login100 {
                padding: 40px 80px 33px 80px;
            }

            .login100-pic {
                display: none;
            }

            .login100-form {
                width: 100%;
            }
        }

            @media (max-width: 576px) {
            .wrap-login100 {
                padding: 40px 15px 33px 15px;
            }
        }
	</style>
</head>
<body>
    <div class="limiter">   
		<div class="container-login100 forgot-page">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url();?>img/admin/<?php echo $company[0]->company_image; ?>" alt="IMG">
				</div>

				<?php echo form_open('forgot/reset','class="login100-form validate-form"'); ?>
                    <?php 
                        if($this->session->flashdata('notif')) 
                        {
                            echo "<div class='alert alert-danger'>".$this->session->flashdata('notif')."</div>";
                        } 
                        else
                        {
                            echo "<div class='alert alert-info'>Masukkan alamat email Anda. Kami akan mengirimkan Anda email dengan nama pengguna dan tautan untuk mereset kata sandi Anda.</div>";
                        }
                    ?>
                   
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email_user" placeholder="Email">
						<input class="input100" type="hidden" name="token" value="<?php echo $token[0]; ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">Reset Password</button>
					</div>

                    <div class="text-center p-t-12">
						<span class="txt1">
							Sudah Memiliki
						</span>
						<?php if($token[0] == 1) { ?>
                            <a class="txt2" href="<?php echo base_url(); ?>admin">
							    Akun?
						    </a>
                        <?php } ?>
						<?php if($token[0] == 2) { ?>
                            <a class="txt2" href="<?php echo base_url(); ?>paramedic">
							    Akun?
						    </a>
                        <?php } ?>
						<?php if($token[0] == 3) { ?>
                            <a class="txt2" href="<?php echo base_url(); ?>patient">
							    Akun?
						    </a>
                        <?php } ?>
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