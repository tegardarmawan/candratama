<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Detail Stock Masuk</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Stock Masuk</h4>
                </div>
            </div>
        </div>
        <?php if (isset($stock) && !empty($stock)) : ?>
            <?php foreach ($stock as $st) : ?>
                <div class="card card-head m-t-20 m-b-10">
                    <div class="card-body">
                        <ul class="list-inline float-right mb-0">
                            <li class="list-inline-item mt-2">
                                <button class="btn btn-success" onclick="kembali()"><span class="iconify" data-icon="mdi-undo-variant"></span>Kembali</button>
                            </li>
                        </ul>
                        <ul class="list-inline float-left mb-0">
                            <li class="list-inline-item">
                                <p class="mb-0 ms-3">Nota Stock</p>
                                <h3 class="mt-0 ms-3" id="nota"><?= $st->nota ?></h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-10">
                        <div class="card m-b-10">
                            <div class="card-header">
                                Tanggal
                            </div>
                            <div class="card-body">
                                <h5 id="namac"><?= $st->tgl ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card m-b-5">
                            <div class="card-header">
                                Catatan/Ket
                            </div>
                            <div class="card-body">
                                <h5 id="project"><?= $st->ket ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card m-b-5">
                            <div class="card-header">
                                Tukang
                            </div>
                            <div class="card-body">
                                <h5 id="project"><?= $st->namat ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30 m-t-30">
                    <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var nota = "<?php echo $nota; ?>"; // Menginisialisasi variabel JavaScript dengan nilai PHP
</script>