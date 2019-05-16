    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>BERANDA</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="content">
                            <div class="text">NAKES</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $paramedic ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">accessible</i>
                        </div>
                        <div class="content">
                            <div class="text">PASIEN</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $patient ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="text">PENGGUNA</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $user ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">loop</i>
                        </div>
                        <div class="content">
                            <div class="text">TRANSAKSI</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $transaction ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-amber hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text">LAYANAN</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $service ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">PAKET</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $package ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">subject</i>
                        </div>
                        <div class="content">
                            <div class="text">BLOG</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $post ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-deep-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">location_on</i>
                        </div>
                        <div class="content">
                            <div class="text">WILAYAH</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $district ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>REKAP PELAYANAN</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Layanan</th>
                                            <th>Proses</th>
                                            <th>Terima</th>
                                            <th>Selesai</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  

                                            $no = 1;

                                            if (is_array($rekapservice) || is_object($rekapservice))
                                            {
                                                foreach ($rekapservice as $key)
                                                {

                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $key->service_name; ?></td>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $no; ?></td>
                                        </tr>   
                                        <?php $no++; }; }; ?>
                                        <tr>
                                            <td colspan="2">Jumlah</td>
                                            <td>33</td>
                                            <td>33</td>
                                            <td>33</td>
                                            <td>33</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>RIWAYAT</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama User</th>
                                            <th>Nama Pasien</th>
                                            <th>Layanan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  

                                            $no = 1;

                                            if (is_array($history) || is_object($history))
                                            {
                                                foreach ($history as $key)
                                                {

                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $key->user_name; ?></td>
                                            <td><?php echo $key->patient_name; ?></td>
                                            <td><?php echo $key->service_name; ?></td>
                                            <td>
                                                <?php if($key->transaction_status == 2) { ?>
                                                    <span class="label bg-blue">Selesai</span>
                                                <?php } ?>
                                            </td>
                                        </tr>   
                                        <?php $no++; }; }; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>

        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/flot-charts/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/admin.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/demo.js"></script>
</body>

</html>