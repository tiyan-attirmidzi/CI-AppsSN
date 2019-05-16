                <div class="page-inner">

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Pesanan Diterima</h3>
                    </div>

                    <div id="main-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-white">
                                    <?php      
                                        $message = $this->session->flashdata('notif_accept');
                                        if($message)
                                        {
                                            echo '<p class="alert alert-success text-center">'.$message .'</p>';
                                        }
                                    ?> 
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Pasien</th>
                                                        <th>Nomor Transaksi</th>
                                                        <th>Paket</th>
                                                        <th>Waktu Perjanjian</th>
                                                        <th>Status</th>
                                                        <th>Paramedic</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if (empty($transaction)) 
                                                        {
                                                            echo "";
                                                        }
                                                        else
                                                        {


                                                        if($this->uri->segment(2)=="index")
                                                        {
                                                            $no=1+$this->uri->segment(4);
                                                        }
                                                        else
                                                        {
                                                            $no=1+$this->uri->segment(5);
                                                        }

                                                        foreach ($transaction as $key)
                                                        {
                                                            $id = $key->transactiondetail_id;

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $key->patient_name; ?></td>
                                                        <td><?php echo $key->transactiondetail_id; ?></td>
                                                        <td><?php echo $key->package_name; ?></td>
                                                        <td><?php echo $key->transaction_arrangementdate; ?></td>
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
                                                        <td><?php echo $key->paramedic_name; ?></td>
                                                    </tr>

                                                    <!-- Modal Confirmation Cancel-->
                                                    <div class="modal fade" id="cancelModal<?php echo $id?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title"><b>Tolak Permintaan</b></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php echo form_open("paramedic/transaction/confirmation_cancel");?>
                                                                        <div class="box-body">
                                                                            <div class="form-group">
                                                                                <label>Pesan Untuk Pasien</label>
                                                                                <span class="text-danger"> *</span>
                                                                                <input type="hidden" name="transactiondetail_id" value="<?php $id;?>" required>
                                                                                <textarea name="transactiondetail_statusnote" class="form-control" rows="5" required placeholder="Pesan Akan Langsung Dikirimkan Kepada Pasien"></textarea>
                                                                            </div>
                                                                        </div>                                
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-danger">
                                                                                Kirim
                                                                            </button>
                                                                            <button class="btn" data-dismiss="modal" aria-hidden="true">
                                                                                &nbsp;Batal
                                                                            </button>
                                                                        </div>
                                                                    <?php echo form_close(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Of Modal Confirmation Cancel -->

                                                    <!-- Modal Confirmation Request-->
                                                    <div class="modal fade" id="acceptModal<?php echo $id?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title"><b>Terima Permintaan</b></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php echo form_open("paramedic/transaction/confirmation_request");?>
                                                                        <div class="box-body">
                                                                            <div class="form-group">
                                                                                <label>Pesan Untuk Pasien</label>
                                                                                <span class="text-danger"> *</span>
                                                                                <input type="hidden" name="transactiondetail_id" value="<?php echo $id ?>" required>
                                                                                <input type="hidden" name="paramedic_id" value="<?php echo $paramedic[0]->paramedic_id; ?>" required>
                                                                                <input type="hidden" name="paramediccategory_id" value="<?php echo $paramedic[0]->paramediccategory_id; ?>" required>
                                                                                <input type="hidden" name="package_id" value="<?php echo $key->package_id; ?>" required>
                                                                                <textarea name="transactiondetail_statusnote" class="form-control" rows="5" required placeholder="Pesan Akan Langsung Dikirimkan Kepada Pasien"></textarea>
                                                                            </div>
                                                                        </div>                                
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">
                                                                                Kirim
                                                                            </button>
                                                                            <button class="btn" data-dismiss="modal" aria-hidden="true">
                                                                                &nbsp;Batal
                                                                            </button>
                                                                        </div>
                                                                    <?php echo form_close(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Of Modal Confirmation Request -->

                                                    <?php $no++;  }} ?>
                                                </tbody>
                                            </table>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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