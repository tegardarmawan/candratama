<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Candratama</a></li>
                            <li class="breadcrumb-item active">Data Log User</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Log</h4>
                </div>
            </div>
        </div>

        <div class="card m-b-30">
            <div class="card-body">
                <!-- tabel data -->
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>Aksi</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- Modal lihat dan hapus data -->
        <div class="modal fade bs-example-modal-lg" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label for="example-text-input" class="col-sm-3 col-form-label">User</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id" class="form-control" value="">
                                <input class="form-control" type="text" id="user" name="user" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 form-label">Aksi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="aksi" id="aksi" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 form-label">Menu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="menu" id="menu" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="keterangan" id="keterangan" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 form-label">Waktu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="waktu" id="waktu" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-toggle="modal" data-animation="bounce" data-target="#modalHapus" class="btn btn-danger">Hapus Data</button>
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

        <script>
            var base_url = '<?php echo base_url() ?>';
            var _controller = '<?= $this->router->fetch_class() ?>';
        </script>