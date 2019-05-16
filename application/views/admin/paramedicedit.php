                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Account Settings</h3>
                    </div>
                    <?php      
                        $message = $this->session->flashdata('notif');
                        if($message)
                        {
                            echo '<p class="alert alert-success text-center">'.$message .'</p>';
                        }          
                        $message = $this->session->flashdata('notif2');
                        if($message)
                        {
                            echo '<p class="alert alert-success text-center">'.$message .'</p>';
                        }
                        $message = $this->session->flashdata('notif3');
                        if($message)
                        {
                            echo '<p class="alert alert-danger text-center">'.$message .'</p>';
                        }
                        $message = $this->session->flashdata('notif4');
                        if($message)
                        {
                            echo '<p class="alert alert-success text-center">'.$message .'</p>';
                        }   
                    ?> 
                    <div id="main-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading clearfix">
                                        <h1 class="panel-title">Account</h1>
                                    </div>
                                    <?php echo form_open_multipart('admin/paramedic/edit','class="form-horizontal"');?>
                                        <div class="panel-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Nama</label>
                                                        <span class="text-danger"> *</span>
                                                        <input type="text" class="form-control" placeholder="Masukkan Nama" value="<?php echo $paramedic[0]->paramedic_name; ?>" name="paramedic_name" required="required">
                                                        <input name="paramedic_id" type="hidden" class="form-control" placeholder="id" value="<?php echo $paramedic[0]->paramedic_id; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Username</label>
                                                        <input name="username_admin" type="text" class="form-control" placeholder="Username" value="<?php echo $admin[0]->username_admin; ?>" required>                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Email</label>
                                                        <input name="email_admin" type="text" class="form-control" placeholder="Email" value="<?php echo $admin[0]->email_admin; ?>" required>                                                                                                                
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Phone</label>
                                                        <input name="phone_admin" type="text" class="form-control" placeholder="Phone" value="<?php echo $admin[0]->phone_admin; ?>" required>                                                                                                                
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <label>Ganti Foto</label>
                                                        <input type="file" class="form-control" name="userfile">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-offset-0 col-sm-12">
                                                        <img src="<?php echo base_url();?>img/admin/<?php echo $admin[0]->image; ?>" class="img-resposive center1" width="50%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-sm-offset-0 col-sm-12">
                                                    <button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading clearfix">
                                        <h4 class="panel-title">Ganti Password</h4>
                                    </div>
                                    <?php echo form_open('admin/profile_admin/change_password','class="form-horizontal"');?>
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Password Lama</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" placeholder="Password Lama" required name="old_pass">
                                                        <input type="hidden" class="form-control" placeholder="Password Lama" required value="<?php echo $admin[0]->password_admin; ?>" name="conf_old_pass">
                                                    </div>
                                                </div><hr>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Password Baru</label>
                                                    <div class="col-sm-8">
                                                        <input name="id_admin" type="hidden" class="form-control" placeholder="id" value="<?php echo $admin[0]->id_admin; ?>" required>
                                                        <input type="password" class="form-control" placeholder="Password Baru" required name="new_pass" minlength="8" maxlength="30">
                                                        <p class="help-block" style="margin-bottom:0;">Minimal 8 Character</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Konfirmasi Password Baru</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" placeholder="Konfirmasi Password Baru" required name="conf_new_pass" minlength="8" maxlength="30">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-sm-offset-0 col-sm-12">
                                                    <button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Ganti Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading clearfix">
                                        <h4 class="panel-title">Company</h4>
                                    </div>
                                    <?php echo form_open_multipart('admin/profile_admin/edit_company','class="form-horizontal"');?>
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Nama Company</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" placeholder="Nama Company" required value="<?php echo $company[0]->company_name; ?>" name="company_name"> 
                                                        <input type="hidden" class="form-control" required value="<?php echo $company[0]->company_id; ?>" name="company_id"> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Ganti Foto</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" name="userfile">
                                                        <img src="<?php echo base_url();?>img/admin/<?php echo $company[0]->company_image; ?>" class="img-resposive center3" width="30%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-sm-offset-0 col-sm-12">
                                                    <button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>                                    
                                </div>
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