<?php
$user = $this->Session->read('Auth.User');
?>
<div id="nav_bar">
<header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <b>
                            <img src="/mbc/img/logo_auth1.png" alt="homepage" class="light-logo" width="80" />
                        </b>
                        <span class="hidden-sm-down">   
                            <img src="/mbc/img/logo-text.png" class="light-logo" alt="homepage" />
                        </span> 
                    </a>
                </div>
                
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                        <li class="nav-item">
                            <form class="app-search d-none d-md-block d-lg-block">
                                <input type="text" class="form-control" placeholder="Search & enter">
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/mbc/img/blog/<?= $user['image']; ?>" alt="user"> <span class="hidden-md-down"> <?= $user['fullname']; ?> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <a href="javascript:void(0)" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                                <a href="/mbc/Users/logout" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="/mbc/Posts" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Home</span></a>
                        </li>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="ti-direction-alt"></i><span class="hide-menu">Follow</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
</div>