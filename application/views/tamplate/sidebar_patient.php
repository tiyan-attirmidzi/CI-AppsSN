    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo base_url();?>img/user/<?php echo $user[0]->user_image; ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user[0]->user_name; ?></div>
                    <div class="email"><?php echo $user[0]->user_email; ?></div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="<?php if($this->uri->segment(2)==''){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>patient">
                            <i class="material-icons">home</i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='profile'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>patient/profile">
                            <i class="material-icons">person</i>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='order'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>patient/order">
                            <i class="material-icons">add_box</i>
                            <span>Pesan</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='transaction'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>patient/transaction">
                            <i class="material-icons">loop</i>
                            <span>Pemesanan</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='history'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>patient/history">
                            <i class="material-icons">history</i>
                            <span>Riwayat</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>patient/home/logout">
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
