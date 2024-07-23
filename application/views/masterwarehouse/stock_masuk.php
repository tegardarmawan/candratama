<!-- views untuk controller Inventori -->
<nav class="navbar navbar-light" style="background-color: #FDFFE2;">
    <ul class="navbar-nav mx-auto">
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('Inventory/stock_masuk') ?>">Stock Masuk</span></a>
        </li>
    </ul>
    <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <a href="<?= base_url('Stock_keluar/stock_keluar') ?>" class="nav-link">Stock Keluar</a>
        </li>
    </ul>
</nav>
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
                        <h4 class="page-title">Stock Masuk</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="text-left mb-5">
                                <a href="<?= base_url('Stock_masuk') ?>" class="btn btn-primary">
                                    + Tambah
                                </a>
                                <button class="btn btn-outline-dark" onclick="generate()" id="generatePdf"><span class="iconify" data-icon="mdi-printer-outline"></span> Cetak</button>
                            </div>
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
                            <hr>
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <!-- nota tanggal waktu namab -->
                                    <tr>
                                        <th>Nota</th>
                                        <th>Keterangan</th>
                                        <th>Waktu</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Tukang</th>
                                        <th>Project</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>