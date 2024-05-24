<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Data Project</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Project</h4>
                </div>
            </div>
        </div>
        <div class="card m-b-30">
            <div class="card-body">
                <!-- Button trigger modal -->
                <a href="<?= base_url('Project_warehouse_new') ?>">
                    <button type="button" class="btn btn-primary waves-effect waves-light">
                        <i class="mdi mdi-plus"></i>
                        Tambah Data
                    </button>
                </a>
                <hr>
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nota</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Jumlah Keluar</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- modal lihat detail -->
            <div class="modal fade bs-example-modal-lg" id="lihat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myLargeModalLabel">Nota >> Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Nota Project</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="hidden" id="id" name="id" readonly>
                                    <input class="form-control" type="text" id="nota" name="nota" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input class="form-control datepicker" type="text" id="tgl" name="tgl" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Kode Barang</label>
                                <div class="col-sm-9">
                                    <textarea required class="form-control" rows="5" id="kodeb" name="kodeb" readonly></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Nama Barang</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="namab" name="namab" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Keluar</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="keluar" name="keluar" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Satuan</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="satuan" name="satuan" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="keluar1" name="keluar1" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">no</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="keluar" name="keluar" readonly>
                                </div>
                            </div>
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
                                <button type="button" id="btn-hapus" ata-dismiss="modal" class="btn btn-outline-primary btn-block">Ya!</button>
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
</div>
</div>