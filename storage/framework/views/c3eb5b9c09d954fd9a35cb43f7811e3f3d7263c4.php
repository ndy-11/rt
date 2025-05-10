<?php $__env->startPush('page-title'); ?>
RT - Inventaris
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
    <h1>Data Inventaris RT</h1>
    <br>
    <a href="/rt/inventaris/create" target="" class="btn btn-outline-primary text-uppercase">
        <i class="fas fa-plus-circle mr-2"></i> Tambah Inventaris
    </a>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card-default" id="inventaris_barang">
            <div class="card-header-border-bottom card-header d-flex justify-content-between">
                <h2>Inventaris Barang</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <p class="">Data Inventaris Barang</p>
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
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Perolehan</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no); ?></td>
                                <td><?php echo e($val->kode_barang); ?></td>
                                <td><?php echo e($val->nama_barang); ?></td>
                                <td><?php echo e($val->tgl_perolehan); ?></td>
                                <!-- <td>Rp <?php echo e(number_format($val->harga,2,',','.')); ?></td> -->
                                <td>
                                    <a href="/rt/inventaris/<?php echo e($val->id); ?>?jenis=barang" class="btn btn-sm text-white btn-primary">Detail</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card-default" id="inventaris_perpustakaan">
            <div class="card-header-border-bottom card-header d-flex justify-content-between">
                <h2>Inventaris Perpustakaan</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <p class="">Data Inventaris Perpustakaan</p>
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
                                <th class="no-sort">Kode Buku</th>
                                <th class="no-sort">Judul</th>
                                <th>Tanggal Dimiliki</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $__currentLoopData = $perpustakaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no); ?></td>
                                <td><?php echo e($val->kode_buku); ?></td>
                                <td><?php echo e($val->judul); ?></td>
                                <td><?php echo e($val->tgl_dimiliki); ?></td>
                                <td>
                                    <a href="/rt/inventaris/<?php echo e($val->id); ?>?jenis=perpustakaan" class="btn btn-sm text-white btn-primary">Detail</a>
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
        <div class="card card-default" id="inventaris_tanah_bangunan">
            <div class="card-header-border-bottom card-header d-flex justify-content-between">
                <h2>Inventaris Tanah Bangunan</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <p class="">Data Inventaris Tanah Bangunan</p>
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
                                <th>Kode Tanah</th>
                                <th>Tanggal Dimiliki</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $__currentLoopData = $tanah_bangunan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no); ?></td>
                                <td><?php echo e($val->kode_tanah); ?></td>
                                <td><?php echo e($val->tgl_dimiliki); ?></td>
                                <td>
                                    <a href="/rt/inventaris/<?php echo e($val->id); ?>?jenis=tanah_bangunan" class="btn btn-sm text-white btn-primary">Detail</a>
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
        <div class="card card-default" id="inventaris_atk">
            <div class="card-header-border-bottom card-header d-flex justify-content-between">
                <h2>Inventaris ATK</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <p class="">Data Inventaris ATK</p>
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
                                <th>Kode Atk</th>
                                <th>Nama Atk</th>
                                <th>Tanggal Dimiliki</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $__currentLoopData = $atk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no); ?></td>
                                <td><?php echo e($val->kode_atk); ?></td>
                                <td><?php echo e($val->nama_atk); ?></td>
                                <td><?php echo e($val->tgl_dimiliki); ?></td>
                                <td>
                                    <a href="/rt/inventaris/<?php echo e($val->id); ?>?jenis=atk" class="btn btn-sm text-white btn-primary">Detail</a>
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
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rt/inventaris/index.blade.php ENDPATH**/ ?>