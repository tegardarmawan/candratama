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
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <?php if (isset($project_details) && !empty($project_details)) : ?>
                            <?php foreach ($project_details as $detail) : ?>
                                <div class="form-group">
                                    <div class="pl-1 mb-1" style="font-weight: 500;">Nota<span class="text-danger me-1">*</span></div>
                                    <div class="row pl-3">
                                        <input type="hidden" name="id" id="id" class="form-control">
                                        <select name="nota" id="nota" class="select2 custom-select">
                                            <option value="">Pilih customer</option>
                                            <?php foreach ($project as $row) : ?>
                                                <option value="<?php echo $row->nota; ?>" <?= ($row->nota == $detail->nota) ? 'selected' : ''; ?>>
                                                    <?= $row->nota; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="text-danger pl-1" id="error-nota"></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="pl-1 mb-1" style="font-weight: 500;">Nama Customer<span class="text-danger me-1">*</span></div>
                                    <div class="row pl-3">
                                        <input type="text" class="form-control" id="namac" name="namac" value="<?= $detail->namac ?>">
                                        <small class="text-danger pl-1" id="error-namac"></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="pl-1 mb-1" style="font-weight: 500;">Project<span class="text-danger me-1">*</span></div>
                                    <div class="row pl-3">
                                        <input type="text" class="form-control" id="project" name="project" value="<?= $detail->project ?>">
                                        <small class="text-danger pl-1" id="error-project"></small>
                                    </div>
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <div class="pl-1 mb-1" style="font-weight: 500;">Tanggal<span class="text-danger me-1">*</span></div>
                                    <div class="row pl-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" id="tgl" name="tgl">
                                            <div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                            <small class="text-danger pl-1 error-tgl"></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
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