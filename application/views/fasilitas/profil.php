<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Data Profil</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Profil admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- html edit profil -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-dark">Edit data profil</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-1">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-6">
                                    <input type="hidden" class="form-control" id="id" name="id">
                                    <input type="text" class="form-control" id="nama" name="nama">
                                    <small class="text-danger pl-1" id="error-nama"></small>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="username" name="username">
                                    <small class="text-danger pl-1" id="error-username"></small>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="password" class="col-sm-2 col-form-label">Password Hash</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="password" name="password" readonly>
                                    <small class="text-danger pl-1" id="error-password"></small>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="password1" class="col-sm-2 col-form-label">Password Baru</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="password1" name="password1">
                                    <small class="text-danger pl-1" id="error-password1"></small>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="showPasswordCheckbox" />
                                <label class="form-check-label" for="showPasswordCheckbox">
                                    Show Password
                                </label><br><br>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-6">
                                    <button type=" button" id="btn-edit" onclick="edit_profil()" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>