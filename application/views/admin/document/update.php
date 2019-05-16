    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>admin/document"><i class="material-icons">storage</i> Dokumen</a></li>
                <li class="active"><i class="material-icons">mode_edit</i> Edit</li>
            </ol>
        </div>
        <div class="container-fluid">
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
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                EDIT DATA 
                                <small>Masukkan Data Yang Valid</small>
                            </h2>
                        </div>
                        <?php echo form_open_multipart('admin/document/update'); ?>
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="document_name">Nama Dokumen</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="document_name" class="form-control" name="document_name" placeholder="Masukkan Nama Dokumen" value="<?php echo $keys[0]['document_name']; ?>" autofocus>
                                                    <input type="hidden" id="document_id" class="form-control" name="document_id" value="<?php echo $keys[0]['document_id']; ?>">
                                                    <input type="hidden" id="document_file" class="form-control" name="document_file" value="<?php echo $keys[0]['document_file']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('document_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="document_file">Ganti File</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="document_file" class="form-control" name="userfile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="document_desc">Deskripsi</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="document_desc" placeholder="Masukkan Deskripsi"><?php echo $keys[0]['document_desc']; ?></textarea>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('document_desc'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="document_status">Status</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-radio-button">
                                                <?php 
                                                    if ($keys[0]['document_status'] == "1") 
                                                    {
                                                        echo "
                                                            <input name='document_status' type='radio' id='radio_1' value='1' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_1'>Aktif</label>
                                                            <input name='document_status' type='radio' id='radio_2' value='0' class='with-gap radio-col-green' />
                                                            <label for='radio_2'>Non Aktif</label>
                                                        ";
                                                    }
                                                    else
                                                    {
                                                        echo "
                                                            <input name='document_status' type='radio' id='radio_1' value='1' class='with-gap radio-col-green'/>
                                                            <label for='radio_1'>Aktif</label>
                                                            <input name='document_status' type='radio' id='radio_2' value='0' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_2'>Non Aktif</label>
                                                        ";
                                                    }
                                                ?>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('document_status'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Simpan Perubahan</button>
                                        <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/document'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
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

    <!-- Autosize Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/admin.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/demo.js"></script>

</body>
</html>
