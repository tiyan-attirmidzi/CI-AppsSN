    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>admin/package"><i class="material-icons">playlist_add_check</i> Paket</a></li>
                <li class="active"><i class="material-icons">mode_edit</i> Edit Paket</li>
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
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                EDIT PAKET
                                <small>Masukkan Data Yang Valid</small>
                            </h2>
                        </div>
                        <div class="body">
                            <?php echo form_open_multipart('admin/package/edit'); ?>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="col-sm-12">
                                            <label for="package_name">Nama Paket</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="package_name" class="form-control" name="package_name" placeholder="Masukkan Nama Paket" value="<?php echo $key[0]['package_name']; ?>" autofocus>
                                                    <input type="hidden" id="package_id" class="form-control" name="package_id" value="<?php echo $key[0]['package_id']; ?>" >
                                                    <input type="hidden" id="package_image" class="form-control" name="package_image" value="<?php echo $key[0]['package_image']; ?>" >
                                                </div>
                                                <span class='text-danger'><?php echo form_error('package_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="paramediccategory_id">Tenaga Kesehatan Yang Dibutuhkan</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-checkbox">
                                                <?php foreach ($paramediccategory as $keys) { ?>
                                                    <input type="checkbox" id="md_checkbox_<?php echo $keys->paramediccategory_id; ?>" name="paramediccategory_id[]" class="chk-col-green" value="<?php echo $keys->paramediccategory_id; ?>"
                                                    <?php 
                                                        $arr = 0;
                                                        foreach($q[$arr] as $r)
                                                        {
                                                            if(
                                                            $r->paramediccategory_id==$keys->paramediccategory_id
                                                        )
                                                            {
                                                                echo "checked";
                                                            } 
                                                        }
                                                    ?> 
                                                    />
                                                    <label for="md_checkbox_<?php echo $keys->paramediccategory_id; ?>"><?php echo $keys->paramediccategory_name; ?></label><br>
                                                <?php $arr++; } ?> 
                                            </div>
                                            <span class='text-danger'><?php echo form_error('paramediccategory_id'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php if($key[0]['package_image']) { ?>
                                                <img src="<?php echo base_url(); ?>img/package/<?php echo $key[0]['package_image']; ?>" class="img-resposive center" width="50%">
                                        <?php } else { ?>
                                            <img width="50%" class="img-resposive center" src="<?php echo base_url('img/').'hospital.png'; ?>"> 
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="package_price">Tarif (Rp.)</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="package_price" class="form-control price" name="package_price" placeholder="Masukkan Tarif Paket" value="<?php echo $key[0]['package_price']; ?>">
                                            </div>
                                            <span class='text-danger'><?php echo form_error('package_price'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="package_desc">Deskripsi</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea name="package_desc" class="form-control" id="ckeditor2" cols="30" rows="20"><?php echo $key[0]['package_desc']; ?></textarea>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('package_desc'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="service_id">Layanan</label>
                                        <span class='text-danger'> *</span>
                                        <select class="form-control show-tick" id="service_id" name="service_id">
                                            <option value="">--- Pilih Layanan ---</option>
                                            <?php foreach ($service as $keys) { ?>
                                                <option value="<?php echo $keys->service_id; ?>" <?php if($key[0]['service_id']==$keys->service_id) echo 'selected' ?>><?php echo $keys->service_name; ?></option>
                                            <?php }; ?>
                                        </select>
                                        <span class='text-danger'><?php echo form_error('service_id'); ?></span>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="package_image">Ganti Gambar</label>
                                        <span class='text'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" id="package_image" class="form-control" name="package_image">
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        var ckeditor = CKEDITOR.replace('ckeditor');
                                    </script>
                                    <script>
                                        var ckeditor = CKEDITOR.replace('ckeditor2');
                                    </script>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Simpan</button>
                                        <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/package'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                    </div>
                                </div>   
                            <?php echo form_close(); ?>
                        </div>
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

    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){$('.price').mask('000.000.000', {reverse: true});})
    </script>

</body>
</html>  