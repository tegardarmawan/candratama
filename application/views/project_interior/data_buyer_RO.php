<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Candratama</a></li>
                            <li class="breadcrumb-item active">Data Customer Repeat Order</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Customer Repeat Order</h4>
                </div>
            </div>
        </div>
        <div class="card m-b-30">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Customer</th>
                            <th>Nama Customer</th>
                            <th>Kota</th>
                            <th>Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- Modal detail data -->
            <div class="modal fade bs-example-modal-lg" id="lihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" name="title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Kode</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" id="id" class="form-control" value="">
                                    <input class="form-control" type="text" id="kodec" name="kodec" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="namac" id="namac">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Kota</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="kota" id="kota">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="telp" id="telp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Project</label>
                                <div class="col-sm-9">
                                    <textarea name="project" id="project" class="form-control" readonly></textarea>
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