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
                        <button id="bulk-delete" class="btn btn-danger waves-effect waves-light">Hapus Data</button>
                    </div>
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

        </div>
    </div>
</div>
</div>
</div>