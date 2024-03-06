            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <nav class="navbar-custom">

                            <ul class="list-inline float-right mb-0">

                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
                                        <div class="dropdown-item noti-title">
                                            <h5>Welcome</h5>
                                        </div>
                                        <a class="dropdown-item" href="<?= base_url('Kelola_user/get_profil') ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                    </div>
                                </li>

                            </ul>
                            <div class="clearfix"></div>

                        </nav>

                    </div>
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title center" id="exampleModalLabel"><i class="mdi mdi-alert"></i> Alert</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Apakah Anda yakin ingin keluar?</h5>
                                </div>
                                <div class="modal-footer d-flex justify-content-start">
                                    <div class="col-lg-6">
                                        <a href="<?= base_url('Auth/logout') ?>" class="btn btn-outline-primary btn-block">Ya!</a>
                                    </div>
                                    <div class="col-lg-6">
                                        <button type="button" id="btn-cancel" data-dismiss="modal" class="btn btn-outline-danger btn-block">Tidak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Top Bar End -->
                    <!-- Top Bar End -->