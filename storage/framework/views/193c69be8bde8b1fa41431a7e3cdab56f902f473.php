<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sistem Informasi RT dan RW">
    <title>
        <?php echo $__env->yieldPushContent('page-title'); ?>
    </title>

    <?php echo $__env->make('include._header-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('custom-style'); ?>
</head>
<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
<div class="wrapper">
    <aside class="left-sidebar bg-sidebar">
        <div id="sidebar" class="sidebar">
            <!-- Aplication Brand -->
            <div class="app-brand">
                <a href="/" title="SiRT">
                    <svg
                        class="brand-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="xMidYMid"
                        width="30"
                        height="33"
                        viewBox="0 0 30 33"
                    >
                        <g fill="none" fill-rule="evenodd">
                            <path
                                class="logo-fill-blue"
                                fill="#7DBCFF"
                                d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
                            />
                            <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                        </g>
                    </svg>
                    <span class="brand-name text-truncate">SiRT</span>
                </a>
            </div>
            <div class="sidebar-scrollbar">
                <?php echo $__env->make('include._sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </aside>
    <div class="page-wrapper">
        <div class="content-wrapper">
            <header class="main-header " id="header">
                <?php echo $__env->make('include._navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </header>
            <div class="content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>

        <footer class="footer mt-auto">
            <div class="copyright bg-white">
                <p>
                    &copy; <span id="copy-year">2020</span> Copyright SiRT by
                    <a
                        class="text-primary"
                        href=""
                        target="_blank"
                    >WC3Parser</a>.
                </p>
            </div>
            <script>
                let d = new Date();
                let year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
        </footer>
    </div>
</div>
<?php echo $__env->make('include._footer-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldPushContent('custom-script'); ?>
</body>
</html>
<?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/layouts/default.blade.php ENDPATH**/ ?>