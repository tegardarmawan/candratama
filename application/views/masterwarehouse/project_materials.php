<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Barang Project</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Barang Project</h4>
                </div>
            </div>
        </div>
        <?php if (isset($project) && !empty($project)) : ?>
            <div class="card card-head m-t-20 m-b-10">
                <div class="card-body">
                    <ul class="list-inline float-right mb-0">
                        <li class="list-inline-item mt-2">
                            <button class="btn btn-success" onclick="kembali()"><span class="iconify" data-icon="mdi-undo-variant"></span>Kembali</button>
                        </li>
                        <li class="list-inline-item">
                            <button class="btn btn-outline-dark" onclick="generate()" id="cetak-nota"><span class="iconify" data-icon="mdi-printer-outline"></span> Cetak</button>
                        </li>
                    </ul>
                    <ul class="list-inline float-left mb-0">
                        <li class="list-inline-item">
                            <p class="mb-0 ms-3">Nota Project</p>
                            <h3 class="mt-0 ms-3" id="nota"><?= $project->nota ?></h3>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-8 mb-10">
                    <div class="card m-b-10">
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
                <div class="col-lg-4 col-md-4 col-sm-4 mb-10">
                    <div class="card m-b-10">
                        <div class="card-header">
                            Nama Customer
                        </div>
                        <div class="card-body">
                            <h5 id="namac"><?= $project->namac ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30 m-t-10">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col sm-6 d-flex flex-row-reverse">
                                <div class="d-flex align-items-center">
                                    <label for="min" style="min-width: 80px; margin-top: 7px; margin-right: 3px; font-weight:500;">Start Date:</label>
                                    <input type="text" class="form-control" id="min" name="min" placeholder="Select start date" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col sm-6 d-flex flex-row">
                                <div class="d-flex align-items-center">
                                    <label for="max" style="min-width: 80px; margin-top: 7px; margin-right: 3px; font-weight:500;">End Date:</label>
                                    <input type="text" class="form-control" id="max" name="max" placeholder="Select end date" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">


                        </div>
                        <table class="table editable-table" id="my-table">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Keluar</th>
                                    <th>Satuan</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var nota = "<?php echo $nota; ?>"; // Menginisialisasi variabel JavaScript dengan nilai PHP
</script>