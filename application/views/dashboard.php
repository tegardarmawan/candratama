<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="Admin">Candratama</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <!-- card -->
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="col-4 align-self-center">
                                <div class="round">
                                    <i class="fa-solid fa-screwdriver-wrench"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-center">
                                <div class="m-l-10">
                                    <h5 class="mt-0 round-inner"><?= $barang; ?></h5>
                                    <p class="mb-0 text-muted">Data Barang</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="col-4 align-self-center">
                                <div class="round">
                                    <i class="fas fa-couch"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-center">
                                <div class="m-l-10">
                                    <h5 class="mt-0 round-inner"><?= $furniture;?></h5>
                                    <p class="mb-0 text-muted">Jumlah Furniture</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="col-4 align-self-center">
                                <div class="round">
                                    <i class="fas fa-hand-holding-hand"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-center">
                                <div class="m-l-10">
                                    <h5 class="mt-0 round-inner"><?= $prospek;?></h5>
                                    <p class="mb-0 text-muted">Data Prospek</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="col-4 align-self-center">
                                <div class="round">
                                    <i class="fas fa-people-group"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-center">
                                <div class="m-l-10">
                                    <h5 class="mt-0 round-inner"><?= $cb;?></h5>
                                    <p class="mb-0 text-muted">Calon Buyer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-8 align-self-center">
                <div class="card bg-white m-b-30">
                    <div class="card-body new-user">
                        <h5 class="header-title mb-4 mt-0">Data karyawan</h5>
                        <div class="table-responsive">
                            <?php if(!empty($karyawan)):?>
                            <table class="table table-hover" id="datatable-buttons" >
                                <thead>
                                    <tr>
                                        <th class="border-top-0" style="width:60px;">Kode</th>
                                        <th class="border-top-0">Nama</th>
                                        <th class="border-top-0">Alamat</th>
                                        <th class="border-top-0">Kota</th>
                                        <th class="border-top-0">Telepon</th>
                                        <th class="border-top-0">Status</th>
                                        <th class="border-top-0">Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($karyawan as $karyawan):?>
                                    <tr>
                                        <td><?php echo $karyawan->kodek;?></td>
                                        <td><?= $karyawan->namak;?></td>
                                        <td><?= $karyawan->alamat;?></td>
                                        <td><?= $karyawan->kota;?></td>
                                        <td><?= $karyawan->telp;?></td>
                                        <td><?= $karyawan->status;?></td>
                                        <td><?= $karyawan->jabatan;?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <p>Belum ada data karyawanyawan</p>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-4">
                <div class="card bg-white m-b-30">
                    <div class="card-body new-user">
                        <h5 class="header-title mt-0 mb-4">New Users</h5>
                        <ul class="list-unstyled mb-0 pr-3" id="boxscroll2" tabindex="1" style="overflow: hidden; outline: none;">
                            <li class="p-3">
                                <div class="media">
                                    <div class="thumb float-left">
                                        <a href="#">
                                            <img class=" rounded-circle" src="assets/images/users/avatar-5.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading mb-0">Ruby T. Curd <i class="fa fa-circle text-success mr-1 pull-right"></i></p>
                                        <small class="pull-right text-muted">Now</small>
                                        <small class="text-muted">Newyork</small>
                                    </div>
                                </div>
                            </li>
                            <li class="p-3">
                                <div class="media">
                                    <div class="thumb float-left">
                                        <a href="#">
                                            <img class=" rounded-circle" src="assets/images/users/avatar-4.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading mb-0">William A. Johnson <i class="fa fa-circle text-success mr-1 pull-right"></i></p>
                                        <small class="pull-right text-muted">Now</small>
                                        <small class="text-muted">California</small>
                                    </div>
                                </div>
                            </li>
                            <li class="p-3">
                                <div class="media">
                                    <div class="thumb float-left">
                                        <a href="#">
                                            <img class=" rounded-circle" src="assets/images/users/avatar-3.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading mb-0">Robert N. Carlile<i class="fa fa-circle text-danger mr-1 pull-right"></i></p>
                                        <small class="pull-right text-muted">10 min ago</small>
                                        <small class="text-muted">India</small>
                                    </div>
                                </div>
                            </li>
                            <li class="p-3">
                                <div class="media">
                                    <div class="thumb float-left">
                                        <a href="#">
                                            <img class=" rounded-circle" src="assets/images/users/avatar-2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading mb-0">Bobby M. Gray <i class="fa fa-circle text-success mr-1 pull-right"></i></p>
                                        <small class="pull-right text-muted">Now</small>
                                        <small class="text-muted">Australia</small>
                                    </div>
                                </div>
                            </li>
                            <li class="p-3">
                                <div class="media">
                                    <div class="thumb float-left">
                                        <a href="#">
                                            <img class=" rounded-circle" src="assets/images/users/avatar-1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading mb-0">Ruby T. Curd <i class="fa fa-circle text-danger mr-1 pull-right"></i></p>
                                        <small class="pull-right text-muted">36 min ago</small>
                                        <small class="text-muted">New Zealand</small>
                                    </div>
                                </div>
                            </li>
                            <li class="p-3">
                                <div class="media">
                                    <div class="thumb float-left">
                                        <a href="#">
                                            <img class=" rounded-circle" src="assets/images/users/avatar-6.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading mb-0">Robert N. Carlile <i class="fa fa-circle text-success mr-1 pull-right"></i></p>
                                        <small class="pull-right text-muted">Now</small>
                                        <small class="text-muted">India</small>
                                    </div>
                                </div>
                            </li>
                            <li class="p-3">
                                <div class="media">
                                    <div class="thumb float-left">
                                        <a href="#">
                                            <img class=" rounded-circle" src="assets/images/users/avatar-4.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading mb-0">Bobby M. Gray<i class="fa fa-circle text-danger mr-1 pull-right"></i></p>
                                        <small class="pull-right text-muted">58 min ago</small>
                                        <small class="text-muted">Australia</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
    </div><!-- container -->


</div> <!-- Page content Wrapper -->

</div> <!-- content -->