<?php $__env->startPush('page-title'); ?>
RT - Undangan Pemilu
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
<link href="<?php echo e(asset('assets/plugins/summernote/summernote.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('assets/plugins/summernote/summernote-bs4.min.js')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Sebar Undangan Pemilu</h1>
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
            <li class="breadcrumb-item" aria-current="page">Buat Undangan</li>
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
<form id="form" method="POST" action="<?php echo e(route('rt.undangan-pemilu.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-12 col-md-8 col-sm-12">
            <div class="card card-default">
                <div class="card-header-border-bottom card-header d-flex justify-content-between">
                </div>
                <div class="card-body">
                    <textarea class="text-dark form-control mb-4" rows="8" id="summernote" name="content"></textarea>
                    <button type="submit" class="btn btn-primary btn-lg">Sebar Undangan</button>
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
<script src="<?php echo e(asset('assets/plugins/summernote/summernote.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 500,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rt/undangan_pemilu/create.blade.php ENDPATH**/ ?>