<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Candratama</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link href="<?= base_url() ?>assets/plugins/alertify/css/alertify.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/alertify/js/alertify.js">
    <link href="<?= base_url() ?>assets/plugins/alertify/js/ngAlertify.js">
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- DataTables -->
    <link href="<?= base_url()?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?= base_url()?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- sweetAlert -->
    <link href="<?= base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    
</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="index.html" class="logo"><i class="mdi mdi-assistant"></i> Candratama</a>
                    <!-- <a href="index.html" class="logo"><img src="<?= base_url() ?>assets/logo.png" height="24" alt="logo"></a> -->
                </div>
            </div>

            <div class="sidebar-inner slimscrollleft">

                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>

                        <li>
                            <a href="<?= base_url('Admin')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-tv"></i> <span> Master Warehouse </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?= base_url('Data_group') ?>">Data Group</a></li>
                                <li><a href="<?= base_url('Data_satuan_barang') ?>">Data Satuan Barang</a></li>
                                <li><a href="<?= base_url('kelola_data_barang') ?>">Kelola Data Barang</a></li>
                                <li><a href="<?= base_url('Kelola_data_furniture') ?>">Kelola Data Furniture</a></li>
                                <li><a href="<?= base_url('Kelola_data_meubel') ?>">Kelola Data Meubel</a></li>
                                <li><a href="<?= base_url('Kelola_data_granit_hpl') ?>">Kelola Data Granit & HPL</a></li>
                                <li><a href="<?= base_url('Laporan_warehouse') ?>">Laporan</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-layer-group"></i> <span> Project Interior </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?= base_url('data_prospek') ?>">Data Prospek</a></li>
                                <li><a href="<?= base_url('calon_buyer') ?>">Daftar Calon Buyer</a></li>
                                <li><a href="<?= base_url('follup') ?>">Daftar Followup Prospek</a></li>
                                <li><a href="<?= base_url('Kelola_surat_presentasi') ?>">Surat Presentasi Project</a></li>
                                <li><a href="<?= base_url('buyer') ?>">Data Buyer</a></li>
                                <li><a href="<?= base_url('buyer_RO') ?>">Data Buyer RO</a></li>
                                <li><a href="<?= base_url('transaksi') ?>">Transaksi Kontrak</a></li>
                                <li><a href="<?= base_url('bahan_project') ?>">Input Bahan Project</a></li>
                                <li><a href="<?= base_url('Laporan_interior') ?>">Laporan</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= base_url('Kelola_karyawan') ?>" class="waves-effect"><i class="fas fa-people-group"></i> <span> Data Karyawan </span> </a>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-book"></i> <span> Menu Inventaris </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?= base_url('Kelola_alat_tukang') ?>">Alat Tukang</a></li>
                                <li><a href="<?= base_url('Kelola_alat_kantor') ?>">Alat Kantor</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-layer-group"></i> <span> Menu Fasilitas </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?= base_url('Backup_data') ?>">Backup Data</a></li>
                                <li><a href="<?= base_url('log_user') ?>">Data Log User</a></li>
                                <li><a href="<?= base_url('Kelola_user') ?>">Kelola User</a></li>
                                <li><a href="<?= base_url('Kelola_penjualan') ?>">Password Edit Penjualan</a></li>
                                <li><a href="<?= base_url('Help') ?>">Help</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->