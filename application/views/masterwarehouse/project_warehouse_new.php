<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Project Warehouse</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Tambah Barang Keluar</h4>
                </div>
            </div>
        </div>

        <div class="card m-b-30">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <?php if (isset($project_details) && !empty($project_details)) : ?>
                            <div class="form-group">
                                <div class="pl-1 mb-1" style="font-weight: 500;">Nota</div>
                                <div class="row pl-3">
                                    <input type="hidden" name="id" id="id" class="form-control">
                                    <input type="text" class="form-control" id="nota" name="nota" readonly value="<?= $project_details->nota; ?>">
                                    <small class="text-danger pl-1" id="error-nota"></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="pl-1 mb-1" style="font-weight: 500;">Nama Customer</div>
                                <div class="row pl-3">
                                    <input type="text" class="form-control" id="namac" name="namac" value="<?= $project_details->namac ?>" readonly>
                                    <small class="text-danger pl-1" id="error-namac"></small>
                                </div>
                            </div>
                            <div class="form-group" style="width: 100%;">
                                <div class="pl-1 mb-1" style="font-weight: 500;">Nama Tukang</div>
                                <div class="row pl-3">
                                    <select name="namat" id="namat" class="form-control">
                                        <option value="">Pilih Nama Tukang</option>
                                        <?php foreach ($tukang as $tkg) : ?>
                                            <option value="<?= $tkg->namak; ?>"><?= $tkg->namak; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger pl-1" id="error-namat"></small>
                                </div>
                            </div>
                            <div class="form-group" style="width: 100%;">
                                <div class="pl-1 mb-1" style="font-weight: 500;">Tanggal</div>
                                <div class="row pl-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" id="tgl" name="tgl">
                                        <div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                        <small class="text-danger pl-1 error-tgl"></small>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="tablepro">
                                    <thead>
                                        <tr>
                                            <th width="80%">Project</th>
                                        </tr>
                                    </thead>
                                    <tbody id="produk-container">

                                    </tbody>
                                </table>
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

                        <table class="table editable-table" id="my-table">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Stock</th>
                                    <th>Satuan</th>
                                    <th>Keluar</th>
                                    <th>Keterangan</th>
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
<script>
    var nota = '<?= $nota; ?>';
</script>