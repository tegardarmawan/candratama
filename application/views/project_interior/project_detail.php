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
        <?php if (isset($project_info) && !empty($project_info)) : ?>
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
                            <h3 class="mt-0 ms-3" name="nota" id="nota"><?= $project_info->nota; ?></h3>
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
                                    <option value="<?= $nama->namac; ?>" <?= ($nama->namac == $project_info->namac) ? 'selected' : ''; ?>>
                                        <?= $nama->namac; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger pl-1" id="error-namac"></small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card m-b-5">
                        <div class="card-header">
                            Kode Customer
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" name="kodec" id="kodec" value="<?= $project_info->kodec; ?>" readonly>
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
                            <?= $project_info->tgl; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="my-table">
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
</div>
</div>
<script>
    var nota = '<?= $nota; ?>';
</script>