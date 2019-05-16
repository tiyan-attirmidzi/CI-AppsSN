    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li class="active"><i class="material-icons">library_books</i> Layanan</li>
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
                                DAFTAR LAYANAN
                                <!-- <small>Basic example without any additional modification classes</small> -->
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/service/insert_view" title="Tambah Layanan">
                                        <i class="material-icons">add</i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/service" title="Refresh">
                                        <i class="material-icons">refresh</i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/service/export" title="Download File">
                                        <i class="material-icons">file_download</i>
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
                                        <?php echo form_open("admin/service/result");?>
                                            <div class="col-md-3">
                                                <select class="form-control show-tick" name="column_name">
                                                    <option value="">Search by</option>
                                                    <?php
                                                        foreach ($column as $c) 
                                                        {
                                                            $col      = explode('_',$c->COLUMN_NAME);
                                                            $theName  = strtoupper($col[0].$col[1]);
                                                            if($c->COLUMN_NAME==$this->session->userdata('sess_search_service2'))
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
                                                <?php if($this->session->userdata('sess_search_service')) { ?>
                                                        <input type="text" class="form-control" placeholder="Search..." name="key" value="<?php echo $this->session->userdata('sess_search_service')?>" />
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
                                        <th>Nama</th>
                                        <th>Kisaran Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
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

                                        if (is_array($service) || is_object($service))
                                        {
                                            foreach ($service as $key) 
                                            { 
                                                $id = $key->service_id; 
                                       
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $key->service_name; ?></td>
                                            <td><?php echo $key->service_pricerange; ?></td>
                                            <td><?php echo $key->service_desc; ?></td>
                                            <td>
                                                <?php            
                                                    if($key->service_status == 1)
                                                    {
                                                        echo '  
                                                                <span style="color: green;">
                                                                    <i class="glyphicon glyphicon-ok-sign fa-md"></i> 
                                                                </span> Aktif
                                                                ';
                                                    }
                                                            
                                                    else
                                                    {
                                                            echo '
                                                                <span style="color: red;">
                                                                    <i class="glyphicon glyphicon-remove-sign fa-md"></i> 
                                                                </span> Non Aktif
                                                                ';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-white btn-info btn-bold btn-md" onclick="window.location.href='<?php echo base_url();?>admin/service/update_view?service_id=<?php echo base64_encode($id); ?>'" title="Edit Data">
                                                    <i class="material-icons">mode_edit</i>
                                                </button>
                                                <!-- <button class="btn btn-white btn-danger btn-bold btn-md" data-toggle="modal" data-target="#deleteModal<?php echo $id?>">
                                                    <i class="material-icons">delete</i>
                                                </button> -->
                                            </td>
                                        </tr>

                                         <!-- Modal Delete-->
                                         <div class="modal fade" id="deleteModal<?php echo $id;?>" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <?php echo form_open("admin/service/delete");?>
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Hapus Paramedis</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger">
                                                                Apakah anda yakin ingin menghapus Layanan
                                                                "<b><?php echo $key->service_name?></b>" 
                                                                ?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" class="form-control" value="<?php echo $key->service_id?>" name="service_id" required="required">
                                                            <input type="hidden" class="form-control" value="<?php echo $key->service_image?>" name="service_image" required="required">
                                                            <input type="hidden" class="form-control" value="<?php echo $key->service_name?>" name="service_name" required="required">
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
                                                location.href='<?php echo base_url()?>admin/service/result/'+angka;    
                                            <?php } else { ?>
                                                location.href='<?php echo base_url()?>admin/service/index/'+angka;    
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