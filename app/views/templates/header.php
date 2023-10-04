<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $data['judul'];?></title>
    <link rel="stylesheet" href="<?= BASEURL;?>/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/b8e0ad476d.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="flex relative">  
    <!-- Side Bar -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand fixed-top">
            <a class="brand-logo" href="#">
                <img src="<?=BASEURL;?>/img/logo-white.png" alt="logo">
                <h1>Digimax</h1>
            </a>
            <a class="brand-logo-mini" href="index.html">
                <img src="<?=BASEURL;?>/img/logo-white.png" alt="logo">
            </a>
        </div>
        <ul class="isi-sidebar">
            <li class="sidebar-category">
                <span class="sidebar-link">Navigation</span>
            </li>
            <li class="sidebar-item menu-items active">
                <a class="sidebar-link" href="<?=BASEURL;?>/home">
                    <span class="menu-icon">
                        <i class="fa-solid fa-gauge-high"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item menu-items dropdown">
                <a class="sidebar-link dropdown-toggle" onclick="toggleDropdown(this)" href="javascript:void(0);">
                    <span class="menu-icon">
                        <i class="fa-solid fa-laptop"></i>
                    </span>
                    <span class="menu-title">Table</span>
                </a>
                <div class="dropdown-menu">
                    <ul class="sidedropul">
                        <li class="sidebar-item menu-items">
                            <a class="sidedropa" href="<?=BASEURL;?>/usaha">Jenis Usaha</a>
                        </li>
                        <li class="sidebar-item menu-items">
                            <a class="sidedropa" href="<?=BASEURL;?>/layanan">Layanan</a>
                        </li>
                        <li class="sidebar-item menu-items">
                            <a class="sidedropa" href="<?=BASEURL;?>/customer">Customer</a>
                        </li>
                        <li class="sidebar-item menu-items">
                            <a class="sidedropa" href="<?=BASEURL;?>/tim">Team Project</a>
                        </li>
                        <li class="sidebar-item menu-items">
                            <a class="sidedropa" href="<?=BASEURL;?>/project">Project</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    <!-- Sidebar -->
    <div class="page-body">
        <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-menu">
            <div class="flex one">
                <button class="navbar-toggler" id="toggleSidebarButton">
                    <span class="fa-solid fa-bars"></span>
                </button>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form class="nav-link">
                            <input type="text" class="form-nav" placeholder="Search products">
                        </form>
                    </li>
                </ul>
            </div>
            <ul class="nav-profile">
                <li class="nav-item">
                    <div class="nav-link-profile">
                        <div class="navbar-profile">
                            <p class="">Henry Klein</p>
                            <img class="profile" src="<?=BASEURL;?>/img/face9.jpg" alt="">
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="dropdown__wrapper hide dropdown__wrapper--fade-in none">
            <h6 class="dropdownh6">Profile</h6>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <div class="preview-thumbnail">
                    <div class="preview-icon">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                </div>
                <div class="preview-item-content">
                    <p class="preview-subject">Settings</p>
                </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item">
                <div class="preview-thumbnail">
                    <div class="preview-icon">
                        <i class="fa-sharp fa-solid fa-right-from-bracket" style="color: #fc424a;"></i>
                    </div>
                </div>
                <div class="preview-item-content">
                    <p class="preview-subject">Logout</p>
                </div>
            </a>
        </div>
    </nav>
        <!-- Navbar -->
    <div class="main-panel">
        <div class="content-wrapper">
        <!-- <ul class="notifications"></ul> -->
        <div class="notifications"></div>
   