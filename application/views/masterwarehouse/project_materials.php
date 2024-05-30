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
            <?php foreach ($project as $proj) : ?>
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
                                <h3 class="mt-0 ms-3" id="nota"><?= $proj->nota ?></h3>
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
                                <h5 id="namac"><?= $proj->namac ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card m-b-5">
                            <div class="card-header">
                                Project
                            </div>
                            <div class="card-body">
                                <h5 id="project"><?= $proj->project ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
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