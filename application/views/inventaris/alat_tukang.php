<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Kelola Karyawan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Karyawan</h4>
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
                        <!-- id kodek no_induk namak tempat tgl alamat kota telp status jabatan -->
                        <tr>
                            <th>No</th>
                            <th>Nomor Alat</th>
                            <th>Kode Alat</th>
                            <th>Merk Alat</th>
                            <th>Stock</th>
                            <th>Satuan</th>
                            <th>Tanggal Beli</th>
                            <th>Harga Beli</th>
                            <th>Keterangan</th>
                            <th>Nama Karyawan</th>
                            <th>Kode Karyawan</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
                            <label for="kode" class="col-sm-3 col-form-label">Nomor Alat</label>
                            <input type="hidden" name="id" class="form-control" value="">
                            <div class="col-sm-9">
                                <input type="text" name="no" class="form-control" id="no" placeholder="Masukkan Nomor Alat">
                                <small class="text-danger pl-1" id="error-no"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="induk" class="col-sm-3 col-form-label">Kode Alat</label>
                            <div class="col-sm-9">
                                <input type="text" name="induk" class="form-control" id="induk" placeholder="Masukkan No Induk Karyawan">
                                <small class="text-danger pl-1" id="error-induk"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Alat</label>
                            <div class="col-sm-9">
                                <input type="text" name="namaal" class="form-control" id="namaal" placeholder="Masukkan Nama Alat">
                                <small class="text-danger pl-1" id="error-namaal"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tempat" class="col-sm-3 col-form-label">Merk</label>
                            <div class="col-sm-9">
                                <input type="text" name="merk" class="form-control" id="merk" placeholder="Masukkan Merk Alat">
                                <small class="text-danger pl-1" id="error-tempat"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-3 col-form-label">stock</label>
                            <div class="col-sm-9">
                                <input type="date" name="stock" class="form-control" id="stock" placeholder="Masukkan Stock Alat">
                                <small class="text-danger pl-1" id="error-stock"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Satuan</label>
                            <div class="col-sm-9">
                                <input type="area-text" name="satuan" class="form-control" id="satuan" placeholder="Masukkan Satuan Alat">
                                <small class="text-danger pl-1" id="error-satuan"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kota" class="col-sm-3 col-form-label">Tanggal Beli</label>
                            <div class="col-sm-9">
                                <input type="date" name="tglbeli" class="form-control" id="tglbeli" placeholder="Masukkan Tanggal Beli">
                                <small class="text-danger pl-1" id="error-tglbeli"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telp" class="col-sm-3 col-form-label">Harga Beli</label>
                            <div class="col-sm-9">
                                <input type="text" name="hbeli" class="form-control" id="hbeli" placeholder="Masukkan Harga Beli">
                                <small class="text-danger pl-1" id="error-hbeli"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status1" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" name="ket" id="ket" class="form-control" placeholder="Masukkan Keterangan" >
                                <small class="text-danger pl-1" id="error-status1"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Kode Karyawan</label>
                            <div class="col-sm-9">
                                <select name="kodek" id="kodek" class="select2 form-control select-custom" >
                                    <option value="">Pilih Kode Karyawan</option>
                                </select>
                                <small class="text-danger pl-1" id="error-kodek"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Nama Karyawan</label>
                            <div class="col-sm-9">
                                <input type="text" name="namak" class="form-control" id="namak" placeholder="Masukkan Nama Karyawan" readonly>
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