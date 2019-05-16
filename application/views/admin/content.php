                <!-- Page Inner -->
                <div class="page-inner">

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Home</h3>
                    </div>
                    
                    <!-- Main Wrapper -->
                    <div id="main-wrapper">
                        <div class="row">
                            <h3>Selamat Datang, <?php echo $admin[0]->name_admin; ?></h3><br>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number"><?php echo $paramedic ?></span>
                                            <p class="stats-info">Tenaga Kesehatan</p>
                                        </div>
                                        <div class="pull-right">
                                            <i class="glyphicon glyphicon-link"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number"><?php echo $patient ?></span>
                                            <p class="stats-info">Pasien</p>
                                        </div>
                                        <div class="pull-right">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number"><?php echo $service ?></span>
                                            <p class="stats-info">Layanan</p>
                                        </div>
                                        <div class="pull-right">
                                            <i class="glyphicon glyphicon-record"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number"><?php echo $package ?></span>
                                            <p class="stats-info">Paket</p>
                                        </div>
                                        <div class="pull-right">
                                            <i class="glyphicon glyphicon-th-list"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number"><?php echo $district ?></span>
                                            <p class="stats-info">Wilayah</p>
                                        </div>
                                        <div class="pull-right">
                                            <i class="glyphicon glyphicon-map-marker"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number"><?php echo $transaction ?></span>
                                            <p class="stats-info">Transaksi</p>
                                        </div>
                                        <div class="pull-right">
                                            <i class="glyphicon glyphicon-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row -->
                    </div><!-- /Main Wrapper -->

                    <div class="page-footer">
                        <p>&copy; 2018 <a href="http://www.technos-studio.com" target="_blank"><b>Techno's Studio</b></a>.</p>
                    </div>

                </div><!-- /Page Inner -->
            </div><!-- /Page Content -->
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