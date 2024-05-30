<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Data Project</li>
                        </ol>
                    </div>
                    <h2 class="page-title">Data Project</h2>
                    <p class="text-muted mt-0"><?= $project ?> project</p>
                </div>
            </div>
        </div>
        <div class="card m-b-30">
            <div class="card-body">
                <!-- Button trigger modal -->
                <div class="row">
                    <div class="ml-4 text-left">
                        <button type="button" class="btn btn-primary waves-effect waves-light">
                            <i class="mdi mdi-plus"></i>
                            Tambah Data
                        </button>
                        <button id="bulk-delete" class="btn btn-danger waves-effect waves-light">Hapus Data</button>
                    </div>
                    <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <a href="<?= base_url('Project_warehouse_new') ?>">

                                </a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">

                            </div>
                        </div>
                    </div> -->
                </div>
                <hr>
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Nota</th>
                            <th>Nama Customer</th>
                            <th>Nama Project</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- modal lihat detail -->
            <div class="modal fade bs-example-modal-lg" id="lihat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myLargeModalLabel">Project >> Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Nota Project</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="hidden" id="id" name="id" readonly>
                                    <input class="form-control" type="text" id="nota" name="nota" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Kode Customer</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="kodec" name="kodec" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <textarea required class="form-control" rows="5" id="namac" name="namac" readonly></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Project</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="project" name="project" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>