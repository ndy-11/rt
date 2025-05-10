<?php $__env->startPush('page-title'); ?>
RW - Detail Pemilu
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Detail Pemilu</h1>
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
            <li class="breadcrumb-item" aria-current="page">Detail Pemilu</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                    <i class="mdi mdi-vote font-size-20"></i>
                </div>
                <h2>Informasi Pemilu <?php echo e(Auth::user()->bagian->nama_bagian); ?></h2>
            </div>
            <div class="card-body">
                <div class="form-row mb-4">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <label for="">Periode</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($pemilu->periode); ?></h5>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <label for="">Tanggal Pelaksanaan</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($pemilu->tgl_pemilu); ?></h5>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <label for="">Tempat Pelaksanaam</label>
                        <div class="w-100"></div>
                        <h5 class="text-dark"><?php echo e($pemilu->tempat_pemilu); ?></h5>
                    </div>
                </div>
                <a href="/rw/pemilu/<?php echo e($pemilu->id); ?>/edit" class="mr-2 btn btn-warning btn-pill text-white">
                    <i class="mdi mdi-circle-edit-outline"></i>
                    Edit
                </a>
                <?php if($undangan): ?>
                <a href="/rw/undangan-pemilu/<?php echo e($undangan->id); ?>/edit" class="mr-2 btn btn-primary btn-pill text-white">
                    <i class="mdi mdi-circle-edit-outline"></i>
                    Edit Undangan
                </a>
                <?php else: ?>
                <a href="/rw/undangan-pemilu/create" class="mr-2 btn btn-primary btn-pill text-white">
                    <i class="mdi mdi-circle-edit-outline"></i>
                    Sebar Undangan
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                    <i class="mdi mdi-account-group font-size-20"></i>
                </div>
                <h2>Usulan Calon Ketua RW</h2>
            </div>
            <div class="card-body">
                <div class="responsive-data-table">
                    <table class="table dt-responsive nowrap data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $calonRW; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($val->warga->nama); ?></td>
                                <td><?php echo e($val->warga->jkel); ?></td>
                                <td><?php echo e($val->total); ?></td>
                            </tr>
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
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rw/pemilu/detail.blade.php ENDPATH**/ ?>