<div class="content m-b-30">
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                                <li class="breadcrumb-item active">Stock Masuk</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Input Stock Masuk</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-head m-t-20 m-b-20">
                        <div class="card-body">
                            <ul class="list-inline float-right mb-0">
                                <li class="list-inline-item mt-2">
                                    <button class="btn btn-success" onclick="kembali()"><span class="iconify" data-icon="mdi-undo-variant"></span>Kembali</button>
                                </li>
                            </ul>
                            <ul class="list-inline float-left mb-0">
                                <li class="list-inline-item">
                                    <p class="mb-0 ms-3">Nota Stock</p>
                                </li>
                                <li class="list-inline-item">
                                    <input type="hidden" class="form-control" id="id" name="id">
                                    <input type="text" class="form-control" name="nota" id="nota" placeholder="isikan nota">
                                    <small class=""></small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- tgl waktu ket/catatan project namat -->
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="form-group mb-0">
                                <label for="" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control datepicker" name="tgl" id="tgl" placeholder="pilih tanggal">
                                    <small class="text-danger pl-1" id="error-tgl"></small>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <label for="" class="col-sm-3 col-form-label">Ket/Catatan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ket" id="ket" placeholder="isi catatan">
                                    <small class="text-danger pl-1" id="error-ket"></small>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <label for="" class="col-sm-3 col-form-label">Nama Tukang</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="namat" id="namat" placeholder="isikan nama tukang">
                                    <small class="text-danger pl-1" id="error-namat"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <select name="namab" id="namab" class="select2 form-control" multiple="multiple">
                                        <?php foreach ($barang as $row) : ?>
                                            <option value="<?= $row->kodeb ?>" data-satuan="<?= $row->satuan ?>" data-stock="<?= $row->stock ?>"><?= $row->namab ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class=" text-danger pl-1" id="error-namab"></small>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 pr-0">
                                    <button type="button" id="btn-insert" class="btn btn-outline-primary"><i class="mdi mdi-plus"></i></button>
                                </div>
                            </div>
                            <div class="mb-3 d-flex justify-content-center">
                            </div>
                            <table class="table editable-table" id="my-table">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Rows will be added here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-secondary" onclick="kembali()"><span class="iconify" data-icon="mdi-undo-variant"></span>Batal</button>
                            <button type="button" class="btn btn-primary btn-large waves-effect waves-light" onclick="insert_data()" id="btn-add">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>