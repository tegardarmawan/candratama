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
                    <h4 class="page-title">Data Project</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card m-b-30">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="pl-1 mb-1" style="font-weight: 500;">Project<span class="text-danger me-1">*</span></div>
                    <div class="row pl-3">
                        <select name="project" id="project" class="select2 custom-select">
                            <option value="">Pilih Project</option>
                            <?php foreach ($project as $row) : ?>
                                <option value="<?php echo $row->namac; ?>">
                                    <?php echo $row->namac; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-project"></small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="pl-1 mb-1" style="font-weight: 500;">Nota Project <span class="text-danger me-1">*</span></div>
                    <div class="row pl-3">
                        <input type="hidden" name="id" id="id" class="form-control">
                        <input type="text" class="form-control" id="nota" name="nota">
                        <small class="text-danger pl-1" id="error-nota"></small>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="pl-1 mb-1" style="font-weight: 500;">Nama Barang<span class="text-danger me-1">*</span></div>
                        <input type="text" class="form-control pl-3" id="namab" name="namab" style="width: 100%;">
                        <small class="text-danger pl-1" id="error-namab"></small>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 pr-0">
                        <div class="pl-1 mb-1" style="font-weight: 500; ">Kode Barang <span class="text-danger me-1">*</span></div>
                        <input type="number" class="form-control pl-3" id="kodeb" name="kodeb" style="width: 100%;" min="0">
                        <small class="text-danger pl-1" id="error-kodeb"></small>
                    </div>
                </div>
                <div class="form-group" style="width: 100%;">
                    <div class="pl-1 mb-1" style="font-weight: 500;">Tanggal<span class="text-danger me-1">*</span></div>
                    <div class="row pl-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" id="tgl" name="tgl">
                            <div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            <small class="text-danger pl-1" id="error-tgl"></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>