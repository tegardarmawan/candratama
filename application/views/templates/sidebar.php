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

    <link href="<?= base_url() ?>assets/plugins/alertify/css/alertify.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DataTables -->
    <link href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                        <?php foreach ($menus as $menu) : ?>
                            <?php if ($menu['is_devider'] == '2') : ?>
                                <li>
                                    <a href="<?= base_url($menu['link']) ?>"> <i><?= $menu['icon'] ?></i> <span><?= $menu['name'] ?></span> </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($menu['is_devider'] == '1') : ?>
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
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->