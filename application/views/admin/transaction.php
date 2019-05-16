        <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li class="active"><i class="material-icons">loop</i> Permintaan</li>
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
                                DAFTAR PERMINTAAN PESANAN
                                <!-- <small>Basic example without any additional modification classes</small> -->
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/orderrequest" title="Refresh">
                                        <i class="material-icons">refresh</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Kode Transaksi</th>
                                        <th>Waktu Perjanjian</th>
                                        <th>Pesan Untuk Paramedic</th>
                                        <th>Layanan</th>
                                        <th>Status</th>
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
                                            <td><?php echo $key->transaction_note; ?></td>
                                            <td><?php echo $key->service_name; ?></td>
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
                                        </tr>

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