<?php $__env->startPush('page-title'); ?>
RT - Edit Pengumuman
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
<link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/select2/css/select2-boostrap.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Edit Pengumuman</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/rt/pengumuman">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                Data Pengumuman
            </li>
            <li class="breadcrumb-item" aria-current="page">Edit Pengumuman</li>
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
<form id="form" method="POST" action="<?php echo e(route('rt.pengumuman.update', $pengumuman->id)); ?>">
    <?php echo csrf_field(); ?>
    <input name="_method" type="hidden" value="PUT">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-default">
                <div class="card-header-border-bottom card-header d-flex justify-content-between">
                    <h2>Edit Pengumuman</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                            <label>Judul Pengumuman</label>
                            <input class="form-control" value="<?php echo e($pengumuman->judul_pengumuman); ?>" required name="judul"></input>
                        </div>
                        <div class="form-row col-lg-12 col-md-12 col-sm-12 mb-4">
                            <label>Isi Pengumuman</label>
                            <textarea class="form-control" rows="10" placeholder="Masukan isi pengumuman" required name="isi"><?php echo e($pengumuman->isi_pengumuman); ?></textarea>
                        </div>
                        <div class="w-100"></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg float-right">Edit Pengumuman</button>
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
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rt/pengumuman/edit.blade.php ENDPATH**/ ?>