<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>

        <div class="search-form d-none d-lg-inline-block">
        </div>

        <div class="navbar-right ">
            <ul class="nav navbar-nav">
                <!-- Notification -->
                <li class="dropdown notifications-menu">
                    <button class="dropdown-toggle" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header">You have 5 notifications</li>
                        <li>
                            <a href="#">
                                <i class="mdi mdi-account-plus"></i> New user registered
                                <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="<?php echo e(asset('assets/img/user/user.png')); ?>" class="user-image" alt="User Image" />
                        <span class="d-none d-lg-inline-block">
                            <?php if(isset(Auth::user()->warga) && Auth::user()->warga): ?>
                                <?php echo e(Auth::user()->warga->nama); ?>

                            <?php else: ?>
                                Warga not available
                            <?php endif; ?>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- User image -->
                        <li class="dropdown-header">
                            <img src="<?php echo e(asset('assets/img/user/user.png')); ?>" class="img-circle" alt="User Image" />
                            <div class="d-inline-block p-2">
                                <?php if(isset(Auth::user()->warga) && Auth::user()->warga): ?>
                                    <?php echo e(Auth::user()->warga->nama); ?> <small class="pt-1"><?php echo e(Auth::user()->warga->nik); ?></small>
                                <?php else: ?>
                                    Warga not available
                                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <a href="/">
                                <i class="mdi mdi-account"></i> My Profile
                            </a>
                        </li>
                        <li class="dropdown-footer">
                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout"></i> Log Out
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/include/_navbar.blade.php ENDPATH**/ ?>