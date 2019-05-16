    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>paramedic"><i class="material-icons">home</i> Beranda</a></li>
                <li class="active"><i class="material-icons">loop</i> Riwayat Transaksi</li>
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
                                Riwayat Transaksi
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Kode Transaksi</th>
                                        <th>Waktu Perjanjian</th>
                                        <th>Status</th>
                                        <!-- <th>Opsi</th> -->
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
                                                $id = $key->transaction_id; 
                                       
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $key->patient_name; ?></td>
                                            <td><?php echo $key->transaction_code; ?></td>
                                            <td><?php echo $key->transaction_arrangementdate; ?></td>
                                            <td>
                                                <?php 
                                                    if($key->transaction_status==1)
                                                    {
                                                        echo "<span class='label label-default'>Proses</span>";
                                                    }
                                                    elseif($key->transaction_status==2)
                                                    {
                                                        echo "<span class='label label-primary'>Berhasil</span>";
                                                    }
                                                ?>
                                            </td>
                                            <!-- <td>   
                                                <button class="btn btn-white btn-info btn-bold btn-md" onclick="window.location.href='<?php echo base_url();?>paramedic/visitingstage/detail_view?transaction=<?php echo base64_encode($key->transaction_id); ?>'">
                                                    <i class="material-icons">info</i> Info
                                                </button>
                                                
                                                <?php if($key->service_id == 19) { ?>
                                                    <?php if($key->transactiondetail_status == 3) { ?>
                                                        <button class="btn btn-white btn-success btn-bold btn-md" onclick="window.location.href='<?php echo base_url();?>paramedic/visitingstage/examination?transaction=<?php echo base64_encode($key->transaction_id); ?>&&service=<?php echo base64_encode($key->service_id); ?>'">
                                                            <i class="material-icons">accessible</i> Visit 
                                                        </button>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if($key->service_id == 20) { ?>
                                                    <?php if($key->transactiondetail_status == 3) { ?>
                                                        <button class="btn btn-white btn-success btn-bold btn-md" onclick="window.location.href='<?php echo base_url();?>paramedic/visitingstage/examination?transactiondetail_id=<?php echo base64_encode($key->transactiondetail_id); ?>&&service_id=<?php echo base64_encode($key->service_id); ?>'">
                                                            <i class="material-icons">accessible</i> Visit 
                                                        </button>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td> -->
                                        </tr>

                                        <!-- Modal Delete-->
                                        <div class="modal fade" id="deleteModal<?php echo $id;?>" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <?php echo form_open("paramedic/visitingstage/delete");?>
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Hapus Transaction</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger">
                                                                Apakah anda yakin ingin menghapus kode transaction  
                                                                "<b><?php echo $key->transaction_code?></b>" 
                                                                ?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" class="form-control" value="<?php echo $key->transaction_id?>" name="transaction_id" required="required">
                                                            <button type="submit" class="btn btn-danger">
                                                                Ya
                                                            </button>
                                                            <button class="btn" data-dismiss="modal" aria-hidden="true">
                                                                &nbsp;Batal
                                                            </button>
                                                        </div>
                                                    <?php echo form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Delete  -->

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