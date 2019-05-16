    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li class="active"><i class="material-icons">loop</i> Riwayat</li>
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
                                DAFTAR RIWAYAT PEMESANAN
                                <!-- <small>Basic example without any additional modification classes</small> -->
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/history" title="Refresh">
                                        <i class="material-icons">refresh</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="col-md-5">
                                        <div class="col-md-1">
                                            Rows
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control show-tick" id="getrows" onchange="getrows(this.value)">
                                                <?php 
                                                    $rw=array(1=>10, 25, 50, 100);
                                                    for($i=1;$i<=count($rw);$i++) 
                                                    {
                                                        if($rw[$i]==$this->uri->segment(4)) 
                                                        {
                                                            echo "<option value='$rw[$i]' selected/>$rw[$i]</option>";
                                                        } 
                                                        else 
                                                        {
                                                            echo "<option value='$rw[$i]'/>$rw[$i]</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <?php echo form_open("admin/history/result");?>
                                            <div class="col-md-3">
                                                <select class="form-control show-tick" name="column_name">
                                                    <option value="">Search by</option>
                                                    <?php
                                                        foreach ($column as $c) 
                                                        {
                                                            $col      = explode('_',$c->COLUMN_NAME);
                                                            $theName  = strtoupper($col[0].$col[1]);
                                                            if($c->COLUMN_NAME==$this->session->userdata('sess_search_transaction2'))
                                                            {
                                                    ?>
                                                    <option value="<?php echo $c->COLUMN_NAME;?>" selected><?php echo $theName;?></option>
                                                    <?php 
                                                            } 
                                                            else 
                                                            { 
                                                    ?>
                                                    <option value="<?php echo $c->COLUMN_NAME;?>"><?php echo $theName;?></option>
                                                    <?php   
                                                            }
                                                        } 
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <?php if($this->session->userdata('sess_search_transaction')) { ?>
                                                        <input type="text" class="form-control" placeholder="Search..." name="key" value="<?php echo $this->session->userdata('sess_search_transaction')?>" />
                                                <?php   } 
                                                        else
                                                        {    
                                                ?>
                                                        <input type="text" class="form-control" placeholder="Search..." name="key" />
                                                <?php   
                                                        } 
                                                ?>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-default waves-effect">
                                                    <i class="material-icons">search</i>
                                                    <span>Search</span>
                                                </button>
                                            </div>
                                        <?php echo form_close();?>
                                        <!-- End Form Search -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
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
                                            <td><?php echo $key->transaction_date; ?></td>
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
                                            <td>
                                                <button class="btn btn-white btn-info btn-bold btn-md" onclick="window.location.href='<?php echo base_url();?>admin/history/detail_view?transaction_id=<?php echo $id?>'">
                                                    <i class="material-icons">info</i> Info
                                                </button>
                                            </td>
                                        </tr>

                                    <?php $no++; }; }; ?>
                                </tbody>
                            </table>

                            <!-- Pagging -->
                            <?php echo $links; ?>
                            <!-- End Pagging -->
    
                            <!-- Get Limit Rows using ajax -->
                            <script type="text/javascript">
                                function getrows(angka)
                                {
                                    var product_code = angka;
                                    console.log(product_code);
                                    $.ajax({
                                        success:function()
                                        {
                                            <?php if($this->uri->segment(3)=='result') { ?>
                                                location.href='<?php echo base_url()?>admin/history/result/'+angka;    
                                            <?php } else { ?>
                                                location.href='<?php echo base_url()?>admin/history/index/'+angka;    
                                            <?php } ?> 
                                        }
                                    });
                                }
                            </script>
                            <!-- End Limit Rows using ajax -->
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