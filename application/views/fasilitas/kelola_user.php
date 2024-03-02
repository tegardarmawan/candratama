<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Candratama</a></li>
                            <li class="breadcrumb-item active">Data User</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data User</h4>
                </div>
            </div>
        </div>

        <div class="card m-b-30">
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="submit('tambah')">
                    <i class="mdi mdi-plus"></i>
                    Tambah User
                </button>
                <hr>
                <!-- tabel data -->
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="20%">Kode User</th>
                            <th width="20%">Nama</th>
                            <th width="20%">Username</th>
                            <th width="20%">Password</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                </table>

            </div>



            <!-- Modal tambah/edit data -->
            <div class="modal fade bs-example-modal-lg" id="insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" name="title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Kode</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" class="form-control" value="">
                                    <input class="form-control" type="text" id="kode" name="kode" placeholder="Masukkan kode user">
                                    <small class="text-danger pl-1" id="error-kode"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="nama" name="nama" placeholder="Masukkan nama user">
                                    <small class="text-danger pl-1" id="error-nama"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="Masukkan username" class="form-control" name="username" id="username">
                                    <small class="text-danger pl-1" id="error-username"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 md-6">
                                    <label for="password" class="form-label" id="passwordLabel">Password</label>
                                    <div class="">
                                        <input type="password" placeholder="Masukkan password" class="form-control" name="password" id="password">
                                        <small class="text-danger pl-1" id="error-password"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 md-6">
                                    <label for="password1" class="form-label" id="passwordLabel1">Ulangi</label>
                                    <div class="">
                                        <input type="password" placeholder="Ulangi password" class="form-control" name="password1" id="password1">
                                        <small class="text-danger pl-1" id="error-password1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="showPasswordCheckbox" />
                                <label class="form-check-label" for="showPasswordCheckbox">
                                    Show
                                    Password
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btn-insert" onclick="insert_data()" class="btn btn-outline-primary">Tambah Data</button>
                            <button type="button" id="btn-update" onclick="edit_data()" class="btn btn-outline-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal hapus data -->
            <div class="modal fade bs-example-modal-center" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title center" id="exampleModalLabel"><i class="mdi mdi-alert"></i> Alert</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Apakah anda yakin ingin menghapus data ini?</h5>
                        </div>
                        <div class="modal-footer d-flex justify-content-start">
                            <div class="col-lg-6">
                                <button type="button" id="btn-hapus" data-dismiss="modal" class="btn btn-outline-primary btn-block">Ya!</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="button" id="btn-cancel" data-dismiss="modal" class="btn btn-outline-danger btn-block">Tidak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>