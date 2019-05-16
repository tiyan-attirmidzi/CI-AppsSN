                <div class="page-inner">

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Detail Pemesanan</h3>
                    </div>

                    <div id="main-wrapper">
                    
                        <div class="row">
                            <div class="col-md-4">
                                <h3><strong>Pemesanan</strong></h3>
                                <h4><?php echo $transaction[0]->transaction_code; ?></h4>
                                Tanggal : <?php echo $transaction[0]->transaction_date; ?> <br>
                                Total : Rp. <?php echo number_format($transaction[0]->transaction_total); ?><br>
                                Catatan : <?php echo $transaction[0]->transaction_note; ?>
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
                                                        <th>Paramedic</th>
                                                        <th>Satuan</th>
                                                        <th>Harga Perpaket</th>
                                                        <th>Sub Total</th>
                                                        <th></th>
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
                                                    ?>
                                                    <tr>
                                                        <?php
                                                        
                                                            if(!isset($transactiondetail) || empty($transactiondetail))
                                                            {
                                                                echo "<td colspan='8'><p class='label label-warning center h1'>Pesanan Belum Dikonfirmasi Oleh Paramedic</p></td>";
                                                            }

                                                            else
                                                            {
                                                                foreach ($transactiondetail as $key)
                                                                {
                                                                    $id = $key->transactiondetail_id;
                                                        ?>
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
                                                        <td>
                                                            <?php 
                                                                if($key->paramedic_id == 0)
                                                                {
                                                                    echo "-";
                                                                }
                                                                else
                                                                {
                                                                    echo $key->paramedic_name;
                                                                }   
                                                            ?>
                                                        </td>
                                                        <td><?php echo $key->package_amount; ?></td>
                                                        <td>Rp. <?php echo number_format($key->package_price); ?></td>
                                                        <td>Rp. <?php echo number_format($key->package_pricetotal); ?></td>
                                                        <td>

                                                            <?php if($key->transactiondetail_status==1) { ?>

                                                                <span class='label label-default'><i class="fa fa-spinner"></i></span>
                                                                
                                                            <?php } ?>

                                                            <?php if($key->transactiondetail_status==2) { ?>
                                                                <span class='label label-danger'><i class="fa fa-times"></i></span>
                                                            <?php } ?>

                                                            <?php if($key->transactiondetail_status==3) { ?>
                                                                        
                                                                <span class='label label-primary'><i class="fa fa-check"></i></span>

                                                            <?php } ?>
                                                                
                                                            <?php if($key->transactiondetail_status==4) { ?>
                                                                <span class='label label-success'><i class="fa fa-check"></i></span>
                                                            <?php } ?>

                                                        </td>
                                                    </tr>

                                                    <?php $no++;  }} ?>
                                                </tbody>
                                            </table>  
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-default">
                                            <div class="table-responsive">
                                                <table class="display table" style="width: 100%; cellspacing: 0;">
                                                    <thead>
                                                        <tr><h4 class="text-center">Tanggapan & Penilaian</h4></tr>
                                                        <tr>
                                                            <th>Paket</th>
                                                            <th>Tanggapan</th>
                                                            <th>Penilaian</th>
                                                            <th>Paramedic</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($transactiondetail2  as $value) { ?>
                                                            <tr>
                                                                <td><?php echo $value->package_name;?></td>
                                                                <td>
                                                                    <?php 
                                                                        if($value->transactiondetail_rate == '1')
                                                                        {
                                                                            echo "Sangat Kurang";
                                                                        }
                                                                        elseif($value->transactiondetail_rate == '2')
                                                                        {
                                                                            echo "Kurang";
                                                                        }
                                                                        elseif($value->transactiondetail_rate == '3')
                                                                        {
                                                                            echo "Sedang";
                                                                        }
                                                                        elseif($value->transactiondetail_rate == '4')
                                                                        {
                                                                            echo "Baik";
                                                                        }
                                                                        elseif($value->transactiondetail_rate == '5')
                                                                        {
                                                                            echo "Sangat Baik";
                                                                        }
                                                                        ?>
                                                                </td>
                                                                <td><?php echo $value->transactiondetail_review;?></td>
                                                                <td><?php echo $value->paramedic_name;?></td>
                                                            </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo base_url();?>admin/history" class="btn btn-default btn-flat">Kembali</a>
                            </div>
                        </div>
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