<?php
$user = $this->Session->read('Auth.User');
// pr($user);
?>
<div id="nav_bar">
<header class="topbar" style="background-color: #bdc1c9">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/Posts">
                        <b>
                            <img src="/img/logo_auth1.png" alt="homepage" class="light-logo" width="80" />
                        </b>
                        <span class="hidden-sm-down">   
                            <img src="/img/logo-text.png" class="light-logo" alt="homepage" />
                        </span> 
                    </a>
                </div>
                
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <?php echo $this->Session->flash('auth'); ?>
                            <?php 
                            if (isset($home)) {
                                echo $this->Form->create(
                                    'Posts',
                                    array(
                                        'url' => array('controller' => 'Posts', 'action' => 'index'),
                                        'type' => 'post',
                                        'class' => 'app-search d-none d-md-block d-lg-block'
                                    )
                                ); ?>
                            <input type="text" class="form-control" placeholder="Search & enter" name="search_post_description">
                            <?php 
                        }
                        echo $this->Form->end();
                        ?>
                                
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/img/blog/<?= $this->requestAction(['controller' => 'users', 'action' => 'getCurrentUser', 'image'], ['return']); ?>" alt="user"> <span class="text-dark"> <?= h($this->requestAction(['controller' => 'users', 'action' => 'getCurrentUser', 'fullname'], ['return'])); ?> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <a href="/users/profile/<?= $this->requestAction(['controller' => 'users', 'action' => 'getCurrentUser', 'id'], ['return']); ?>" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                                <a href="/Users/logout" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                
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
                            <a  href="/Posts" class="waves-effect waves-dark" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Home</span></a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="/Followers" aria-expanded="false"><i class="ti-direction-alt"></i><span class="hide-menu">Follow</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
</div>