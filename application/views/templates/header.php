            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content m-b-30">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <nav class="navbar-custom">

                            <ul class="list-inline float-right mb-0">

                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img src="<?= base_url('assets/img/testimonials/testimonials-1.jpg'); ?>" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
                                        <div class="dropdown-item noti-title">
                                            <h5>Welcome</h5>
                                        </div>
                                        <a class="dropdown-item" href="<?= base_url('Profil') ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i><?= $this->session->userdata('username'); ?></a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                    </div>
                                </li>

                            </ul>
                            <div class="clearfix"></div>

                        </nav>

                    </div>
                    <!-- Top Bar End -->
                    <!-- Top Bar End -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
                                </div>
                                <div class="modal-body">Klik yakin jika anda ingin keluar</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    <a class="btn btn-primary" href="<?php echo base_url('auth/logout') ?>">Yakin</a>
                                </div>
                            </div>
                        </div>
                    </div>