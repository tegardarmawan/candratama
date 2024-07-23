<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Kelola Data Project</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-head m-t-20 m-b-10">
            <div class="card-body">
                <ul class="list-inline float-right mb-0">
                    <li class="list-inline-item mt-2">
                        <button class="btn btn-success" onclick="kembali()"><span class="iconify" data-icon="mdi-undo-variant"></span>Kembali</button>
                    </li>
                </ul>
                <ul class="list-inline float-left mb-0">
                    <li class="list-inline-item">
                        <p class="mb-0 ms-3">Nota Project</p>
                        <h3 class="mt-0 ms-3" name="nota" id="nota"><?= $notaProject; ?></h3>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 mb-10">
                <div class="card m-b-10">
                    <div class="card-header">
                        Nama Customer
                    </div>
                    <div class="card-body">
                        <select name="namac" id="namac" class="form-control">
                            <option value="">Pilih Nama Customer</option>
                            <?php foreach ($namacust as $nama) : ?>
                                <option value="<?= $nama->namac ?>"><?= $nama->namac ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-kodec"></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card m-b-5">
                    <div class="card-header">
                        Kode Customer
                    </div>
                    <div class="card-body">
                        <input type="text" class="form-control" name="kodec" id="kodec" readonly>
                        <small class="text-danger pl-1" id="error-kodec"></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card m-b-10">
                    <div class="card-header">
                        Tanggal
                    </div>
                    <div class="card-body">
                        <input type="text" class="form-control datepicker" name="tgl" id="tgl">
                        <small class="text-danger pl-1" id="error-tgl"></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <table class="table editable-table" id="my-table">
                            <thead>
                                <tr>
                                    <th width="80%">Project</th>
                                    <th width="30%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="produk-container">

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-secondary" onclick="addProduk()">Tambah Produk</button>
                        <button class="btn btn-primary btn-large waves-effect waves-light" onclick="insert_data()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    var notaproject = '<?= $notaProject; ?>';
</script>