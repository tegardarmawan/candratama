<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Candratama</a></li>
                            <li class="breadcrumb-item active">Kelola Data Satuan Barang</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Satuan Barang</h4>
                </div>
            </div>
        </div>

        <div class="card m-b-30">
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="submit('tambah')">
                    <i class="mdi mdi-plus"></i>
                    Tambah Data
                    <!-- id kodek no_induk namak tempat tgl alamat kota telp status jabatan -->
                </button>
                <hr>
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Satuan</th>
                            <th>Nama Satuan</th>
                            <th>Aksi</th>
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
                                <label for="kode" class="col-sm-3 col-form-label">Kode Satuan</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" class="form-control" value="">
                                    <input type="text" name="kode" class="form-control" id="kode" readonly value="<?= $kodeSatuan; ?>">
                                    <small class="text-danger pl-1" id="error-kode"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama Satuan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Satuan">
                                    <small class="text-danger pl-1" id="error-nama"></small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" id="btn-insert" onclick="insert_data()">Tambah Data</button>
                            <button type="button" class="btn btn-outline-primary" id="btn-update" onclick="edit_data()">Simpan</button>
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
<script>
    var kodesatuan = '<?= $kodeSatuan; ?>';
</script>