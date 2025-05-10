<?php $__env->startPush('page-title'); ?>
Warga - Buat Aspirasi
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
<link href="<?php echo e(asset('assets/plugins/summernote/summernote.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('assets/plugins/summernote/summernote-bs4.min.js')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Tambah Aspirasi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/warga/request">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                Data Aspirasi
            </li>
            <li class="breadcrumb-item" aria-current="page">Tambah Aspirasi</li>
        </ol>
    </nav>
</div>
<form id="form" action="<?php echo e(route('warga.aspirasi.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-default" id="request_card">
                <div class="card-header-border-bottom card-header d-flex justify-content-between">
                    <h2>Aspirasi Warga</h2>
                </div>
                <div class="card-body row">
                    <div class="form-row mb-4">
                        <label>Untuk Bagian</label>
                        <select class="form-control" name="id_bagian">
                            <?php $__currentLoopData = $bagian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val->id); ?>"><?php echo e($val->nama_bagian); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="w-100"></div>
                    <div class="form-row w-100 mb-4">
                        <label>Isi Aspirasi</label>
                        <div class="w-100"></div>
                        <textarea class="text-dark form-control mb-4" rows="8" id="summernote" name="content"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg">Tambah Aspirasi</button>
</form>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-script'); ?>
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
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/warga/aspirasi/create.blade.php ENDPATH**/ ?>