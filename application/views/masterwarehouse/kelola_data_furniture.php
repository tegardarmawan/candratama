<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Kelola Data Furniture</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Furniture</h4>
                </div>
            </div>
        </div>

        <div class="card m-b-30">
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="submit('tambah')">
                    <i class="mdi mdi-plus"></i>
                    Tambah Data
                </button>
                <hr>
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="5%">Kode Furniture</th>
                            <th width="20%">Nama Furniture</th>
                            <th width="5%">Satuan</th>
                            <th width="25%">Keterangan</th>
                            <th width="25%">Harga Jual</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>



            <!-- Modal tambah/edit data -->
            <!-- id kodef namaf satuan ket hjual => database -->
            <div class="modal fade bs-example-modal-lg" id="insert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myLargeModalLabel" name="title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="kode" class="col-sm-3 col-form-label">Kode Furniture</label>
                                <input type="hidden" class="form-control" name="id" id="id" >
                                <div class="col-sm-9">
                                    <input required class="form-control" name="kode" id="kode" placeholder="Masukkan Kode Furniture" type="text">
                                    <small class="text-danger pl-1" id="error-kode"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Furniture</label>
                                <div class="col-sm-9">
                                    <input type="" text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Furniture">
                                    <small class="text-danger pl-1" id="error-nama"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="satuan" class="col-sm-3 col-form-label">Kode Satuan</label>
                                <div class="col-sm-9">
                                    <select name="satuan" id="satuan" class="select2 form-control custom-select">
                                        <option value="">Pilih Satuan</option>
                                        <?php foreach ($namast as $satuan) : ?>
                                            <option value="<?= $satuan->namast; ?>"><?= $satuan->namast; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger pl-1" id="error-satuan" ></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="ket" id="ket" class="form-control" placeholder="Masukkan Keterangan Furniture">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="hjual" id="hjual" placeholder="Masukkan Harga Jual">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-start">
                            <div class="col-lg-2">
                                <button type="button" id="btn-insert" onclick="insert_data()" class="btn btn-outline-primary">Tambah Data</button>
                                <button type="button" id="btn-update" onclick="edit_data()" class="btn btn-outline-primary btn-block">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal hapus data -->
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