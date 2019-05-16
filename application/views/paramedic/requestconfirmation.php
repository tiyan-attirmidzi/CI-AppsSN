    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>paramedic"><i class="material-icons">home</i> Beranda</a></li>
                <li class="active"><i class="material-icons">loop</i> Permintaan Pemesanan</li>
            </ol>
                <?php      
                    $message = $this->session->flashdata('notif_success');
                    if($message)
                    {
                        echo '<p class="alert alert-info text-center">'.$message .'</p>';
                    }
                    $message = $this->session->flashdata('notif_danger');
                    if($message)
                    {
                        echo '<p class="alert alert-danger text-center">'.$message .'</p>';
                    }
                ?> 
            <!-- Striped Rows -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                DAFTAR PERMINTAAN PEMESANAN
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Layanan</th>
                                        <th>Nomor Transaksi</th>
                                        <th>Waktu Perjanjian</th>
                                        <th>Catatan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                        if($this->uri->segment(3)=="index")
                                        {
                                            $no=1+$this->uri->segment(5);
                                        }
                                        else
                                        {
                                            $no=1+$this->uri->segment(6);
                                        }

                                        if (is_array($transaction) || is_object($transaction))
                                        {
                                            foreach ($transaction as $key)
                                            {
                                                $id = $key->transactiondetail_id;
                                       
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $key->patient_name; ?></td>
                                            <td><?php echo $key->service_name; ?></td>
                                            <td><?php echo $key->transactiondetail_id; ?></td>
                                            <td><?php echo $key->transaction_arrangementdate; ?></td>
                                            <td><?php echo $key->transaction_note; ?></td>
                                            <td>
                                                <?php if($key->transactiondetail_status==1) { ?>

                                                    <button class='btn btn-white btn-success btn-bold btn-md' data-toggle='modal' data-target='#acceptModal<?php echo $id;?>'>
                                                        <i class='ace-icon fa fa-check bigger-120 blue'></i> Terima
                                                    </button>
                                                    
                                                    <!-- <button class='btn btn-white btn-danger btn-bold btn-md' data-toggle='modal' data-target='#cancelModal<?php //echo $id?>'>
                                                        <i class='ace-icon fa fa-remove bigger-120 red'></i> Tolak
                                                    </button> -->

                                                <?php } ?>

                                                <?php if($key->transactiondetail_status==4) { ?>

                                                    <span class='label label-success'><i class="fa fa-check"></i></span>

                                                <?php } ?>

                                                <a href="<?php echo site_url('paramedic/requestconfirmation/detail_view?transaction_id='.$key->transaction_id.'&transactiondetail_id='.$key->transactiondetail_id); ?>">
                                                    <button class="btn btn-white btn-info btn-bold btn-md">
                                                        <i class="ace-icon fa fa-info bigger-120 blue"></i> Info
                                                    </button>
                                                </a>
                                            </td>
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
                                                        <?php echo form_open("paramedic/requestconfirmation/confirmation_cancel");?>
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label>Pesan Untuk Pasien</label>
                                                                    <span class="text-danger"> *</span>
                                                                    <input type="hidden" name="transactiondetail_id" value="<?php echo $id;?>" required>
                                                                    <input type="hidden" name="paramedic_id" value="<?php echo $paramedic[0]->paramedic_id; ?>" required>
                                                                    <input type="hidden" name="paramediccategory_id" value="<?php echo $paramedic[0]->paramediccategory_id; ?>" required>
                                                                    <input type="hidden" name="package_id" value="<?php echo $key->package_id; ?>" required>
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
                                                        <?php echo form_open("paramedic/requestconfirmation/confirmation_request");?>
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
                                                                <button type="submit" class="btn btn-success">
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

                                    <?php $no++; }; }; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Striped Rows -->
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

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/admin.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/pages/cards/colored.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/demo.js"></script>
</body>

</html>