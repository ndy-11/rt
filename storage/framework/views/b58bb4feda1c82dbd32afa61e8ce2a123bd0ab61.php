<?php $__env->startPush('page-title'); ?>
RT - Pemilu
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
    <h1>Pemilihan RT dan RW</h1>
    <br>
</div>
<div class="row">
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="card">
            <div class="card card-default" id="inventaris_barang">
                <div class="card-header-border-bottom card-header d-flex justify-content-between">
                    <h2>List Pemilu</h2>
                    <div>
                        <a href="/rt/pemilu/create" target="" class="btn btn-outline-primary text-uppercase">
                            <i class="fas fa-plus-circle mr-2"></i> Tambah Pemilu
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <p class=""></p>
                        <div>
                            <a href="/" target="" class="btn btn-outline-success btn-sm text-uppercase">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </a>
                            <a href="/" target="" class="btn btn-outline-info btn-sm text-uppercase">
                                <i class="fas fa-print"></i> Print
                            </a>
                        </div>
                    </div>
                    <div class="responsive-data-table">
                        <table class="table dt-responsive nowrap data-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Periode</th>
                                    <th>Tanggal</th>
                                    <th>Tempat</th>
                                    <th class="no-sort">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pemilu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($val->periode); ?></td>
                                    <td><?php echo e($val->tgl_pemilu); ?></td>
                                    <td><?php echo e($val->tempat_pemilu); ?></td>
                                    <td>
                                        <a class="btn btn-sm text-white btn-primary" href="/rt/pemilu/<?php echo e($val->id); ?>">Detail</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rt/pemilu/index.blade.php ENDPATH**/ ?>