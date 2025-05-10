<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sistem Informasi RT dan RW">
    <title>SiRT - Login</title>

    <?php echo $__env->make('include._header-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style>
        /* Mengatur background image */
        body {
            background-image: url('<?php echo e(asset('assets/img/login.jpg')); ?>');
            background-size: cover; /* Mengatur agar gambar selalu mengisi layar */
            background-repeat: no-repeat;
            background-position: center center; /* Menjaga posisi gambar tetap di tengah */
            height: 100vh; /* Memastikan gambar latar belakang menutupi seluruh halaman */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Menjaga form login tetap seperti semula, namun menggesernya ke tengah */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .row {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .col-xl-5, .col-lg-6, .col-md-10 {
            display: flex;
            justify-content: center;
        }

        /* Mengatur tampilan form login, tanpa border dan memberikan warna latar belakang yang menonjol */
        .card {
            margin-top: 250px;
            background-color: rgba(255, 255, 255, 0.9); /* Latar belakang putih transparan untuk menonjolkan form */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Memberikan efek bayangan halus */
            border-radius: 10px; /* Membuat sudut lebih lembut */
            width: 100%; /* Pastikan form mengisi lebar container */
            max-width: 500px; /* Membatasi lebar maksimal form */
        }

        .card-header {
            background-color: #007bff; /* Menegaskan warna latar belakang header */
            color: white;
            text-align: center;
            padding: 15px;
            border-radius: 5px;
            font-size: 1.25rem;
        }

        .card-body {
            padding: 20px;
        }

        .card .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* Menegaskan tombol */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Menjaga teks copyright tetap di bagian bawah */
        .text-center {
            font-size: 0.85rem;
            color: #555;
        }
    </style>
</head>

<body class="" id="body">

    <div class="container d-flex flex-column justify-content-between vh-100">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="app-brand" style="opacity: 1;">
                            <a href="/index.html">
                                <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33">
                                    <g fill="none" fill-rule="evenodd">
                                        <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                    </g>
                                </svg>
                                <span class="brand-name" style="opacity: 1;">SiRT</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-5">
                        <?php if($errors->any()): ?>
                        <div class="alert alert-dismissible fade show alert-danger" role="alert">
                            <?php echo e($errors->first()); ?>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif; ?>
                        <h4 class="text-dark mb-5">Masuk</h4>
                        <form action="/login" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="form-row col-md-12 mb-4">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control input-lg" id="username" placeholder="Masukan Username" name="username" value="<?php echo e(old('username')); ?>" required autocomplete="username" autofocus>
                                </div>
                                <div class="form-row col-md-12 mb-4">
                                    <label>Password</label>
                                    <input type="password" class="form-control input-lg" id="password" placeholder="Masukan Password" name="password" required autocomplete="current-password">
                                </div>
                                <div class="form-row col-md-12">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Masuk ke Aplikasi</button>
                                    <p class="text-center" style="margin-left: 35px;">
                                        &copy; <span id="copy-year">2025</span> Copyright SiRT by
                                        <a class="text-primary" href="" target="_blank">WC3Parser</a>.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let d = new Date();
            let year = d.getFullYear();
            document.getElementById("copy-year").innerHTML = year;
        </script>
    </div>

    <?php echo $__env->make('include._footer-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/layouts/login.blade.php ENDPATH**/ ?>