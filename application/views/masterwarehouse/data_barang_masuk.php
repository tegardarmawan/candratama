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
        <?php if (isset($barang_masuk) && !empty($barang_masuk)) : ?>
            <?php foreach ($barang_masuk as $masuk) : ?>
                <div class="card card-head m-t-20 m-b-10">
                    <div class="card-body">
                        <ul class="list-inline float-right mb-0">
                            <li class="list-inline-item mt-2">
                                <button class="btn btn-success" onclick="kembali()"><span class="iconify" data-icon="mdi-undo-variant"></span>Kembali</button>
                                <button class="btn btn-primary" onclick="edit_data()">Simpan</button>
                            </li>
                        </ul>
                        <ul class="list-inline float-left mb-0">
                            <li class="list-inline-item">
                                <p class="mb-0 ms-3">Kode Barang</p>
                                <h3 class="mt-0 ms-3" id="kodeb"><?= $masuk->kodeb ?></h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <p style="font-weight:bold;">Info Barang</p>
                        </div>
                        <div class="card m-b-10">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="pl-1 mb-1" style="font-weight: 500;">Nama Barang<span class="text-danger me-1">*</span></div>
                                            <div class="row pl-3">
                                                <input type="hidden" name="id" class="form-control" id="id" value="<?= $masuk->id ?>">
                                                <input type="text" class="form-control" id="namab" name="namab" value="<?= $masuk->namab ?>">
                                                <small class="text-danger pl-1" id="error-namab"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="pl-1 mb-1" style="font-weight: 500;">Kode Group<span class="text-danger me-1">*</span></div>
                                            <div class="row pl-3">
                                                <select name="kodeg" id="kodeg" class="select2 custom-select form-control">
                                                    <?php foreach ($group as $row) : ?>
                                                        <option value="<?= $row->kodeg; ?>" <?= ($row->kodeg == $masuk->kodeg) ? 'selected' : ''; ?>>
                                                            <?= $row->kodeg; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="text-danger pl-1" id="error-kodeg"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="pl-1 mb-1" style="font-weight: 500;">Satuan Barang<span class="text-danger me-1">*</span></div>
                                            <div class="row pl-3">
                                                <select name="satuan" id="satuan" class="select2 custom-select form-control">
                                                    <?php foreach ($satuan as $row) : ?>
                                                        <option value="<?= $row->namast ?>" <?= ($row->namast == $masuk->satuan) ? 'selected' : ''; ?>>
                                                            <?= $row->namast ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="text-danger pl-1" id="error-satuan"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="pl-1 mb-1" style="font-weight: 500;">Stock Minimal<span class="text-danger me-1">*</span></div>
                                            <div class="row pl-3">
                                                <input type="number" class="form-control" id="stockmin" name="stockmin" placeholder="Masukkan angka 1234" value="<?= $masuk->stockmin ?>">
                                                <small class="text-danger pl-1" id="error-satuan"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="pl-1 mb-1" style="font-weight: 500;">Nama Tukang<span class="text-danger me-1">*</span></div>
                                            <div class="row pl-3">
                                                <input type="text" class="form-control" id="namat" name="namat" value="<?= $masuk->namat ?>">
                                                <small class="text-danger pl-1" id="error-satuan"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="pl-1 mb-1" style="font-weight: 500;">Project<span class="text-danger me-1">*</span></div>
                                            <div class="row pl-3">
                                                <select name="project" id="project" class="select2 custom-select form-control">
                                                    <option value="">Pilih Project</option>
                                                    <?php foreach ($project as $row) : ?>
                                                        <option value="<?= $row->namac ?>" <?= ($row->namac == $masuk->projectt) ? 'selected' : ''; ?>>
                                                            <?= $row->namac ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="text-danger pl-1" id="error-project"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-10">
                            <div class="card-header">
                                <p style="font-weight:bold;">Harga</p>
                            </div>
                            <!--  hbeli hpokok hjual  -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <div class="pl-1 mb-1" style="font-weight:500;">Harga Jual</div>
                                            <div class="row pl-3">
                                                <input type="text" id="hjual" name="hjual" placeholder="masukkan harga jual" class="form-control harga" value="<?= $masuk->hjual ?>">
                                                <small class="pl-1 text-danger" id="error-hjual"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <div class="pl-1 mb-1" style="font-weight:500;">Harga Beli</div>
                                            <div class="row pl-3">
                                                <input value="<?= $masuk->hbeli ?>" type="text" id="hbeli" name="hbeli" placeholder="masukkan harga beli" class="form-control harga">
                                                <small class="pl-1 text-danger" id="error-hbeli"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <div class="pl-1 mb-1" style="font-weight:500;">Harga Pokok</div>
                                            <div class="row pl-3">
                                                <input value="<?= $masuk->hpokok ?>" type="text" id="hpokok" name="hpokok" placeholder="masukkan harga pokok" class="form-control harga">
                                                <small class="pl-1 text-danger" id="error-hpokok"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>