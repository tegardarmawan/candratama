<nav class="navbar navbar-light" style="background-color: #FDFFE2;">
    <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Inventory/stock_masuk') ?>">Stock Masuk</span></a>
        </li>
    </ul>
    <ul class="navbar-nav mx-auto">
        <li class="nav-item active">
            <a href="<?= base_url('Inventory/stock_keluar') ?>" class="nav-link">Stock Keluar</a>
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
                                <li class="breadcrumb-item active">Stock Keluar</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Stock Keluar</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nota</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
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