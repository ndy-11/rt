<?php $__env->startPush('page-title'); ?>
RT - Tambah Mutasi Warga
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
<link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/select2/css/select2-boostrap.min.css')); ?>">
<link href="<?php echo e(asset('assets/plugins/data-tables/datatables.bootstrap4.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('assets/plugins/data-tables/responsive.datatables.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Tambah Mutasi Warga</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/rt/mutasi">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="/rt/mutasi">
                    Data Mutasi Warga
                </a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Tambah Mutasi Warga</li>
        </ol>
    </nav>
</div>
<form action="<?php echo e(route('rt.mutasi.store')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-bottom-border">
                    <h2>Pilih Warga</h2>
                </div>
                <div class="card-body">
                    <div class="responsive-data-table">
                        <table class="table dt-responsive nowrap data-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Pilih</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>NIK</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $warga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <label class="control outlined control-checkbox checkbox-primary">
                                            <input name="id_warga[]" type="checkbox" value="<?php echo e($val->id); ?>" />
                                            <div class="control-indicator"></div>
                                        </label>
                                    </td>
                                    <td><?php echo e($val->nama); ?></td>
                                    <td><?php echo e($val->jkel); ?></td>
                                    <td><?php echo e($val->alamat); ?></td>
                                    <td><?php echo e($val->nik); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Input Mutasi</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-row col-lg-4 col-md-4 col-sm-12 mb-4">
                            <label>Tanggal Mutasi</label>
                            <input type="date" class="form-control" name="tgl_mutasi" id="inputTglMutasi" placeholder="Masukan Tanggal Mutasi" required value="<?php echo e(old('tgl_mutasi')); ?>">
                        </div>
                        <div class="form-row col-lg-4 col-md-6 col-sm-12 mb-4">
                            <label>Status Mutasi</label>
                            <select class="form-control" name="status">
                                <option value="Pindah">Pindah</option>
                                <option value="Datang">Datang</option>
                                <option value="Meninggal">Meninggal</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg">Tambah Data Mutasi</button>
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
        $('.data-table').DataTable();
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rt/penduduk/mutasi_warga/create.blade.php ENDPATH**/ ?>