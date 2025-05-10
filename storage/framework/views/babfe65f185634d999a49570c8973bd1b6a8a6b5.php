<?php $__env->startPush('page-title'); ?>
RT - Rapat - Create
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Tambah Rapat</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/rt/rapat">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                Data Rapat
            </li>
            <li class="breadcrumb-item" aria-current="page">Tambah Rapat</li>
        </ol>
    </nav>
</div>

<form id="form" method="POST" action="<?php echo e(route('rt.rapat.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-12">
            <?php if($errors->any()): ?>
            <div class="alert alert-dismissible fade show alert-danger" role="alert">
                <?php echo e(implode('', $errors->all(':message'))); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card card-default" id="reg_keluar">
                <div class="card-header-border-bottom card-header d-flex justify-content-between">
                    <h2>Register Keluar</h2>
                </div>
                <div class="card-body">
                    
                    <div class="form-row mb-4">
                        <label>Pemimpin Rapat</label>
                        <select name="id_pemimpin"  class="form-control">
                            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val->warga->id); ?>"><?php echo e($val->warga->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-row mb-4">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tgl_rapat">
                    </div>

                    <div class="form-row mb-4">
                        <label>Waktu</label>
                        <input type="text" class="form-control" name="waktu_rapat">
                    </div>

                    <div class="form-row mb-4">
                        <label>Tempat</label>
                        <input type="text" class="form-control" name="tempat_rapat">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg">Tambah Data</button>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-script'); ?>
<script src="<?php echo e(asset('assets/plugins/data-tables/jquery.datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/data-tables/datatables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/data-tables/datatables.responsive.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rt/rapat/create.blade.php ENDPATH**/ ?>