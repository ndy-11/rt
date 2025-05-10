<?php $__env->startPush('page-title'); ?>
RW - Register
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
    <h1>Data Register</h1>
    <br>
    <a href="/rw/register/create" target="" class="btn btn-outline-primary text-uppercase">
        <i class="fas fa-plus-circle mr-2"></i> Tambah Register
    </a>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card-default" id="keluar_register_card">
            <div class="card-header-border-bottom card-header d-flex justify-content-between">
                <h2>Register Keluar</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <p class="">Data Register Keluar</p>
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
                                <th>No</th>
                                <th>No Surat</th>
                                <th>No Agenda</th>
                                <th>Penerima Surat</th>
                                <th>Tanggal Kirim</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $__currentLoopData = $register_keluar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no); ?></td>
                                <td><?php echo e($val->no_surat); ?></td>
                                <td><?php echo e($val->no_agenda); ?></td>
                                <td><?php echo e($val->penerima_surat); ?></td>
                                <td><?php echo e($val->tgl_kirim); ?></td>
                                <td>
                                    <a href="/rw/register/<?php echo e($val->id); ?>?jenis=keluar" class="btn btn-sm text-white btn-primary">Detail</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card-default" id="masuk_register_card">
            <div class="card-header-border-bottom card-header d-flex justify-content-between">
                <h2>Register Masuk</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <p class="">Data Register Masuk</p>
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
                                <th>No</th>
                                <th>No Surat</th>
                                <th>No Agenda</th>
                                <th>Asal Surat</th>
                                <th>Tanggal Surat</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $__currentLoopData = $register_masuk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no); ?></td>
                                <td><?php echo e($val->no_surat); ?></td>
                                <td><?php echo e($val->no_agenda); ?></td>
                                <td><?php echo e($val->asal_surat); ?></td>
                                <td><?php echo e($val->tgl_surat); ?></td>
                                <td>
                                    <a href="/rw/register/<?php echo e($val->id); ?>?jenis=masuk" class="btn btn-sm text-white btn-primary">Detail</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
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

    // $('#keluar_register').change(function() {
    //     if ($(this).attr('checked', true)) {
    //         $('#masuk_register_label').addClass('outlined')
    //         $('#keluar_register_label').removeClass('outlined')
    //         $('#keluar_register_card').removeClass('d-none');
    //         $('#masuk_register_card').addClass('d-none');
    //     }
    // });

    // $('#masuk_register').change(function() {
    //     if ($(this).attr('checked', true)) {
    //         $('#keluar_register_label').addClass('outlined')
    //         $('#masuk_register_label').removeClass('outlined')
    //         $('#masuk_register_card').removeClass('d-none');
    //         $('#keluar_register_card').addClass('d-none');
    //     }
    // });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rw/register/index.blade.php ENDPATH**/ ?>