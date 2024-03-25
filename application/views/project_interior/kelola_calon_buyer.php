<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Candratama</a></li>
                            <li class="breadcrumb-item active">Calon Buyer</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Calon Buyer</h4>
                </div>
            </div>
        </div>

        <div class="card m-b-30">
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="submit('tambah')">
                    <i class="mdi mdi-plus"></i>
                    Tambah Data
                </button>
                <hr>
                <!-- tabel data -->
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Alamat</th>
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
                                <label for="" class="col-sm-3 form-label">Kode Pemesanan</label>
                                <input type="hidden" class="form-control" name="id" id="id">
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kodep" id="kodep" placeholder="Masukkan kode pemesanan">
                                    <small class="text-danger pl-1" id="error-kodep"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 form-label">Nama Pemesan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="namap" id="namap" placeholder="Masukkan kode pemesanan">
                                    <small class="text-danger pl-1" id="error-namap"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan alamat pemesan" name="alamat" id="alamat">
                                    <small class="text-danger pl-1" id="error-alamat"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 form-label">Kota</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan kota pemesan" name="kota" id="kota">
                                    <small class="text-danger pl-1" id="error-kota"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 form-label">Telepon Pemesan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan telepon pemesan" name="telp" id="telp">
                                    <small class="text-danger pl-1" id="error-telp"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 form-label">Tanggal Pesan</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" placeholder="Masukkan tanggal pesan" name="tglp" id="tglp">
                                    <small class="text-danger pl-1" id="error-tglp"></small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btn-insert" onclick="insert_data()" class="btn btn-primary waves-effect waves-light">Tambah Data</button>
                            <button type="button" id="btn-update" onclick="edit_data()" class="btn btn-primary waves-effect waves-light">Simpan</button>
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
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>