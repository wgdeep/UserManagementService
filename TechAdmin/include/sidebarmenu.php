<?php
require_once("include/library.php");
?>

<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div style="padding-right: 0px;border-right-width: 0px;border-right-style: solid;margin-right: 18px;">
        <div class="logo-wrapper" style="width: 7.4rem;"><a href="<?php echo $wwwroot ?>/event.php"><img class="img-fluid"
                    src="https://www.webgodam.com/images/logo_header.png" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
        </div>
        <nav class="sidebar-main">
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="<?php echo $wwwroot ?>publication.php"></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <svg class="stroke-icon">
                                <use href="assets/svg/icon-sprite.svg#home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                            </svg><span>Home</span></a>
                        <ul class="sidebar-submenu custom-scrollbar">
                            <li class="sidebar-head">Home</li>
                            <li class="main-submenu"><a class="d-flex sidebar-menu" href="javascript:void(0)">
                                    <svg class="stroke-icon">
                                        <use href="assets/svg/icon-sprite.svg#home"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                                    </svg>Banner
                                    <svg class="arrow">
                                        <use href="assets/svg/icon-sprite.svg#Arrow-right"></use>
                                    </svg></a>
                                <ul class="submenu-wrapper">
                                    <li><a href="<?php echo $wwwroot ?>/banner.php">Manage Banner</a></li>
                                    <li><a href="<?php echo $wwwroot ?>/add_banner.php">Add Banner</a></li>
                                </ul>
                            </li>
                            <li class="main-submenu"><a class="d-flex sidebar-menu" href="javascript:void(0)">
                                    <svg class="stroke-icon">
                                        <use href="assets/svg/icon-sprite.svg#home"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                                    </svg>Latest Update
                                    <svg class="arrow">
                                        <use href="assets/svg/icon-sprite.svg#Arrow-right"></use>
                                    </svg></a>
                                <ul class="submenu-wrapper">
                                    <li><a href="<?php echo $wwwroot ?>/latest_update.php">Manage Latest Update</a></li>
                                    <li><a href="<?php echo $wwwroot ?>/add_latest_update.php">Add Latest Update</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <svg class="stroke-icon">
                                <use href="assets/svg/icon-sprite.svg#home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                            </svg><span>About Us</span></a>
                        <ul class="sidebar-submenu custom-scrollbar">
                            <li class="sidebar-head">About Us</li>
                            <li class="main-submenu"><a class="d-flex sidebar-menu" href="javascript:void(0)">
                                    <svg class="stroke-icon">
                                        <use href="assets/svg/icon-sprite.svg#home"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                                    </svg>People
                                    <svg class="arrow">
                                        <use href="assets/svg/icon-sprite.svg#Arrow-right"></use>
                                    </svg></a>
                                <ul class="submenu-wrapper">
                                    <li><a href="<?php echo $wwwroot ?>/people.php">Manage People</a></li>
                                    <li><a href="<?php echo $wwwroot ?>/add_people.php">Add People</a></li>
                                </ul>
                            </li>
                            <li class="main-submenu"><a class="d-flex sidebar-menu" href="javascript:void(0)">
                                    <svg class="stroke-icon">
                                        <use href="assets/svg/icon-sprite.svg#home"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                                    </svg>Purpose
                                    <svg class="arrow">
                                        <use href="assets/svg/icon-sprite.svg#Arrow-right"></use>
                                    </svg></a>
                                <ul class="submenu-wrapper">
                                    <li><a href="<?php echo $wwwroot ?>/purpose.php">Manage Purpose</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="<?php echo $wwwroot ?>/event.php">
                            <svg class="stroke-icon">
                                <use href="assets/svg/icon-sprite.svg#home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                            </svg><span>Event</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="<?php echo $wwwroot ?>/publication.php">
                            <svg class="stroke-icon">
                                <use href="assets/svg/icon-sprite.svg#home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                            </svg><span>Publication</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <svg class="stroke-icon">
                                <use href="assets/svg/icon-sprite.svg#home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                            </svg><span>Reports</span></a>
                        <ul class="sidebar-submenu custom-scrollbar">
                            <li class="sidebar-head">Reports</li>
                            <li class="main-submenu"><a class="d-flex sidebar-menu" href="javascript:void(0)">
                                    <svg class="stroke-icon">
                                        <use href="assets/svg/icon-sprite.svg#home"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                                    </svg>Reports
                                    <svg class="arrow">
                                        <use href="assets/svg/icon-sprite.svg#Arrow-right"></use>
                                    </svg></a>
                                <ul class="submenu-wrapper">
                                    <li><a href="<?php echo $wwwroot ?>/report.php">Manage Reports</a></li>
                                </ul>
                            </li>
                            <li class="main-submenu"><a class="d-flex sidebar-menu" href="javascript:void(0)">
                                    <svg class="stroke-icon">
                                        <use href="assets/svg/icon-sprite.svg#home"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                                    </svg>Report Form
                                    <svg class="arrow">
                                        <use href="assets/svg/icon-sprite.svg#Arrow-right"></use>
                                    </svg></a>
                                <ul class="submenu-wrapper">
                                    <li><a href="<?php echo $wwwroot ?>/form_report.php">Manage Report Form</a></li>
                                    <li><a href="<?php echo $wwwroot ?>/add_form_report.php">Add Report Form</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <svg class="stroke-icon">
                                <use href="assets/svg/icon-sprite.svg#home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                            </svg><span>SEO</span></a>
                        <ul class="sidebar-submenu custom-scrollbar">
                            <li class="sidebar-head">Search Engine Optimization</li>
                            <li class="main-submenu"><a class="d-flex sidebar-menu" href="javascript:void(0)">
                                    <svg class="stroke-icon">
                                        <use href="assets/svg/icon-sprite.svg#home"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                                    </svg>Mange SEO
                                    <svg class="arrow">
                                        <use href="assets/svg/icon-sprite.svg#Arrow-right"></use>
                                    </svg></a>
                                <ul class="submenu-wrapper">
                                    <li><a href="<?php echo $wwwroot ?>/manage_seo.php">Manage</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <svg class="stroke-icon">
                                <use href="assets/svg/icon-sprite.svg#home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                            </svg><span>Management System</span></a>
                        <ul class="sidebar-submenu custom-scrollbar">
                            <li class="sidebar-head">Management System</li>
                            <li class="main-submenu"><a class="d-flex sidebar-menu" href="javascript:void(0)">
                                    <svg class="stroke-icon">
                                        <use href="assets/svg/icon-sprite.svg#home"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                                    </svg>User Management
                                    <svg class="arrow">
                                        <use href="assets/svg/icon-sprite.svg#Arrow-right"></use>
                                    </svg></a>
                                <ul class="submenu-wrapper">
                                    <li><a href="<?php echo $wwwroot ?>/user_management.php">Manage User</a></li>
                                </ul>
                            </li>
                            <li class="main-submenu"><a class="d-flex sidebar-menu" href="javascript:void(0)">
                                    <svg class="stroke-icon">
                                        <use href="assets/svg/icon-sprite.svg#home"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                                    </svg>Role Management
                                    <svg class="arrow">
                                        <use href="assets/svg/icon-sprite.svg#Arrow-right"></use>
                                    </svg></a>
                                <ul class="submenu-wrapper">
                                    <li><a href="<?php echo $wwwroot ?>/role_management.php">Manage Role</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                </ul>
                </li>
                </ul>
            </div>
        </nav>
    </div>
</div>