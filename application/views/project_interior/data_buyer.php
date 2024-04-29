<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Kelola Data Customer</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Customer</h4>
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
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Customer</th>
                            <th>Kode C1</th>
                            <th>Nama Customer</th>
                            <th>Kota</th>
                            <th>Telp</th>
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
                                <label for="example-text-input" class="col-sm-3 col-form-label">Kode</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" class="form-control" value="">
                                    <input class="form-control" type="text" id="kodec" name="kodec" placeholder="Masukkan kode customer">
                                    <small class="text-danger pl-1" id="error-kodec"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kode C1</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan kode C1" name="kodec1" id="kodec1">
                                    <small class="text-danger pl-1" id="error-kodec1"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan customer" name="namac" id="namac">
                                    <small class="text-danger pl-1" id="error-namac"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan NIK customer" name="ktp" id="ktp">
                                    <small class="text-danger pl-1" id="error-ktp"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text-area" class="form-control" placeholder="Masukkan alamat customer" name="alamat" id="alamat">
                                    <small class="text-danger pl-1" id="error-alamat"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kota</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan kota customer" name="kota" id="kota">
                                    <small class="text-danger pl-1" id="error-kota"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan telp customer" name="telp" id="telp">
                                    <small class="text-danger pl-1" id="error-telp"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Order</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Masukkan Tanggal Pesan Customer" name="tgl" id="tgl">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                        <small class="text-danger pl-1" id="error-tgl"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan pekerjaan customer" name="pekerjaan" id="pekerjaan">
                                    <small class="text-danger pl-1" id="error-pekerjaan"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Perusahaan Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan perusahaan customer" name="perusahaan" id="perusahaan">
                                    <small class="text-danger pl-1" id="error-perusahaan"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Saldo Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan spending money customer" name="saldo" id="saldo">
                                    <small class="text-danger pl-1" id="error-saldo"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jenis Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan jenis customer" name="jenis" id="jenis">
                                    <small class="text-danger pl-1" id="error-jenis"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kodep</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan kodep" name="kodep" id="kodep">
                                    <small class="text-danger pl-1" id="error-kodep"></small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btn-insert" onclick="insert_data()" class="btn btn-outline-primary">Tambah Data</button>
                            <button type="button" id="btn-update" onclick="edit_data()" class="btn btn-outline-primary">Simpan</button>
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
            <!-- Modal detail data -->
            <div class="modal fade bs-example-modal-lg" id="lihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label for="example-text-input" class="col-sm-3 col-form-label">Kode</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" class="form-control" value="">
                                    <input class="form-control" type="text" id="kodec" name="kodec" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kode C1</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="kodec1" id="kodec1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="namac" id="namac">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="ktp" id="ktp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text-area" class="form-control" readonly name="alamat" id="alamat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kota</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="kota" id="kota">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="telp" id="telp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Tanggal Order</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" readonly name="tgl" id="tgl">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pekerjaan Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="pekerjaan" id="pekerjaan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Perusahaan Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="perusahaan" id="perusahaan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Saldo Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="saldo" id="saldo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Jenis Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="jenis" id="jenis">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kodep</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="kodep" id="kodep">
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
</div>