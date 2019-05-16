    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo base_url();?>img/admin/<?php echo $admin[0]->image; ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $admin[0]->name_admin; ?></div>
                    <div class="email"><?php echo $admin[0]->email_admin; ?></div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="<?php if($this->uri->segment(2)==''){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>admin">
                            <i class="material-icons">home</i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='document'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>admin/document">
                            <i class="material-icons">storage</i>
                            <span>Dokumen</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='user'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>admin/user">
                            <i class="material-icons">person</i>
                            <span>Pengguna (User)</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='patient'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>admin/patient">
                            <i class="material-icons">accessible</i>
                            <span>Pasien</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='paramedic'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>admin/paramedic">
                            <i class="material-icons">group</i>
                            <span>Tenaga Kesehatan</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='paramediccategory'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>admin/paramediccategory">
                            <i class="material-icons">list</i>
                            <span>Profesi</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='service'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>admin/service">
                            <i class="material-icons">library_books</i>
                            <span>Layanan</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='package'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>admin/package">
                            <i class="material-icons">playlist_add_check</i>
                            <span>Paket</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='district'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>admin/district">
                            <i class="material-icons">location_on</i>
                            <span>Wilayah</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='slider'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>admin/slider">
                            <i class="material-icons">burst_mode</i>
                            <span>Slider</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='orderrequest' || $this->uri->segment(2)=='history' || $this->uri->segment(2)=='order'){echo "active";}?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">loop</i>
                            <span>Transaksi</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="<?php if($this->uri->segment(2)=='orderrequest'){echo "active";}?>">
                                <a href="<?php echo base_url(); ?>admin/orderrequest">
                                    <span>Permintaan</span>
                                </a>
                            </li>
                            <li class="<?php if($this->uri->segment(2)=='history'){echo "active";}?>">
                                <a href="<?php echo base_url(); ?>admin/history">
                                    <span>Riwayat</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='post' || $this->uri->segment(2)=='postcategory'){echo "active";}?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">subject</i>
                            <span>Blog</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="<?php if($this->uri->segment(2)=='post'){echo "active";}?>">
                                <a href="<?php echo base_url(); ?>admin/post">
                                    <span>Post</span>
                                </a>
                            </li>
                            <li class="<?php if($this->uri->segment(2)=='postcategory'){echo "active";}?>">
                                <a href="<?php echo base_url(); ?>admin/postcategory">
                                    <span>Kategori</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='profile'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>admin/profile">
                            <i class="material-icons">settings</i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/home/logout">
                            <i class="material-icons">logout</i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019 <a href="http://www.snhealthcenter.com" target="_blank">SN AL Kobar Health Center</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>
