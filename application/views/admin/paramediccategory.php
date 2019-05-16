    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li class="active"><i class="material-icons">list</i> Profesi Tenaga Kesehatan</li>
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
                                DAFTAR PROFESI TENAGA KESEHATAN
                                <!-- <small>Basic example without any additional modification classes</small> -->
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="javascript:void(0);" data-target="#myModal" data-toggle="modal" title="Tambah Profesi">
                                        <i class="material-icons">add</i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/paramediccategory" title="Refresh">
                                        <i class="material-icons">refresh</i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/paramediccategory/export" title="Download File">
                                        <i class="material-icons">file_download</i>
                                    </a>
                                </li>

                                <!-- Modal Add User-->
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>Tambah Profesi Tenaga kesehatan</b></h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open_multipart("admin/paramediccategory/input");?>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label>Nama Profesi</label>
                                                            <span class="text-danger"> *</span>
                                                            <input type="text" class="form-control" placeholder="Masukkan Nama Profesi" name="paramediccategory_name" required="required" autofocus>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Deskripsi</label>
                                                            <span class="text-danger"> *</span>
                                                            <textarea class="form-control" name="paramediccategory_desc" placeholder="Masukkan Deskripsi" rows="4" required="required"></textarea>
                                                        </div>
                                                    </div>                                
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">
                                                            Tambah
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
                                <!-- End Of Modal -->

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
                                        <?php echo form_open("admin/paramediccategory/result");?>
                                            <div class="col-md-3">
                                                <select class="form-control show-tick" name="column_name">
                                                    <option value="">Search by</option>
                                                    <?php
                                                        foreach ($column as $c) 
                                                        {
                                                            $col      = explode('_',$c->COLUMN_NAME);
                                                            $theName  = strtoupper($col[0].$col[1]);
                                                            if($c->COLUMN_NAME==$this->session->userdata('sess_search_paramediccategory2'))
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
                                                <?php if($this->session->userdata('sess_search_paramediccategory')) { ?>
                                                        <input type="text" class="form-control" placeholder="Search..." name="key" value="<?php echo $this->session->userdata('sess_search_paramediccategory')?>" />
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
                                        <th>Deskripsi</th>
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

                                        if (is_array($paramediccategory) || is_object($paramediccategory))
                                        {
                                            foreach ($paramediccategory as $key) 
                                            { 
                                                $id = $key->paramediccategory_id; 
                                       
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $key->paramediccategory_name; ?></td>
                                            <td><?php echo $key->paramediccategory_desc; ?></td>
                                            <td>
                                                <button class="btn btn-white btn-info btn-bold btn-md" data-toggle="modal" data-target="#editModal<?php echo $id?>" title="Edit Data">
                                                    <i class="material-icons">mode_edit</i>
                                                </button>
                                                <button class="btn btn-white btn-danger btn-bold btn-md" data-toggle="modal" data-target="#deleteModal<?php echo $id?>" title="Hapus Data">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Model Edit -->
                                        <div class="modal fade" id="editModal<?php echo $id?>" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->   
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title"><b>Ubah Data Profesi Tenaga Kesehatan</b></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo form_open("admin/paramediccategory/edit");?>
                                                            <div class="box-body">
                                                                <div class="nav-tabs-custom">
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane active">
                                                                            <div class="form-group alert-primery">
                                                                                <label>Nama</label>
                                                                                <span class="text-danger"> *</span>
                                                                                <input type="text" class="form-control"  value='<?php echo $key->paramediccategory_name; ?>' name="paramediccategory_name" required="required" placeholder="Nama Profesi" autofocus>
                                                                                <input type="hidden" class="form-control"  value='<?php echo $key->paramediccategory_id; ?>' name="paramediccategory_id" required="required" readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Deskripsi</label>
                                                                                <span class="text-danger"> *</span>
                                                                                <textarea class="form-control" name="paramediccategory_desc" required="required" rows="4" placeholder="Deskripsi Profesi"><?php echo $key->paramediccategory_desc;?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.tab-content -->
                                                                </div>
                                                            </div>
                                                            <!-- /.box-body -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Edit
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
                                        <!-- End Modal Edit -->

                                         <!-- Modal Delete-->
                                         <div class="modal fade" id="deleteModal<?php echo $id;?>" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <?php echo form_open("admin/paramediccategory/delete");?>
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Hapus Profesi Tenaga Kesehatan</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger">
                                                                Apakah anda yakin ingin menghapus Profesi
                                                                "<b><?php echo $key->paramediccategory_name?></b>" 
                                                                ?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" class="form-control" value="<?php echo $key->paramediccategory_id?>" name="paramediccategory_id" required="required">
                                                            <input type="hidden" class="form-control" value="<?php echo $key->paramediccategory_name?>" name="paramediccategory_name" required="required">
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
                                                location.href='<?php echo base_url()?>admin/paramedicategory/result/'+angka;    
                                            <?php } else { ?>
                                                location.href='<?php echo base_url()?>admin/paramedicategory/index/'+angka;    
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