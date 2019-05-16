<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $company[0]->company_name; ?></title>

    <!-- Favicon-->
    <link href="<?php echo base_url();?>img/admin/<?php echo $company[0]->company_image; ?>" rel="shortcut icon" type="image/png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url(); ?>assets/font-awesome/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url(); ?>tamplate-dashboard/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url(); ?>tamplate-dashboard/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="<?php echo base_url(); ?>tamplate-dashboard/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>tamplate-dashboard/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url(); ?>tamplate-dashboard/css/themes/all-themes.css" rel="stylesheet" />
    
    <!-- Bootstrap Select Css -->
    <link href="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- CKEDITOR -->
    <script type="text/javascript" src="<?php echo base_url()."assets/"?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo base_url()."assets/"?>ckeditor/styles.js"></script>

    <style>
        .center {
            display: block;
            margin-top:1vh;
            margin-left: auto;
            margin-right: auto;
            /* width: 70%; */
        }
    </style>
</head>

<body class="theme-green">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Mohon Tunggu...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->