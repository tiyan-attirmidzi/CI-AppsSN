    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo base_url();?>img/paramedic/<?php echo $paramedic[0]->paramedic_image; ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $paramedic[0]->paramedic_name; ?></div>
                    <div class="email"><?php echo $paramedic[0]->paramedic_email; ?></div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="<?php if($this->uri->segment(2)==''){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>paramedic">
                            <i class="material-icons">home</i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='document'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>paramedic/document">
                            <i class="material-icons">storage</i>
                            <span>Dokumen</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='profile'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>paramedic/profile">
                            <i class="material-icons">person</i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='requestconfirmation'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>paramedic/requestconfirmation">
                            <i class="material-icons">loop</i>
                            <span>Permintaan</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='visitingstage'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>paramedic/visitingstage">
                            <i class="material-icons">accessible</i>
                            <span>Visit</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='history'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>paramedic/history">
                            <i class="material-icons">history</i>
                            <span>Riwayat</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>paramedic/home/logout">
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
