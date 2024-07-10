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
            <?php if ($this->session->userdata('logged_in') && $this->session->userdata('id_credential') == '2' || $this->session->userdata('id_credential') == '5') : ?>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <a href="<?= base_url('Kelola_data_barang') ?>">
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
                    </a>
                </div>
            <?php endif; ?>
            <?php if ($this->session->userdata('logged_in') && $this->session->userdata('id_credential') == '2' || $this->session->userdata('id_credential') == '3') : ?>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <a href="<?= base_url('Project') ?>">
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
                                            <h5 class="mt-0 round-inner"><?= $project; ?></h5>
                                            <p class="mb-0 text-muted">Data Project</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <a href="<?= base_url('Kelola_data_buyer') ?>">
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
                                            <h5 class="mt-0 round-inner"><?= $customer; ?></h5>
                                            <p class="mb-0 text-muted">Customer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <a href="<?= base_url('Kelola_data_buyer_RO') ?>">
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
                                            <p class="mb-0 text-muted">Customer RO</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 align-self-center">
                <div class="card bg-white m-b-30">
                    <div class="card-body new-user">
                        <h5 class="header-title mb-4 mt-0">Data karyawan</h5>
                        <div class="table-responsive">
                            <?php if (!empty($karyawan)) : ?>
                                <table class="table table-hover" id="datatable-buttons">
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
                                        <?php foreach ($karyawan as $karyawan) : ?>
                                            <tr>
                                                <td><?php echo $karyawan->kodek; ?></td>
                                                <td><?= $karyawan->namak; ?></td>
                                                <td><?= $karyawan->alamat; ?></td>
                                                <td><?= $karyawan->kota; ?></td>
                                                <td><?= $karyawan->telp; ?></td>
                                                <td><?= $karyawan->status; ?></td>
                                                <td><?= $karyawan->jabatan; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <p>Belum ada data karyawanyawan</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
    </div><!-- container -->


</div> <!-- Page content Wrapper -->

</div> <!-- content -->