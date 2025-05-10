<?php $__env->startPush('page-title'); ?>
RW - Pemilu
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
<link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/select2/css/select2-boostrap.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Tambah Pemilu</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/rt/pemilu">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                Data Pemilu
            </li>
            <li class="breadcrumb-item" aria-current="page">Tambah Pemilu</li>
        </ol>
    </nav>
</div>
<?php if($errors->any()): ?>
<div class="alert alert-dismissible fade show alert-danger" role="alert">
    <?php echo e(implode('', $errors->all(':message'))); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>
<form id="form" method="POST" action="<?php echo e(route('rw.pemilu.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="card card-default">
                <div class="card-header-border-bottom card-header d-flex justify-content-between">
                    <h2>Input Pemilu</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                            <label>Periode</label>
                            <input type="number" class="form-control" placeholder="Masukan periode pemilu" required name="periode"></input>
                        </div>
                        <div class="w-100"></div>
                        <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                            <label>Tanggal Pemilu</label>
                            <input type="date" class="form-control" placeholder="Masukan tanggal pemilu" required name="tgl_pemilu"></input>
                        </div>
                        <div class="w-100"></div>
                        <div class="form-row col-lg-12 col-md-12 col-sm-12 mb-4">
                            <label>Tempat Pemilu</label>
                            <input type="text" class="form-control" placeholder="Masukan tempat pemilu" required name="tempat_pemilu"></input>
                        </div>
                        <div class="w-100"></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Tambah Data</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-script'); ?>
<script src="<?php echo e(asset('assets/plugins/jquery-mask-input/jquery.mask.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/jquery-mask-input/jquery.inputmask.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rw/pemilu/create.blade.php ENDPATH**/ ?>