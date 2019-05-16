                <!--page inner-->
                <div class="page-inner">

                    <!-- Page Title -->
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Data Pasien</h3>
                    </div>
                    <!-- /Page Title -->

                    <!-- Main Wrapper -->
                    <div id="main-wrapper">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="btn-group">

                                    <!-- Btn Add Patient -->
                                    <button class="btn btn-white btn-info btn-bold tooltip-success" data-toggle="modal" data-target="#myModal">
                                        <i class="ace-icon fa fa-plus bigger-120 blue"></i> Tambah
                                    </button>
                        
                                    <!-- Btn Refresh Page -->
                                    <a href="<?php echo site_url('admin/patient')?>" class="btn btn-white btn-success btn-bold tooltip-success" data-rel="tooltip" data-placement="top" title="Refresh Page" style="margin-left: 3px;">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </a>

                                    <!-- Btn Export Data to Excel -->
                                    <a href="<?php echo base_url('admin/patient/export')?>" class="btn btn-white btn-success btn-bold tooltip-success" data-rel="tooltip" data-placement="top" title="Export" style="margin-left: 3px;">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                
                                    <!-- Modal Add Patient-->
                                    <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"><b>Tambah Pasien Baru</b></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo form_open_multipart("admin/patient/input");?>
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label>Nama</label>
                                                                <span class="text-danger"> *</span>
                                                                <input type="text" class="form-control" placeholder="Masukkan Nama" name="patient_name" required="required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Jenis Kelamin</label>
                                                                <span class="text-danger"> *</span>
                                                                <select class="form-control" name="patient_sex" required="required">
                                                                    <option value="">Pilih Jenis Kelamin</option>
                                                                    <option value="Laki-laki">Laki-laki</option>
                                                                    <option value="Perempuan">Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tanggal Lahir</label>
                                                                <span class="text-danger"> *</span>
                                                                <input type="date" class="form-control" name="patient_datebirth" required="required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nomor Handphone</label>
                                                                <span class="text-danger"> *</span>
                                                                <input type="text" pattern="^\d{12}$" name="patient_phone" class="form-control" minlength="12" maxlength="12" required="required" placeholder="Masukkan Nomor Handphone">
                                                                <i>
                                                                    <small class="form-text text-muted">Format : 082233445566</small>
                                                                </i>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Wilayah Kecamatan</label>
                                                                <span class="text-danger"> *</span>
                                                                <select class="form-control" name="district_id" required="required">
                                                                    <option value="">Pilih Wilayah Kecamatan</option>
                                                                    <?php 
                                                                        $data = $this->model_patient->fetch_district();
                                                                        foreach($district as $value) { ?>
                                                                            <option value="<?php echo $value->district_id ?>">
                                                                                <?php echo $value->district_name ?>
                                                                            </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Alamat</label>
                                                                <span class="text-danger"> *</span>
                                                                <textarea class="form-control" name="patient_address" placeholder="Masukkan Alamat" required="required" rows="4"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Foto</label>
                                                                <span class="text-danger"> *</span>
                                                                <input type="file" class="form-control" name="userfile">
                                                            </div>
                                                            <li role="separator" class="divider"></li>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <span class="text-danger"> *</span>
                                                                <input type="email" class="form-control"  name="patient_email" placeholder="Masukkan Email" required="required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <span class="text-danger"> *</span>
                                                                <input type="password" class="form-control"  name="patient_password" placeholder="Masukkan Password" required="required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Konfirmasi Password</label>
                                                                <span class="text-danger"> *</span>
                                                                <input type="password" class="form-control"  name="conf_patient_password" placeholder="Masukkan Konfirmasi Password" required="required">
                                                            </div>
                                                            <li role="separator" class="divider"></li>
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <span class="text-danger"> *</span>
                                                                <select class="form-control" name="patient_status" required="required">
                                                                    <option value="">Pilih Status</option>
                                                                    <option value="0">Non Aktif</option>
                                                                    <option value="1">Aktif</option>
                                                                </select>
                                                            </div>
                                                        </div>                                
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                                        </div>
                                                    <?php echo form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Of Modal -->

                                </div>
                            </div><br><br>

                            <div class="col-md-12">
                                <div class="panel panel-white">

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="pull-left">rows 
                                                <div class="btn-group">
                                                    <!-- Combo Limit Rows Table -->
                                                    <select class="form-control" id="getrows" onchange="getrows(this.value)">
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
                                                    <!-- End Combo Limit Rows Table -->
                                                </div>
                                            </div>

                                            <div class="pull-right">
                                                <!-- Form Search -->
                                                <?php echo form_open("admin/patient/result", "class='form-inline'");?>
                                                    <div class="btn-group">
                                                        <select class=" form-control input-large" name="column_name">
                                                            <option value="">Search by</option>
                                                            <?php
                                                                foreach ($column as $c) 
                                                                {
                                                                    $col      = explode('_',$c->COLUMN_NAME);
                                                                    $theName  = strtoupper($col[0].$col[1]);
                                                                    if($c->COLUMN_NAME==$this->session->userdata('sess_search_patient2'))
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

                                                        <?php if($this->session->userdata('sess_search_patient')) 

                                                                { 

                                                        ?>
                                                                <input type="text" class="form-control" placeholder="Search..." name="key" value="<?php echo $this->session->userdata('sess_search_patient')?>" />
                                                        <?php   
                                                                } 
                                                                else
                                                                { 
                                                        ?>
                                                                <input type="text" class="form-control" placeholder="Search..." name="key" />
                                                        <?php   
                                                                } 
                                                        ?>
                                                    </div>
                                                    <button class="btn btn-white btn-info btn-bold">
                                                        <i class="ace-icon fa fa-search bigger-120 blue"></i> Search
                                                    </button>
                                                <?php echo form_close();?>
                                                <!-- End Form Search -->
                                            </div>

                                        </div>
                                    </div><br>

                                    <?php      
                                        $message = $this->session->flashdata('notif_patient1');
                                        if($message)
                                        {
                                            echo '<p class="alert alert-success text-center">'.$message .'</p>';
                                        }
                                        $message = $this->session->flashdata('notif_patient2');
                                        if($message)
                                        {
                                            echo '<p class="alert alert-danger text-center">'.$message .'</p>';
                                        }
                                        $message = $this->session->flashdata('notif_patientedit1');
                                        if($message)
                                        {
                                            echo '<p class="alert alert-success text-center">'.$message .'</p>';
                                        }
                                        $message = $this->session->flashdata('notif_patientedit2');
                                        if($message)
                                        {
                                            echo '<p class="alert alert-danger text-center">'.$message .'</p>';
                                        }
                                        $message = $this->session->flashdata('notif_patientedit3');
                                        if($message)
                                        {
                                            echo '<p class="alert alert-danger text-center">'.$message .'</p>';
                                        }
                                    ?> 

                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Email</th>
                                                        <th>No. Phone</th>
                                                        <th>Alamat</th>
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

                                                        if (is_array($patient) || is_object($patient))
                                                        {
                                                            foreach ($patient as $key)
                                                            {
                                                                $id = $key->patient_id;

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $key->patient_name ?></td>
                                                        <td><?php echo $key->patient_sex ?></td>
                                                        <td><?php echo $key->patient_email ?></td>
                                                        <td><?php echo $key->patient_phone ?></td>
                                                        <td><?php echo $key->patient_address ?></td>
                                                        <td>
                                                            <?php 
                                                            
                                                                if($key->patient_status == 1)
                                                                {
                                                                    echo '  
                                                                            <span style="color: green;">
                                                                                <i class="fa fa-circle fa-md"></i> 
                                                                            </span> Aktif
                                                                        ';
                                                                }

                                                                else
                                                                {
                                                                    echo '
                                                                            <span style="color: red;">
                                                                                <i class="fa fa-circle fa-md"></i> 
                                                                            </span> Non Aktif
                                                                        ';
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-white btn-info btn-bold btn-md" data-toggle="modal" data-target="#editModal<?php echo $id;?>">
                                                                <i class="ace-icon fa fa-edit bigger-120 blue"></i> Edit
                                                            </button>
                                                            <button class="btn btn-white btn-danger btn-bold btn-md" data-toggle="modal" data-target="#deleteModal<?php echo $id?>">
                                                                <i class="ace-icon fa fa-trash bigger-120 red"></i> Hapus
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
                                                                    <h4 class="modal-title"><b>Ubah Data Pasien</b></h4>
                                                                </div>
                                                                <img style="width : 50%" class="center" src="<?php echo base_url('img/patient/').$key->patient_image ?>"><br>
                                                                <div class="modal-body">
                                                                    <?php echo form_open_multipart("admin/patient/edit");?>
                                                                        <div class="box-body">
                                                                            <div class="nav-tabs-custom">
                                                                                <ul class="nav nav-tabs">
                                                                                    <li class="active">
                                                                                        <a href="#tab_1<?php echo $id?>" data-toggle="tab">Biodata</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="#tab_2<?php echo $id?>" data-toggle="tab">Email</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="#tab_3<?php echo $id?>" data-toggle="tab">Ganti Password</a>
                                                                                    </li>
                                                                                </ul>
                                                                                <div class="tab-content">
                                                                                    <div class="tab-pane active" id="tab_1<?php echo $id?>">
                                                                                        <div class="form-group">
                                                                                            <label>Nama</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <input type="text" class="form-control"  value='<?php echo $key->patient_name; ?>' name="patient_name" required="required" placeholder="Name">
                                                                                            <input type="hidden" class="form-control"  value='<?php echo $key->patient_id; ?>' name="patient_id" required="required" readonly>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Jenis Kelamin</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <select class="form-control" name="patient_sex" required="required">
                                                                                                <option value="">Pilih Jenis Kelamin</option>
                                                                                                <?php  
                                                                                                    if ($key->patient_sex == "Laki-laki") 
                                                                                                    {
                                                                                                        echo "
                                                                                                            <option value='Laki-laki' selected>Laki-laki</option>
                                                                                                            <option value='Perempuan'>Perempuan</option>
                                                                                                        ";
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                        echo "
                                                                                                            <option value='Laki-laki'>Laki-laki</option>
                                                                                                            <option value='Perempuan' selected>Perempuan</option>
                                                                                                        ";
                                                                                                    }

                                                                                                ?>
                                                                                            </select>
                                                                                        </div>   
                                                                                        <div class="form-group">
                                                                                            <label>Tanggal Lahir</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <input type="date" class="form-control"  value='<?php echo $key->patient_datebirth;?>' name="patient_datebirth" required="required">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Nomor Handphone</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <input type="text" pattern="^\d{12}$" name="patient_phone" id="no_hp" class="form-control" minlength="12" maxlength="12" required="required" value='<?php echo $key->patient_phone;?>'>
                                                                                            <i>
                                                                                                <small class="form-text text-muted">Format : 082233445566</small>
                                                                                            </i>
                                                                                        </div>
                                                                                        <?php  

                                                                                            $dis = $key->district_id;

                                                                                        ?>
                                                                                        <div class="form-group">
                                                                                            <label>Wilayah Kecamatan</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <select class="form-control" name="district_id" required="required">
                                                                                                <option value="">--- Pilih Wilayah Kecamatan ---</option>
                                                                                                <?php 
                                                                                                    $data = $this->model_patient->fetch_district();
                                                                                                    foreach($district as $value) { ?>
                                                                                                        <option value="<?php echo $value->district_id;?>" <?php if($dis==$value->district_id) echo 'selected' ?>>
                                                                                                            <?php echo $value->district_name ?>
                                                                                                        </option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Alamat</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <textarea class="form-control" name="patient_address" required="required" rows="4"><?php echo $key->patient_address;?></textarea>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Ganti Foto</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <input type="file" class="form-control" name="userfile">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Status</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <select class="form-control" name="patient_status" required="required">
                                                                                                <option value="">Pilih Status</option>
                                                                                                <?php  
                                                                                                    if ($key->patient_status == "1") 
                                                                                                    {
                                                                                                        echo "
                                                                                                            <option value='0'>Non Aktif</option>
                                                                                                            <option value='1' selected>Aktif</option>
                                                                                                        ";
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                        echo "
                                                                                                            <option value='0' selected>Non Aktif</option>
                                                                                                            <option value='1'>Aktif</option>
                                                                                                        ";
                                                                                                    }

                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="tab-pane" id="tab_2<?php echo $id?>">
                                                                                        <div class="form-group">
                                                                                            <label>Email</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <input type="email" class="form-control"  value='<?php echo $key->patient_email; ?>' name="patient_email" readonly placeholder="Email">
                                                                                        </div>  
                                                                                    </div>

                                                                                    <div class="tab-pane" id="tab_3<?php echo $id?>">
                                                                                        <div class="form-group">
                                                                                            <label>Password Lama</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <input type="password" class="form-control" name="patient_password_old" placeholder="Masukkan Password Lama">
                                                                                            <input type="hidden" class="form-control" name="patient_password" required="required" value="<?php echo $key->patient_password;?>">
                                                                                        </div>                      
                                                                                        <div class="form-group">
                                                                                            <label>Password Baru</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <input type="password" class="form-control" name="patient_password_new" placeholder="Masukkan Password Baru">
                                                                                        </div>                      
                                                                                        <div class="form-group">
                                                                                            <label>Konfirmasi Password Baru</label>
                                                                                            <span class="text-danger"> *</span>
                                                                                            <input type="password" class="form-control" name="patient_password_newconfirm" placeholder="Masukkan Konfirmasi Password Baru">
                                                                                        </div>        
                                                                                    </div>

                                                                                </div>
                                                                                <!-- /.tab-content -->
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.box-body -->
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                                        </div>
                                                                        <!-- /.box-footer -->
                                                                    <?php echo form_close(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Model Edit -->

                                                    <!-- Modal Delete-->
                                                    <div class="modal fade" id="deleteModal<?php echo $id;?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <?php echo form_open("admin/patient/delete");?>
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">Hapus Pasien</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="alert alert-danger">
                                                                            Apakah anda yakin ingin menghapus  
                                                                            "<b><?php echo $key->patient_name?></b>" 
                                                                            ?
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" class="form-control" value="<?php echo $key->patient_id?>" name="patient_id" required="required">
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

                                                    <?php $no++; } } ?>
                                                </tbody>
                                            </table>  
                                        </div>
                                        
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
                                                        if ($this->uri->segment(3)=='result') 
                                                        {
                                                            location.href='<?php echo base_url()?>admin/patient/result/'+angka;    
                                                        }
                                                        else
                                                        { 
                                                            location.href='<?php echo base_url()?>admin/patient/index/'+angka;       
                                                        }  
                                                    }
                                                });
                                            }
                                        </script>
                                        <!-- End Limit Rows using ajax -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Main Wrapper -->

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