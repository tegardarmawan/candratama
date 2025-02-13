<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= $title ?></title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- plugins css -->
    <link href="<?= base_url() ?>assets/plugins/timepicker/tempusdominus-bootstrap-4.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/plugins/alertify/css/alertify.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- DataTables -->
    <link href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" type="text/css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css" type="text/css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap4.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.2/css/select.bootstrap4.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/keytable/2.12.0/css/keyTable.bootstrap4.css" type="text/css">
    <link rel="stylesheet" href="/extensions/Editor/css/editor.bootstrap4.css" type="text/css">
    <!-- css fixed header -->
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css">
    <!-- sweetAlert -->
    <link href="<?= base_url() ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">



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
                    <a href="<?= base_url('Admin') ?>" class="logo"><i class="mdi mdi-assistant"></i> Candratama</a>

                </div>
            </div>

            <div class="sidebar-inner slimscrollleft">
                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>

                        <!-- template dasar untuk menu yang tidak memiliki sub-menu dan menu yang memiliki sub-menu -->
                        <!-- <li>
                            <a href="index.html" class="waves-effect">
                                <i class="mdi mdi-airplay"></i>
                                <span> Dashboard <span class="badge badge-pill badge-primary float-right">7</span></span>
                            </a>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i> <span> Advanced UI </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="advanced-highlight.html">Highlight</a></li>
                                <li><a href="advanced-rating.html">Rating</a></li>
                                <li><a href="advanced-alertify.html">Alertify</a></li>
                                <li><a href="advanced-rangeslider.html">Range Slider</a></li>
                            </ul>
                        </li> -->

                        <!-- id menu role => 1= admin gudang, 2|4|0 = admin kantor(administrasi, markteting, interior konsultan), 3 = superadmin -->
                        <?php foreach ($menus as $menu) : ?>
                            <!-- pembagian menu untuk hak akses admin kantor  -->
                            <?php if ($this->session->userdata('logged_in') && $this->session->userdata('id_credential') == '3' || $this->session->userdata('id_credential') == '4') : ?>
                                <?php if ($menu['is_has_sub'] == '2') : ?> <!-- menu yang tidak memiliki sub menu -->
                                    <!-- memanggil menu dashboard -->
                                    <li>
                                        <?php if ($menu['id_menu_role'] == '4' || $menu['id_menu_role'] == '0') : ?>
                                            <a href="<?= base_url($menu['link']) ?>">
                                                <i><?= $menu['icon'] ?></i>
                                                <span><?= $menu['name'] ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                                <?php if ($menu['id_menu_role'] == '2') : ?>
                                    <?php if ($menu['is_has_sub'] == '1') : ?> <!-- kode untuk menu yang memiliki sub-menu -->
                                        <li class="has_sub">
                                            <a href="javascript:void(0);" class="waves-effect">
                                                <i><?= $menu['icon'] ?> </i>
                                                <span><?= $menu['name'] ?></span>
                                                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span>
                                            </a>
                                            <ul class="list-unstyled"> <!-- kode untuk sub-menu -->
                                                <?php foreach ($menus as $sub_menu) : ?>
                                                    <li>
                                                        <?php if ($sub_menu['type'] == '2' && $sub_menu['id_parent'] == $menu['id_parent']) : ?>
                                                            <a href="<?= base_url($sub_menu['link']) ?>"><?= $sub_menu['name'] ?></a>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- pembagian menu untuk hak akses admin gudang -->
                            <?php elseif ($this->session->userdata('logged_in') && $this->session->userdata('id_credential') == '5') : ?>
                                <?php if ($menu['is_has_sub'] == '2') : ?>
                                    <!-- memanggil menu dashboard -->
                                    <li>
                                        <?php if ($menu['id_menu_role'] == '0') : ?>
                                            <a href="<?= base_url($menu['link']) ?>">
                                                <i><?= $menu['icon'] ?></i>
                                                <span><?= $menu['name'] ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                                <!-- tidak diberikan kondisi id_menu role untuk mendapatkan akses seluruh menu -->
                                <?php if ($menu['is_has_sub'] == '1') : ?>
                                    <?php if ($menu['id_menu_role'] == '1') : ?>
                                        <li class="has_sub">
                                            <a href="javascript:void(0);" class="waves-effect">
                                                <i><?= $menu['icon'] ?> </i>
                                                <span><?= $menu['name'] ?></span>
                                                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span>
                                            </a>
                                            <ul class="list-unstyled">
                                                <?php foreach ($menus as $sub_menu) : ?>
                                                    <li>
                                                        <?php if ($sub_menu['type'] == '2' && $sub_menu['id_parent'] == $menu['id_parent']) : ?>
                                                            <a href="<?= base_url($sub_menu['link']) ?>"><?= $sub_menu['name'] ?></a>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- pembagian menu hak akses superadmin -->
                            <?php elseif ($this->session->userdata('logged_in') && $this->session->userdata('id_credential') == '2') : ?>
                                <li>
                                    <?php if ($menu['id_menu_role'] == '4' || $menu['id_menu_role'] == '0') : ?>
                                        <a href="<?= base_url($menu['link']) ?>">
                                            <i><?= $menu['icon'] ?></i>
                                            <span><?= $menu['name'] ?></span>
                                        </a>
                                    <?php endif; ?>
                                </li>
                                <?php if ($menu['is_has_sub'] == '1') : ?>
                                    <li class="has_sub">
                                        <a href="javascript:void(0);" class="waves-effect">
                                            <i><?= $menu['icon'] ?> </i>
                                            <span><?= $menu['name'] ?></span>
                                            <span class="float-right"><i class="mdi mdi-chevron-right"></i></span>
                                        </a>
                                        <ul class="list-unstyled">
                                            <?php foreach ($menus as $sub_menu) : ?>
                                                <li>
                                                    <?php if ($sub_menu['type'] == '2' && $sub_menu['id_parent'] == $menu['id_parent']) : ?>
                                                        <a href="<?= base_url($sub_menu['link']) ?>"><?= $sub_menu['name'] ?></a>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
            <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->