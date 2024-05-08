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
                            <th width="5%">No</th>
                            <th width="10%">Kode Karyawan</th>
                            <th width="10%">No Induk</th>
                            <th width="10%">Nama</th>
                            <th width="5%">Tempat Lahir</th>
                            <th width="5%">Tanggal Lahir</th>
                            <th width="10%">Alamat</th>
                            <th width="5%">Kota</th>
                            <th width="10%">Telp</th>
                            <th width="10%">Status</th>
                            <th width="10%">Jabatan</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- // id no kodeal namaal merk stock satuan tglbeli hbeli ket namak kodek -->
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
                            <label for="kode" class="col-sm-3 col-form-label">Kode Karyawan</label>
                            <input type="hidden" name="id" class="form-control" value="">
                            <div class="col-sm-9">
                                <input type="text" name="kode" class="form-control" id="kode" placeholder="Masukkan Kode Karyawan">
                                <small class="text-danger pl-1" id="error-kode"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="induk" class="col-sm-3 col-form-label">No Induk</label>
                            <div class="col-sm-9">
                                <input type="text" name="induk" class="form-control" id="induk" placeholder="Masukkan No Induk Karyawan">
                                <small class="text-danger pl-1" id="error-induk"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Karyawan">
                                <small class="text-danger pl-1" id="error-nama"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tempat" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" name="tempat" class="form-control" id="tempat" placeholder="Masukkan Tempat Lahir Karyawan">
                                <small class="text-danger pl-1" id="error-tempat"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="tanggal" class="form-control datepicker" id="tanggal" placeholder="Masukkan Tanggal Lahir Karyawan">
                                    <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    <small class="text-danger pl-1" id="error-tanggal"></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="area-text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat Karyawan">
                                <small class="text-danger pl-1" id="error-alamat"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kota" class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                <input type="text" name="kota" class="form-control" id="kota" placeholder="Masukkan Alamat Kota Karyawan">
                                <small class="text-danger pl-1" id="error-kota"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telp" class="col-sm-3 col-form-label">Telp</label>
                            <div class="col-sm-9">
                                <input type="text" name="telp" class="form-control" id="telp" placeholder="Masukkan Nomor Telepon Karyawan">
                                <small class="text-danger pl-1" id="error-telp"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status1" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select name="status1" id="status1" class="select2 form-control select-custom">
                                    <option value="">Pilih Status</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                <small class="text-danger pl-1" id="error-status1"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="Masukkan Jabatan Karyawan">
                                <small class="text-danger pl-1" id="error-jabatan"></small>
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