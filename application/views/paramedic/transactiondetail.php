                <div class="page-inner">

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Detail Pesanan</h3>
                    </div>

                    <!-- Main wrapper -->
                    <div id="main-wrapper">

                        <div class="row">
                            <div class="col-md-4">
                                <h3><strong>Pemesanan</strong></h3>
                                <h4><?php echo $transaction[0]->transaction_code; ?></h4>
                                Tanggal : <?php echo $transaction[0]->transaction_date; ?> <br>
                            </div>
                            <div class="col-md-4">
                                <h3><strong>Pasien</strong></h3>
                                <h4><?php echo $transaction[0]->patient_name; ?></h4>
                                <p>
                                    Telpon : <?php echo $transaction[0]->patient_phone; ?> <br>
                                    Email : <?php echo $transaction[0]->patient_email; ?> 
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h3><strong>Waktu & Tempat</strong></h3>
                                <h4><?php echo $transaction[0]->district_name; ?></h4>
                                Alamat : <?php echo $transaction[0]->patient_address; ?><br>
                                Tanggal Perjanjian : <?php echo $transaction[0]->transaction_arrangementdate; ?><br>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Paket</th>
                                                        <th>Status</th>
                                                        <th>Satuan</th>
                                                        <th>Harga Perpaket</th>
                                                        <th>Sub Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                        if($this->uri->segment(2)=="index")
                                                        {
                                                            $no=1+$this->uri->segment(4);
                                                        }
                                                        else
                                                        {
                                                            $no=1+$this->uri->segment(5);
                                                        }

                                                        foreach ($transactiondetail as $key)
                                                        {
                                                            $id = $key->transactiondetail_id;

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $key->package_name; ?></td>
                                                        <td>
                                                            <?php 
                                                                if($key->transactiondetail_status==1)
                                                                {
                                                                    echo "<span class='label label-default'>Proses</span>";
                                                                }
                                                                elseif($key->transactiondetail_status==2)
                                                                {
                                                                    echo "<span class='label label-danger'>Di Tolak</span>";
                                                                }
                                                                elseif($key->transactiondetail_status==3)
                                                                {
                                                                    echo "<span class='label label-primary'>Di Terima</span>";
                                                                }
                                                                elseif($key->transactiondetail_status==4)
                                                                {
                                                                    echo "<span class='label label-success'>Sukses</span>";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $key->package_amount; ?></td>
                                                        <td>Rp. <?php echo number_format($key->package_price); ?></td>
                                                        <td>Rp. <?php echo number_format($key->package_pricetotal); ?></td>
                                                    </tr>

                                                    <?php $no++;  } ?>
                                                </tbody>
                                            </table>  
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="alert alert-warning">
                                            <table>
                                                <tr>
                                                    <td width='50%'>Pesan Dari Pasien</td>
                                                    <td width='5%'> : </td>
                                                    <td style="padding: 3px;"><?php echo $transaction[0]->transaction_note; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo base_url();?>paramedic/requestconfirmation" class="btn btn-default btn-flat">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Main wrapper -->
                    
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