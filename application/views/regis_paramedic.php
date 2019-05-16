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
                        <h3 class="breadcrumb-header">Registrasi Tenaga Kesehatan Baru</h3>
                    </div>

                    <div id="main-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-white">
                                    <?php
                                        $message = $this->session->flashdata('notif_regparamedic');
                                        if($message)
                                        {
                                            echo '<p class="alert alert-success text-center">'.$message .'</p>';
                                        }
                                        $message = $this->session->flashdata('notif_regparamedic1');
                                        if($message)
                                        {
                                            echo '<p class="alert alert-danger text-center">'.$message .'</p>';
                                        }
                                    ?>
                                    <div class="panel-body">
                                        <div id="rootwizard">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-user m-r-xs"></i>Data Dasar</a></li>
                                                <li role="presentation"><a href="#tab2" data-toggle="tab"><i class="fa fa-cloud-upload m-r-xs"></i>Data Kompetensi</a></li>
                                                <li role="presentation"><a href="#tab3" data-toggle="tab"><i class="fa fa-file m-r-xs"></i>Pemberkasan</a></li>
                                                <li role="presentation"><a href="#tab4" data-toggle="tab"><i class="fa fa-check m-r-xs"></i></a></li>
                                            </ul>
                                            <div class="progress progress-sm m-t-sm">
                                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                </div>
                                            </div>
                                            <?php echo form_open_multipart("registration_paramedic/reg_newparamedic", "id='wizardForm'");?>
                                                <div class="tab-content">
                                                    <div class="tab-pane active fade in" id="tab1">
                                                        <div class="row m-b-lg">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="paramedic_name">Nama Lengkap</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <input type="text" class="form-control" name="paramedic_name" id="paramedic_name" placeholder="Nama Lengkap">
                                                                    </div>
                                                                    <div class="form-group  col-md-12">
                                                                        <label for="paramedic_ktp">Nomor KTP</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <input type="text" class="form-control" name="paramedic_ktp" id="paramedic_ktp" maxlength="16" placeholder="Nomor KTP (Kartu Tanda Penduduk)" >
                                                                    </div>
                                                                    <div class="form-group  col-md-12">
                                                                        <label for="paramedic_sex">Jenis Kelamin</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <select name="paramedic_sex" class="form-control" id="paramedic_sex">
                                                                            <option value="">Jenis Kelamin</option>
                                                                            <option value="Laki-laki">Laki-laki</option>
                                                                            <option value="Perempuan">Perempuan</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group  col-md-12">
                                                                        <label for="paramedic_datebirth">Tanggal Lahir</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <input type="date" class="form-control" name="paramedic_datebirth" id="paramedic_datebirth">
                                                                    </div>
                                                                    <div class="form-group  col-md-12">
                                                                        <label for="paramedic_religion">Agama</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <select name="paramedic_religion" class="form-control" id="paramedic_religion">
                                                                            <option value="">Agama</option>
                                                                            <option value="Islam">Islam</option>
                                                                            <option value="Kristen Protestan">Kristen Protestan</option>
                                                                            <option value="Katolik">Katolik</option>
                                                                            <option value="Hindu">Hindu</option>
                                                                            <option value="Buddha">Buddha</option>
                                                                            <option value="Kong Hu Cu">Kong Hu Cu</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group  col-md-12">
                                                                        <label for="paramedic_lasteducation">Pendidikan Terakhir</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <select name="paramedic_lasteducation" class="form-control" id="paramedic_lasteducation">
                                                                            <option value="">Pendidikan Terakhir</option>
                                                                            <option value="SMA">SMA</option>
                                                                            <option value="D3">D3</option>
                                                                            <option value="D4">D4</option>
                                                                            <option value="S1">S1</option>
                                                                            <option value="S2">S2</option>
                                                                            <option value="S3">S3</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group  col-md-12">
                                                                        <label for="paramediccategory_id">Unit Kerja</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <select name="paramediccategory_id" id="paramediccategory_id" class="form-control">
                                                                            <option value="">Unit Kerja</option>
                                                                            <?php foreach ($paramediccategory as $key) { ?>
                                                                                <option value="<?php echo $key->paramediccategory_id; ?>"><?php echo $key->paramediccategory_name; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group  col-md-12">
                                                                        <label for="paramedic_phone">Nomor Handphone</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <input type="text" name="paramedic_phone" id="paramedic_phone" maxlength="12" class="form-control" placeholder="Nomor Handphone">
                                                                    </div>
                                                                    <div class="form-group  col-md-12">
                                                                        <label for="district_id">Wilayah</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <select name="district_id" id="district_id" class="form-control" required>
                                                                            <option value="">Wilayah</option>
                                                                            <?php foreach ($district as $key) { ?>
                                                                                <option value="<?php echo $key->district_id; ?>"><?php echo $key->district_name; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group  col-md-12">
                                                                        <label for="paramedic_address">Alamat Lengkap</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <textarea class="form-control" name="paramedic_address" rows="4" placeholder="Alamat Paramedic" id="paramedic_address"></textarea>
                                                                    </div>
                                                                    <div class="form-group  col-md-12">
                                                                        <label for="userfile">Foto</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <input type="file" name="userfile" class="form-control" id="userfile">
                                                                        <span><i>Foto berwarna & berukuran 4 X 6</i></span>
                                                                    </div>
                                                                    <div class="form-group  col-md-12">
                                                                        <label for="paramedic_region">Regional</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <select name="paramedic_region" class="form-control" id="paramedic_region">
                                                                            <option value="1">KENDARI</option>
                                                                            <option value="2">KONAWE</option>
                                                                            <option value="3">WAKATOBI</option>
                                                                            <option value="4">MUNA</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-6">
                                                                <h3>Paramedic</h3>
                                                                <p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus.</p>
                                                                <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                                            </div> -->
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="exampleInputEmail">Email</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <input type="email" class="form-control" name="exampleInputEmail" id="exampleInputEmail" placeholder="Gunakan Email Aktif Anda" >
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label for="exampleInputPassword1">Password</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <input type="password" class="form-control" name="exampleInputPassword1" id="exampleInputPassword1" placeholder="Password" >
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label for="exampleInputPassword2">Konfirmasi Password</label>
                                                                        <span class="text-danger"> *</span>
                                                                        <input type="password" class="form-control" name="exampleInputPassword2" id="exampleInputPassword2" placeholder="Konfirmasi Password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="pager wizard">
                                                            <li class="previous"><a href="#" class="btn btn-success">Sebelumnya</a></li>
                                                            <li class="next"><a href="#" class="btn btn-success">Berikutnya</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab2">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="m-t-md">
                                                                    <address>
                                                                        <strong>Data Kompetensi / Pernah Mengikuti Pelatihan</strong><br>
                                                                        <span class="text-danger">*</span><i> Lampirkan File Tersebut Jika Ada</i>
                                                                    </address>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_btcls">Basic Trauma Cardiac Life Support (BTCLS)</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_btcls" id="paramedic_btcls">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_wc">Wound Care</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_wc" id="paramedic_wc">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_hn">Hipnoterapi Nurse</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_hn" id="paramedic_hn">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_sm">Sunat Modern</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_sm" id="paramedic_sm">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_dk">Disaster / Komunitas</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_dk" id="paramedic_dk">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_nc">Nenonatal Care</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_nc" id="paramedic_nc">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_g">Geriatrik</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_g" id="paramedic_g">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_ppgd">Pertolongan Pertama Gawat Darurat (PPGD)</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_ppgd" id="paramedic_ppgd">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_icu">Intensive Care Unit (ICU)</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_icu" id="paramedic_icu">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_nicu">Neonatal Intensive Care Unit (NICU)</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_nicu" id="paramedic_nicu">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="pager wizard">
                                                            <li class="previous"><a href="#" class="btn btn-success">Sebelumnya</a></li>
                                                            <li class="next"><a href="#" class="btn btn-success">Berikutnya</a></li>
                                                        </ul>
                                                    </div>
                                                    
                                                    <div class="tab-pane fade" id="tab3">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="m-t-md">
                                                                    <address>
                                                                        <strong>Pemberkasan</strong><br>
                                                                        <span class="text-danger">*</span><i> Lampirkan Dokumen Berikut</i>
                                                                    </address>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_it">Foto Copy Ijazah Terakhir</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_it" id="paramedic_it">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_fcktp">Foto Copy KTP</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_fcktp" id="paramedic_fcktp">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_str">Foto Copy STR</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_str" id="paramedic_str">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_skbs">Foto Copy SKBS</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_skbs" id="paramedic_skbs">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_kta">Foto Copy KTA Profesi</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_kta" id="paramedic_kta">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="paramedic_rp">Rekomendasi Profesi</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="file" class="form-control" name="paramedic_rp" id="paramedic_rp">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="pager wizard">
                                                            <li class="previous"><a href="#" class="btn btn-success">Sebelumnya</a></li>
                                                            <li class="next"><a onclick="document.getElementById('wizardForm').submit();" class="btn btn-success">Registrasi</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab4">
                                                        <h3 style="margin-top:25px;"></h3>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row -->
                    </div><!-- Main Wrapper -->
                    <!-- <a href="<?php //echo base_url();?>" class="btn btn-success btn-flat"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a><br><br> -->
                    <p>Sudah Memiliki Akun? <a href="<?php echo base_url();?>paramedic"><b>Masuk Disini</b></a></p>
                    <div class="page-footer">
                        <p>&copy; 2018 <a href="http://www.technos-studio.com" target="_blank"><b>Techno's Studio</b></a>.</p>
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
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/ecaps.min.js"></script>
        <script>
            $(document).ready(function() {
    
                "use strict";
                
                var $validator = $("#wizardForm").validate({
                    rules: {
                        paramedic_name: {
                            required: true
                        },
                        paramedic_ktp: {
                            required: true
                        },
                        paramedic_sex: {
                            required: true
                        },
                        paramedic_datebirth: {
                            required: true
                        },
                        paramedic_religion: {
                            required: true
                        },
                        paramedic_lasteducation: {
                            required: true
                        },
                        paramediccategory_id: {
                            required: true
                        },
                        paramedic_phone: {
                            required: true
                        },
                        district_id: {
                            required: true
                        },
                        paramedic_address: {
                            required: true
                        },
                        exampleInputEmail: {
                            required: true,
                            email: true
                        },
                        exampleInputPassword1: {
                            required: true
                        },
                        exampleInputPassword2: {
                            required: true,
                            equalTo: '#exampleInputPassword1'
                        },
                        exampleInputCard: {
                            required: true,
                            number: true
                        },
                        exampleInputSecurity: {
                            required: true,
                            number: true
                        },
                        exampleInputHolder: {
                            required: true
                        },
                        exampleInputExpiration: {
                            required: true,
                            date: true
                        },
                        exampleInputCsv: {
                            required: true,
                            number: true
                        }
                    }
                });
            
                $('#rootwizard').bootstrapWizard({
                    'tabClass': 'nav nav-tabs',
                    onTabShow: function(tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index+1;
                        var $percent = ($current/$total) * 100;
                        $('#rootwizard').find('.progress-bar').css({width:$percent+'%'});
                    },
                    'onNext': function(tab, navigation, index) {
                        var $valid = $("#wizardForm").valid();
                        if(!$valid) {
                            $validator.focusInvalid();
                            return false;
                        }
                    },
                    'onTabClick': function(tab, navigation, index) {
                        var $valid = $("#wizardForm").valid();
                        if(!$valid) {
                            $validator.focusInvalid();
                            return false;
                        }
                    },
                });
                
                $('.date-picker').datepicker({
                    orientation: "top auto",
                    autoclose: true
                });
            });
        </script>
    </body>
</html>