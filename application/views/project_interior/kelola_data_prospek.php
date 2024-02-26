<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Data Prospek</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Prospek</h4>
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
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Kota</th>
                            <th>Telepon</th>
                            <th>Tanggal Project</th>
                            <th>Tipe</th>
                            <th>Src</th>
                            <th>Jenis</th>
                            <th>Keterangan</th>
                            <th>Cek</th>
                            <th>Aksi</th>
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
                            <label for="kodep" class="col-sm-3 col-form-label">Kode Project</label>
                            <input type="hidden" name="id" class="form-control" value="">
                            <div class="col-sm-9">
                                <input type="text" name="kodep" class="form-control" id="kodep" placeholder="Masukkan Kode Project">
                                <small class="text-danger pl-1" id="error-kodep"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="induk" class="col-sm-3 col-form-label">Nama Project</label>
                            <div class="col-sm-9">
                                <input type="text" name="namap" class="form-control" id="namap" placeholder="Masukkan Nama Project">
                                <small class="text-danger pl-1" id="error-namap"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                <input type="text" name="kota" class="form-control" id="kota" placeholder="Masukkan Kota Project">
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
                            <label for="status1" class="col-sm-3 col-form-label">Tanggal Project</label>
                            <div class="col-sm-9">
                                <input type="date" name="tglp" id="tglp" class="form-control" placeholder="Masukkan Tanggal Project"  >
                                <small class="text-danger pl-1" id="error-tglp"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Tipe Project</label>
                            <div class="col-sm-9">
                                <input type="text" name="type" class="form-control" id="type" placeholder="Masukkan Tipe Project">
                                <small class="text-danger pl-1" id="error-type"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="status1" class="col-sm-3 col-form-label">Source Project</label>
                            <div class="col-sm-9">
                                <input type="text" name="src" class="form-control" id="src" placeholder="Masukkan Source Project">
                                <small class="text-danger pl-1" id="error-src"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Jenis Project</label>
                            <div class="col-sm-9">
                                <input type="text" name="jenis" class="form-control" id="jenis" placeholder="Masukkan Jenis Project">
                                <small class="text-danger pl-1" id="error-jenis"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" name="ket" class="form-control" id="ket" placeholder="Masukkan Keterangan Project">
                                <small class="text-danger pl-1" id="error-ket"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Cek</label>
                            <div class="col-sm-9">
                                <input type="text" name="cek" class="form-control" id="cek" placeholder="Masukkan Cek Project">
                                <small class="text-danger pl-1" id="error-cek"></small>
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