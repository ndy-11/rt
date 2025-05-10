<?php $__env->startPush('page-title'); ?>
RW - Edit Register
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
<link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/select2/css/select2-boostrap.min.css')); ?>">
<link href="<?php echo e(asset('assets/plugins/data-tables/datatables.bootstrap4.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('assets/plugins/data-tables/responsive.datatables.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Edit Register</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/rw/register">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="/rw/register">
                    Data Register
                </a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Edit Register</li>
        </ol>
    </nav>
</div>
<form action="<?php echo e(route('rw.register.update', $register->id)); ?>" method="post">
    <?php echo csrf_field(); ?>
    <input name="_method" type="hidden" value="PUT">
    <input name="jenis" type="hidden" value="<?php echo e($jenis); ?>">
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Edit Register</h2>
                </div>
                <div class="card-body">
                    <?php if($jenis == 'keluar'): ?>
                    <div class="row">
                        <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                            <label>Nomor Surat</label>
                            <input type="text" class="form-control" name="no_surat_keluar" value="<?php echo e($register->no_surat); ?>">
                        </div>
                        <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                            <label>Nomor Agenda</label>
                            <input type="text" class="form-control" name="no_agenda_keluar" value="<?php echo e($register->no_agenda); ?>">
                        </div>
                        <div class="w-100"></div>
                        <div class="form-row col-lg-4 col-md-6 col-sm-12 mb-4">
                            <label>Tanggal Kirim</label>
                            <input type="date" class="form-control" name="tgl_kirim" value="<?php echo e($register->tgl_kirim); ?>">
                        </div>
                        <div class="w-100"></div>
                        <div class="form-row col-lg-4 col-md-6 col-sm-12 mb-4">
                            <label>Tanggal Terima</label>
                            <input type="date" class="form-control" name="tgl_terima_keluar" value="<?php echo e($register->tgl_terima); ?>">
                        </div>
                        <div class="form-row col-lg-4 col-md-6 col-sm-12 mb-4">
                            <label>Penerima Surat</label>
                            <input type="text" class="form-control" name="penerima_surat_keluar" value="<?php echo e($register->penerima_surat); ?>">
                        </div>
                        <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                            <label>Perihal</label>
                            <input type="text" class="form-control" name="perihal_keluar" value="<?php echo e($register->perihal); ?>">
                        </div>
                    </div>
                    <?php elseif($jenis == 'masuk'): ?>
                    <div class="row">
                        <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                            <label>Nomor Surat</label>
                            <input type="text" class="form-control" name="no_surat_masuk" value="<?php echo e($register->no_surat); ?>">
                        </div>
                        <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                            <label>Nomor Agenda</label>
                            <input type="text" class="form-control" name="no_agenda_masuk" value="<?php echo e($register->no_agenda); ?>">
                        </div>
                        <div class="w-100"></div>
                        <div class="form-row col-lg-4 col-md-6 col-sm-12 mb-4">
                            <label>Tanggal Surat</label>
                            <input type="date" class="form-control" name="tgl_surat" value="<?php echo e($register->tgl_surat); ?>">
                        </div>
                        <div class="w-100"></div>
                        <div class="form-row col-lg-4 col-md-6 col-sm-12 mb-4">
                            <label>Tanggal Terima</label>
                            <input type="date" class="form-control" name="tgl_terima_masuk" value="<?php echo e($register->tgl_terima); ?>">
                        </div>
                        <div class="form-row col-lg-4 col-md-6 col-sm-12 mb-4">
                            <label>Asal Surat</label>
                            <input type="text" class="form-control" name="asal_surat_masuk" value="<?php echo e($register->asal_surat); ?>">
                        </div>
                        <div class="w-100"></div>
                        <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                            <label>Perihal</label>
                            <input type="text" class="form-control" name="perihal_masuk" value="<?php echo e($register->perihal); ?>">
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg">Edit Register</button>
</form>

<?php if($errors->any()): ?>
<div class="alert alert-dismissible fade show alert-danger" role="alert">
    <?php echo e(implode('', $errors->all(':message'))); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-script'); ?>
<script src="<?php echo e(asset('assets/plugins/jquery-mask-input/jquery.mask.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/jquery-mask-input/jquery.inputmask.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/data-tables/jquery.datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/data-tables/datatables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/data-tables/datatables.responsive.min.js')); ?>"></script>
<script>
    $(document).ready(function() {

    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rw/register/edit.blade.php ENDPATH**/ ?>