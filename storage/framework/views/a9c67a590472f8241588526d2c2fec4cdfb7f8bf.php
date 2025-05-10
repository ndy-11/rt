<?php $__env->startPush('page-title'); ?>
RT - Edit Mutasi Warga
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
<link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/select2/css/select2-boostrap.min.css')); ?>">
<link href="<?php echo e(asset('assets/plugins/data-tables/datatables.bootstrap4.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('assets/plugins/data-tables/responsive.datatables.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Edit Mutasi Warga</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/rt/penduduk">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="/rt/mutasi">
                    Data Mutasi
                </a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Edit Mutasi Warga</li>
        </ol>
    </nav>
</div>
<form action="<?php echo e(route('rt.mutasi.update', $warga->id)); ?>" method="post">
    <?php echo csrf_field(); ?>
    <input name="_method" type="hidden" value="PUT">
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Edit Mutasi Warga</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-row col-lg-4 col-md-4 col-sm-12 mb-4">
                            <label>Tanggal Mutasi</label>
                            <input type="date" class="form-control" name="tgl_mutasi" value="<?php echo e($warga->mutasi->tgl_mutasi); ?>" id="inputTglMutasi" placeholder="Masukan Tanggal Mutasi" required">
                        </div>
                        <div class="form-row col-lg-4 col-md-6 col-sm-12 mb-4">
                            <label>Status Mutasi</label>
                            <select class="form-control" name="status">
                                <option value="Pindah" <?php echo e('Pindah' == $warga->mutasi->status ? 'selected' : ''); ?>>Pindah</option>
                                <option value="Datang" <?php echo e('Datang' == $warga->mutasi->status ? 'selected' : ''); ?>>Datang</option>
                                <option value="Meninggal" <?php echo e('Meninggal' == $warga->mutasi->status ? 'selected' : ''); ?>>Meninggal</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg">Edit Penduduk Sementara</button>
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
        $(".select2-pemilik").select2({
            theme: "bootstrap",
            placeholder: "Pilih pemilik rumah",
            maximumSelectionSize: 6,
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rt/penduduk/mutasi_warga/edit.blade.php ENDPATH**/ ?>