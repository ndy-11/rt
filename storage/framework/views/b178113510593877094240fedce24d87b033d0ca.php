<?php $__env->startPush('page-title'); ?>
Warga - Pemilu
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
<link href="<?php echo e(asset('assets/plugins/daterangepicker/daterangepicker.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('assets/plugins/data-tables/datatables.bootstrap4.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('assets/plugins/data-tables/responsive.datatables.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/select2/css/select2-boostrap.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1>Pemilihan <?php echo e(Auth::user()->bagian->nama_bagian); ?> dan RW 001</h1>
    <br>
</div>
<div class="row">
    <?php if($undangan_rt != null): ?>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-default">
            <div class="card-header-border-bottom card-header d-flex justify-content-between">
                <h2>Undangan Pemilu RT</h2>
            </div>
            <div class="card-body">
                <div class="form-row mb-4">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <label for="">Periode</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($pemilu_rt->periode); ?></h5>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <label for="">Tanggal Pelaksanaan</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($pemilu_rt->tgl_pemilu); ?></h5>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <label for="">Tempat Pelaksanaam</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($pemilu_rt->tempat_pemilu); ?></h5>
                    </div>
                </div>
                <?php echo html_entity_decode($undangan_rt->isi); ?>

            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if($undangan_rw != null): ?>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-default">
            <div class="card-header-border-bottom card-header d-flex justify-content-between">
                <h2>Undangan Pemilu RW</h2>
            </div>
            <div class="card-body">
                <div class="form-row mb-4">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <label for="">Periode</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($pemilu_rw->periode); ?></h5>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <label for="">Tanggal Pelaksanaan</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($pemilu_rw->tgl_pemilu); ?></h5>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <label for="">Tempat Pelaksanaam</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($pemilu_rw->tempat_pemilu); ?></h5>
                    </div>
                </div>
                <?php echo html_entity_decode($undangan_rw->isi); ?>

            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if($calon_rt != null): ?>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-default">
            <div class="card-header-border-bottom card-header d-flex justify-content-between">
                <h2>Pilih Calon RT</h2>
            </div>
            <div class="card-body">
                <div class="responsive-data-table">
                    <table class="table dt-responsive nowrap data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th class="no-sort">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $calon_rt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($val->nama); ?></td>
                                <td><?php echo e($val->jkel); ?></td>
                                <td><?php echo e($val->alamat); ?></td>
                                <td>
                                    <form action="<?php echo e(route('warga.pemilu.store')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id_warga" value="<?php echo e($val->id); ?>">
                                        <input type="hidden" name="tipe" value="RT">
                                        <button type="submit" class="btn btn-sm btn-primary">Pilih</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="w-100"></div>

    <?php if($calon_rw != null): ?>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-default">
            <div class="card-header-border-bottom card-header d-flex justify-content-between">
                <h2>Pilih Calon RW</h2>
            </div>
            <div class="card-body">
                <div class="responsive-data-table">
                    <table class="table dt-responsive nowrap data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th class="no-sort">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $calon_rw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($val->nama); ?></td>
                                <td><?php echo e($val->jkel); ?></td>
                                <td><?php echo e($val->alamat); ?></td>
                                <td>
                                    <form action="<?php echo e(route('warga.pemilu.store')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id_warga" value="<?php echo e($val->id); ?>">
                                        <input type="hidden" name="tipe" value="RW">
                                        <button type="submit" class="btn btn-sm btn-primary">Pilih</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-script'); ?>
<script src="<?php echo e(asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/data-tables/jquery.datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/data-tables/datatables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/data-tables/datatables.responsive.min.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('.data-table').DataTable({
            "responsive": true,
            "aLengthMenu": [
                [20, 30, 50, 75, -1],
                [20, 30, 50, 75, "All"]
            ],
            "pageLength": 20,
            "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }]
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/warga/pemilu/index.blade.php ENDPATH**/ ?>