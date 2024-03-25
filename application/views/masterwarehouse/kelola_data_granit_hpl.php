<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Kelola Data Granit&HPL</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Granit&HPL</h4>
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
                            <th>Kode HPL</th>
                            <th>Nama HPL</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>



            <!-- Modal tambah/edit data -->
            <div class="modal fade bs-example-modal-lg" id="insert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myLargeModalLabel" name="title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="kode" class="col-sm-3 col-form-label">Kode Group</label>
                                <input type="hidden" class="form-control" name="id" id="id">
                                <div class="col-sm-9">
                                    <select name="kodeg" id="kodeg" class="select2 form-control select-custom">
                                        <option value="">Pilih Kode Group</option>
                                        <?php foreach ($kodeg as $kode) : ?>
                                            <option value="<?= $kode->kodeg ?>"><?= $kode->kodeg ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger pl-1" id="error-kode"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kode HPL</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kodeh" id="kodeh" placeholder="Masukkan Kode HPL">
                                    <small class="text-danger pl-1" id="error-kodeh"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="satuan" class="col-sm-3 col-form-label">Nama HPL</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="namah" id="namah" placeholder="Masukkan nama HPL">
                                    <small class="text-danger pl-1" id="error-namah"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="satuan" class="col-sm-3 col-form-label">Stock</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="stock" id="stock" placeholder="Masukkan stock">
                                    <small class="text-danger pl-1" id="error-namah"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Satuan</label>
                                <div class="col-sm-9">
                                    <select name="satuan" id="satuan" class="select2 form-control custom-select">
                                        <option value="">Pilih Satuan</option>
                                        <?php foreach ($satuan as $namast) : ?>
                                            <option value="<?= $namast->namast ?>"><?= $namast->namast ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ket" id="ket" placeholder="Masukkan keterangan">
                                    <small class="text-danger pl-1" id="error-ket"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Harga Beli</label>
                                <div class="col-sm-9">
                                    <input type="text" name="hbeli" id="hbeli" class="form-control" placeholder="Masukkan harga beli">
                                    <small class="text-danger pl-1" id="error-hbeli"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Harga Pokok</label>
                                <div class="col-sm-9">
                                    <input type="text" name="hpokok" id="hpokok" class="form-control" placeholder="Masukkan harga pokok">
                                    <small class="text-danger pl-1" id="error-hpokok"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Harga Jual</label>
                                <div class="col-sm-9">
                                    <input type="text" name="hjual" id="hjual" class="form-control" placeholder="Masukkan harga jual">
                                    <small class="text-danger pl-1" id="error-hjual"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status1" id="status1" class="select2 form-control custom-select">
                                        <option value="">Pilih Status HPL</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                    <small class="text-danger pl-1" id="error-status1"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Stock Minimal</label>
                                <div class="col-sm-9">
                                    <input type="text" name="stockmin" id="stockmin" class="form-control" placeholder="Masukkan stock minimal">
                                    <small class="text-danger pl-1" id="error-stockmin"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Terang</label>
                                <div class="col-sm-9">
                                    <input type="text" name="namat" id="namat" class="form-control" placeholder="Masukkan nama terang">
                                    <small class="text-danger pl-1" id="error-namat"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Project</label>
                                <div class="col-sm-9">
                                    <input type="text" name="projectt" id="projectt" class="form-control" placeholder="Masukkan nama project">
                                    <small class="text-danger pl-1" id="error-projectt"></small>
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