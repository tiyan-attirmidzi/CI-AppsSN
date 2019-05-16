                <!-- Page Inner -->
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
                                                        <th>Satuan</th>
                                                        <th>Harga Perpaket</th>
                                                        <th>Sub Total</th>
                                                        <th>Status</th>
                                                        <th>Opsi</th>
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
                                                        <td><?php echo $key->package_amount; ?></td>
                                                        <td>Rp. <?php echo number_format($key->package_price); ?></td>
                                                        <td>Rp. <?php echo number_format($key->package_pricetotal); ?></td>
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
                                                            <?php if($key->transactiondetail_status==2) { ?>
                                                                    
                                                                <button class='btn btn-white btn-danger btn-bold btn-md' data-toggle='modal' data-target='#ratereviewcancelModal<?php echo $id;?>'>
                                                                    <i class='ace-icon fa fa-check-square-o bigger-120 blue'></i> Feedback
                                                                </button>
                
                                                            <?php } ?>
                                                            
                                                            <?php if($key->transactiondetail_status==3) { ?>
                                                                    
                                                                <button class='btn btn-white btn-primary btn-bold btn-md' data-toggle='modal' data-target='#ratereviewaccModal<?php echo $id;?>'>
                                                                    <i class='ace-icon fa fa-check-square-o bigger-120 blue'></i> Feedback
                                                                </button>
            
                                                            <?php } ?>

                                                            <?php if($key->transactiondetail_status==4) { ?>
                                                                <span class='label label-success'><i class="fa fa-check"></i></span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    
                                                    <!-- Modal ratereview CANCEL -->
                                                    <div class="modal fade" id="ratereviewcancelModal<?php echo $id?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title"><b>Penilaian & Tanggapan</b></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php echo form_open_multipart("transactiondetail/feedback_cancel");?>
                                                                        <div class="box-body">
                                                                            <div class="nav-tabs-custom">
                                                                                <div class="tab-content">
                                                                                    <div class="tab-pane active">
                                                                                        <div class="form-group">
                                                                                            <label>Penilaian</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <select class="form-control" name="transactiondetail_rate" required="required">
                                                                                                <option value="">--- Nilai ---</option>
                                                                                                <option value="1">Sangat Kurang</option>
                                                                                                <option value="2">Kurang</option>
                                                                                                <option value="3">Sedang</option>
                                                                                                <option value="4">Baik</option>
                                                                                                <option value="5">Sangat Baik</option>
                                                                                            </select>
                                                                                            <input type="hidden" class="form-control"  value='<?php echo $key->transactiondetail_id; ?>' name="transactiondetail_id" required="required" readonly>
                                                                                            <input type="hidden" class="form-control"  value='<?php echo $key->transaction_id; ?>' name="transaction_id" required="required" readonly>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Tanggapan</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <textarea class="form-control" name="transactiondetail_review" placeholder="Tanggapan" required="required" rows="5"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- /.tab-content -->
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.box-body -->
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-danger">
                                                                                Kirim
                                                                            </button>
                                                                            <button class="btn" data-dismiss="modal" aria-hidden="true">
                                                                                &nbsp;Batal
                                                                            </button>
                                                                        </div>
                                                                        <!-- /.box-footer -->
                                                                    <?php echo form_close(); ?> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal ratereview CANCEL -->

                                                    <!-- Modal ratereview ACCEPT -->
                                                    <div class="modal fade" id="ratereviewaccModal<?php echo $id?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title"><b>Penilaian & Tanggapan</b></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php echo form_open_multipart("patient/transactiondetail/feedback_accept");?>
                                                                        <div class="box-body">
                                                                            <div class="nav-tabs-custom">
                                                                                <div class="tab-content">
                                                                                    <div class="tab-pane active">
                                                                                        <div class="form-group">
                                                                                            <label>Penilaian</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <select class="form-control" name="transactiondetail_rate" required="required">
                                                                                                <option value="">--- Nilai ---</option>
                                                                                                <option value="1">Sangat Kurang</option>
                                                                                                <option value="2">Kurang</option>
                                                                                                <option value="3">Sedang</option>
                                                                                                <option value="4">Baik</option>
                                                                                                <option value="5">Sangat Baik</option>
                                                                                            </select>
                                                                                            <input type="hidden" class="form-control"  value='<?php echo $key->transactiondetail_id; ?>' name="transactiondetail_id" required="required" readonly>
                                                                                            <input type="hidden" class="form-control"  value='<?php echo $key->transaction_id; ?>' name="transaction_id" required="required" readonly>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Tanggapan</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <textarea class="form-control" name="transactiondetail_review" placeholder="Tanggapan" required="required" rows="5"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- /.tab-content -->
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.box-body -->
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">
                                                                                Kirim
                                                                            </button>
                                                                            <button class="btn" data-dismiss="modal" aria-hidden="true">
                                                                                &nbsp;Batal
                                                                            </button>
                                                                        </div>
                                                                        <!-- /.box-footer -->
                                                                    <?php echo form_close(); ?> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal ratereview CANCEL -->

                                                    <?php $no++;  } ?>
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
                                                            <th>Pesan Dari Paramedic</th>
                                                            <th>Tanggapan</th>
                                                            <th>Penilaian</th>
                                                            <th>Paramedic</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($transactiondetail2 as $value) { ?>
                                                            <tr>
                                                                <td><?php echo $value->package_name;?></td>
                                                                <td><?php echo $value->transactiondetail_statusnote;?></td>
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
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo base_url();?>patient/transaction" class="btn btn-default btn-flat">Kembali</a>
                            </div>
                        </div>
                    </div>

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