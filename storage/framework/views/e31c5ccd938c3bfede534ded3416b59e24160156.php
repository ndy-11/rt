<?php $__env->startPush('page-title'); ?>
RW - Detail Penduduk
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Detail Warga</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/rw/penduduk">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                Data Warga
            </li>
            <li class="breadcrumb-item" aria-current="page">Detail Warga</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                    <i class="mdi mdi-account font-size-20"></i>
                </div>
                <h2>Identitas Warga</h2>
            </div>
            <div class="card-body">
                <div class="form-row mb-4">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Nama Lengkap</label>
                        <div class="w-100"></div>
                        <h3 class="text-dark"><?php echo e($warga->nama); ?> (<?php echo e($warga->jkel); ?>)</h3>
                    </div>
                   <!-- <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Nomor Induk Penduduk</label>
                        <div class="w-100"></div>
                        <h3 class="text-dark"><?php echo e($warga->nik); ?></h3>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Nomor Kartu Keluarga</label>
                        <div class="w-100"></div>
                        <h3 class="text-dark"><?php echo e($warga->no_kk); ?></h3>
                    </div> -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">RT</label>
                        <div class="w-100"></div>
                        <h3 class="text-dark"><?php echo e($warga->no_rt); ?></h3>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">RW</label>
                        <div class="w-100"></div>
                        <h3 class="text-dark"><?php echo e($warga->no_rw); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                    <i class="mdi mdi-account-card-details font-size-20"></i>
                </div>
                <h2>Informasi Warga</h2>
            </div>
            <div class="card-body">
                <div class="form-row mb-4">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Jenis Kelamin</label>
                        <div class="w-100"></div>
                        <?php if($warga->jkel == "P"): ?>
                        <h5 class="text-dark">Perempuan</h5>
                        <?php else: ?>
                        <h5 class="text-dark">Laki-Laki</h5>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Tanggal Lahir</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($warga->tgl_lahir); ?></h5>
                    </div>
                  <!--  <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Agama</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($warga->agama); ?></h5>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Pendidikan</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($warga->pendidikan); ?></h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Pekerjaan</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($warga->pekerjaan); ?></h5>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-info text-white">
                    <i class="mdi mdi-home-map-marker font-size-20"></i>
                </div>
                <h2>Alamat Warga</h2>
            </div>
            <div class="card-body">
                <div class="form-row mb-4">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <label for="">Alamat KTP</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($warga->alamat_ktp); ?></h5>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <label for="">Alamat Tinggal</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($warga->alamat); ?></h5>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rw/penduduk/detail.blade.php ENDPATH**/ ?>