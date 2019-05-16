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
                        <h3 class="breadcrumb-header"><?php echo $blog[0]->post_title; ?></h3>
                        <i class="fa fa-user"></i> <?php echo $blog[0]->post_postby ?> | <?php echo $blog[0]->post_postdate?>
                    </div>

                    <div id="main-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-white">
                                    <img src="<?php echo base_url()?>img/post/<?php echo $blog[0]->post_image?>" style="width: 100%" >
                                    <p><?php echo $blog[0]->post_desc?></p>
                                </div>
                            </div>
                        </div><!-- Row -->
                    </div><!-- Main Wrapper -->
                    <button onclick="history.back();" class="btn btn-success btn-flat"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</button><br><br>
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