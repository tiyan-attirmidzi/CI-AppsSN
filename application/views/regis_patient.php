<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="skcats">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title><?php echo $company[0]->company_name; ?></title>

        <link href="<?php echo base_url();?>img/admin/<?php echo $company[0]->company_image; ?>" rel="icon" type="image/png">

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/plugins/icomoon/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/plugins/uniform/css/default.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.css" rel="stylesheet"/>

        <!-- Theme Styles -->
        <link href="<?php echo base_url(); ?>assets/css/ecaps.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">

        <style type="text/css">
            .center-image {
                display: block;
                margin-top:1vh;
                margin-left: auto;
                margin-right: auto;
                width: 70%;
            }
        </style>

    </head>
    <body class="page-sidebar-fixed ">
        
        <!-- Page Container -->
        <div class="page-container">

            <!-- Page Sidebar -->
            <div class="page-sidebar" style="background : #007642;">
                <img src="<?php echo base_url();?>img/admin/<?php echo $company[0]->company_image; ?>" class="center-image">                
            </div>

            <!-- Page Content -->
            <div class="page-content">
                <div class="page-inner"><br><br>
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Registrasi Pasien Baru</h3>
                    </div>

                    <div id="main-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-white">
                                    <?php echo form_open_multipart('registration_patient/reg_newpatient','class="form-horizontal"');?>
                                        <?php
                                            $message = $this->session->flashdata('notif_regpatient');
                                            if($message)
                                            {
                                                echo '<p class="alert alert-success text-center">'.$message .'</p>';
                                            }
                                            $message = $this->session->flashdata('notif_regpatient1');
                                            if($message)
                                            {
                                                echo '<p class="alert alert-danger text-center">'.$message .'</p>';
                                            }
                                        ?>
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Nama Lengkap</label>
                                                        <span class="text-danger"> *</span>
                                                        <input type="text" class="form-control" placeholder="Nama Pasien" name="patient_name" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Jenis Kelamin</label>
                                                        <span class="text-danger"> *</span>
                                                        <select class="form-control" name="patient_sex" required="required">
                                                            <option value="">Pilih Jenis Kelamin</option>
                                                            <option value="Laki-laki">Laki-laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>                                                       
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Tanggal Lahir</label>
                                                        <span class="text-danger"> *</span>
                                                        <input type="date" class="form-control" name="patient_datebirth" required="required">                                                                                                               
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Nomor Handphone</label>
                                                        <span class="text-danger"> *</span>
                                                        <input type="text" pattern="^\d{12}$" name="patient_phone" class="form-control" minlength="12" maxlength="12" required="required" placeholder="Nomor Handphone Pasien">
                                                        <i>
                                                            <small class="form-text text-muted">Format : 082233445566</small>
                                                        </i>                                                                                                               
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Wilayah</label>
                                                        <span class="text-danger"> *</span>
                                                        <select class="form-control" name="district_id" required="required">
                                                            <option value="">Pilih Wilayah Pasien</option>
                                                            <?php 
                                                                foreach($district as $value) { ?>
                                                                    <option value="<?php echo $value->district_id ?>">
                                                                        <?php echo $value->district_name ?>
                                                                    </option>
                                                            <?php } ?>
                                                        </select>                                                                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Alamat Lengkap</label>
                                                        <span class="text-danger"> *</span>
                                                        <textarea class="form-control" name="patient_address" placeholder="Alamat Pasien" required="required" rows="4"></textarea>                                                                                                       
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Foto</label>
                                                        <span class="text-danger"> *</span>
                                                        <input type="file" class="form-control" name="userfile">
                                                    </div>
                                                </div>
                                                <li role="separator" class="divider"></li>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Email</label>
                                                        <span class="text-danger"> *</span>
                                                        <input type="email" class="form-control"  name="patient_email" placeholder="Masukkan Email" required="required">                                                                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Password</label>
                                                        <span class="text-danger"> *</span>
                                                        <input type="password" class="form-control"  name="patient_password" placeholder="Masukkan Password" required="required">                                                                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Konfirmasi Password</label>
                                                        <span class="text-danger"> *</span>
                                                        <input type="password" class="form-control"  name="conf_patient_password" placeholder="Masukkan Konfirmasi Password" required="required">                                                                                                  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-sm-offset-0 col-sm-12">
                                                    <button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Registrasi</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div><!-- Row -->
                    </div><!-- Main Wrapper -->
                    <!-- <a href="<?php //echo base_url();?>" class="btn btn-success btn-flat"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a><br><br> -->
                    <p>Sudah Memiliki Akun? <a href="<?php echo base_url();?>patient"><b>Masuk Disini</b></a></p>
                    <div class="page-footer">
                        <p>&copy; 2018 <a href="http://www.snhealthcenter.com" target="_blank"><b>SN AL Kobar Health Center</b></a>.</p>
                    </div>
                </div>
            </div>
        </div><!-- /Page Container -->
        
        
        <!-- Javascripts -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-3.1.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/uniform/js/jquery.uniform.standalone.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/d3/d3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/nvd3/nv.d3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.pie.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/chartjs/chart.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/ecaps.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/dashboard.js"></script>
    </body>
</html>