<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Kelola Data Barang</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Barang</h4>
                </div>
            </div>
        </div>

        <div class="card m-b-30">
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalinup" onclick="submit('tambah')">
                    <i class="mdi mdi-plus"></i>
                    Tambah Data
                </button>
                <hr>
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>



            <!-- Modal tambah/edit data-->
            <div class="modal fade bs-example-modal-lg" id="modalinup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label for="kodeg" class="col-sm-3 col-form-label">Kode Group</label>
                                <input type="hidden" name="id" class="form-control" id="id">
                                <div class="col-sm-9">
                                    <select name="kodeg" id="kodeg" class="select2 form-control custom-select" style="width: 100%; height: 50px;" data-placeholder="Pilih Group Barang">
                                        <option value="">Pilih Kode Group</option>
                                        <?php foreach ($kodegroup as $row) : ?>
                                            <option value="<?php echo $row->kodeg; ?>">
                                                <?php echo $row->namag; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger pl-1" id="error-kodeg"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kodeb" class="col-sm-3 col-form-label">Kode Barang</label>
                                <div class="col-sm-9">
                                    <input required class="form-control" name="kodeb" id="kodeb" placeholder="Masukkan Kode Barang" type="text">
                                    <small class="text-danger pl-1" id="error-kodeb"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama Barang</label>
                                <div class="col-sm-9">
                                    <input required type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Barang">
                                    <small class="text-danger pl-1" id="error-nama"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stock" class="col-sm-3 col-form-label">Jumlah Stock</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="stock" id="stock" placeholder="Masukkan Stock Barang">
                                    <small class="text-danger pl-1" id="error-stock"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kodest" class="col-sm-3 col-form-label">Kode Satuan Barang</label>
                                <div class="col-sm-9">
                                    <select name="kodest" id="kodest" class="select2 form-control mb-3 custom-select" data-placeholder="Pilih Kode Barang">
                                        <option value="">Pilih Kode Satuan</option>
                                        <?php foreach ($kodesatuan as $kodest) : ?>
                                            <option value="<?php echo $kodest->namast; ?>">
                                                <?php echo $kodest->namast; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger pl-1" id="error-kodest"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hargabeli" class="col-sm-3 col-form-label">Harga Beli</label>
                                <div class="col-sm-9">
                                    <input class="form-control harga" name="hargabeli" id="hargabeli" placeholder="Rp 1.000.000,00" type="text">
                                    <small class="text-danger pl-1" id="error-hargabeli"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hargapokok" class="col-sm-3 col-form-label">Harga Pokok</label>
                                <div class="col-sm-9">
                                    <input class="form-control harga" type="text" name="hargapokok" id="hargapokok" placeholder="Rp 1.000.000,00">
                                    <small class="text-danger pl-1" id="error-hargapokok"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hargajual" class="col-sm-3 col-form-label">Harga Jual</label>
                                <div class="col-sm-9">
                                    <input class="form-control harga" type="text" name="hargajual" id="hargajual" placeholder="Rp 1.000.000,00">
                                    <small class="text-danger pl-1" id="error-hargajual"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status1" class="col-sm-3 col-form-label">Status Barang</label>
                                <div class="col-sm-9">
                                    <select name="status1" id="status1" class="form-control mb-3">
                                        <option value="">Pilih Status</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                    <small class="text-danger pl-1" id="error-status1"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stockmin" class="col-sm-3 col-form-label">Stock Minimal</label>
                                <div class="col-sm-9">
                                    <input type="number" name="stockmin" id="stockmin" class="form-control" placeholder="Masukkan Stock Minimal Barang">
                                    <small class="text-danger pl-1" id="error-stockmin"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="namat" class="col-sm-3 col-form-label">Nama Tukang</label>
                                <div class="col-sm-9">
                                    <input required type="text" name="namat" id="namat" class="form-control" placeholder="Masukkan Nama Tukang">
                                    <small class="text-danger pl-1" id="error-namat"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="project" class="col-sm-3 col-form-label">Project</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="Project" id="project" name="project" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-lg-2">
                                <button type="button" id="btn-insert" onclick="insert_data()" class="btn btn-outline-primary btn-block">Simpan</button>
                                <button type="button" id="btn-update" onclick="edit_data()" class="btn btn-outline-primary btn-block">Ubah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal hapus -->
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
        <!-- modal lihat detail -->
        <div class="modal fade bs-example-modal-lg" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label for="kodeg" class="col-sm-3 col-form-label">Kode Group</label>
                            <input type="hidden" name="id" class="form-control" id="id">
                            <div class="col-sm-9">
                                <input type="text" name="kodeg" id="kodeg" readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kodeb" class="col-sm-3 col-form-label">Kode Barang</label>
                            <div class="col-sm-9">
                                <input required class="form-control" name="kodeb" id="kodeb" readonly type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Barang</label>
                            <div class="col-sm-9">
                                <input required type="text" name="nama" id="nama" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stock" class="col-sm-3 col-form-label">Jumlah Stock</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="stock" id="stock" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kodest" class="col-sm-3 col-form-label">Kode Satuan Barang</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kodest" name="kodest" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hargabeli" class="col-sm-3 col-form-label">Harga Beli</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="hargabeli" id="hargabeli" readonly type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hargapokok" class="col-sm-3 col-form-label">Harga Pokok</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="hargapokok" id="hargapokok" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hargajual" class="col-sm-3 col-form-label">Harga Jual</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="hargajual" id="hargajual" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status1" class="col-sm-3 col-form-label">Status Barang</label>
                            <div class="col-sm-9">
                                <input type="text" readonly id="status1" name="status1" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stockmin" class="col-sm-3 col-form-label">Stock Minimal</label>
                            <div class="col-sm-9">
                                <input type="number" name="stockmin" id="stockmin" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namat" class="col-sm-3 col-form-label">Nama Tukang</label>
                            <div class="col-sm-9">
                                <input required type="text" name="namat" id="namat" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="project" class="col-sm-3 col-form-label">Project</label>
                            <div class="col-sm-9">
                                <input type="text" readonly name="project" id="project" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>