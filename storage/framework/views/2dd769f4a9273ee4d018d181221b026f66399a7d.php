<?php $__env->startPush('page-title'); ?>
RW - Tamu - Create
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Tambah Tamu Kunjungan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/rw/bagian">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                Data Tamu Kunjungan
            </li>
            <li class="breadcrumb-item" aria-current="page">Tambah Tamu Kunjungan</li>
        </ol>
    </nav>
</div>
<form id="form" method="POST" action="<?php echo e(route('rw.tamu-kunjungan.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-default" id="tamu_umum">
                <div class="card-header-border-bottom card-header d-flex justify-content-between">
                    <h2>Identitas Tamu Kunjungan</h2>
                </div>
                <div class="card-body row">
                    <div class="form-row mb-4 col-lg-4 col-md-6 col-sm-12">
                        <label>Nama Tamu</label>
                        <input type="text" class="form-control" name="nama_tamu" placeholder="Masukan Nama Tamu">
                    </div>
                    <div class="form-row mb-4 col-lg-2 col-md-6 col-sm-12">
                        <label>Periode Tamu</label>
                        <input type="text" class="form-control" name="periode_tamu" placeholder="Masukan Periode Tamu">
                    </div>
                    <div class="w-100"></div>
                    <div class="form-row mb-4 col-lg-4 col-md-6 col-sm-12">
                        <label>Tujuan Tamu</label>
                        <input type="text" class="form-control" name="tujuan_tamu" placeholder="Masukan Tujuan Tamu">
                    </div>
                    <div class="form-row mb-4 col-lg-4 col-md-6 col-sm-12">
                        <label>Tanggal kunjungan tamu</label>
                        <input type="date" class="form-control" name="tanggal_tamu">
                    </div>
                    <div class="w-100"></div>
                    <div class="form-row mb-4 col-lg-4 col-md-6 col-sm-12">
                        <label>Jenis Tamu</label>
                        <div class="w-100 mb-2"></div>
                        <ul class="list-unstyled list-inline">
                            <li class="d-inline-block mr-3">
                                <label class="control control-radio">Umum
                                    <input type="radio" id="jenistamu_umum" name="jenis_tamu" checked="checked" value="Umum" />
                                    <div class="control-indicator"></div>
                                </label>
                            </li>
                            <li class="d-inline-block mr-3">
                                <label class="control control-radio">Khusus
                                    <input type="radio" id="jenistamu_khusus" name="jenis_tamu" value="Khusus" />
                                    <div class="control-indicator"></div>
                                </label>
                            </li>
                            <li class="d-inline-block mr-3">
                                <label class="control control-radio">Dinas
                                    <input type="radio" id="jenistamu_dinas" name="jenis_tamu" value="Dinas" />
                                    <div class="control-indicator"></div>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100"></div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-default d-none" id="tamu_khusus">
                <div class="card-header-border-bottom card-header d-flex justify-content-between">
                    <h2>Tamu Khusus</h2>
                </div>
                <div class="card-body row">
                    <div class="form-row mb-4 col-lg-4 col-md-6 col-sm-12">
                        <label>Jabatan Tamu</label>
                        <input type="text" class="form-control" name="jabatan_tamu" placeholder="Masukan Jabatan Tamu">
                    </div>
                    <div class="form-row mb-4 col-lg-4 col-md-6 col-sm-12">
                        <label>Instansi Tamu</label>
                        <input type="text" class="form-control" name="instansi_tamu" placeholder="Masukan Instansi Tamu">
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-default d-none" id="tamu_dinas">
                <div class="card-header-border-bottom card-header d-flex justify-content-between">
                    <h2>Tamu Dinas</h2>
                </div>
                <div class="card-body row">
                    <div class="form-row mb-4 col-lg-4 col-md-6 col-sm-12">
                        <label>Jabatan Tamu</label>
                        <input type="text" class="form-control" name="jabatan_tamu_dinas" placeholder="Masukan Jabatan Tamu">
                    </div>
                    <div class="form-row mb-4 col-lg-4 col-md-6 col-sm-12">
                        <label>Instansi Tamu</label>
                        <input type="text" class="form-control" name="instansi_tamu_dinas" placeholder="Masukan Instansi Tamu">
                    </div>
                    <div class="w-100"></div>
                    <div class="form-row mb-4 col-lg-4 col-md-6 col-sm-12">
                        <label>NIP Tamu</label>
                        <input type="text" class="form-control" name="nip_tamu" placeholder="Masukan NIP Tamu">
                    </div>

                    <div class="form-row mb-4 col-lg-4 col-md-6 col-sm-12">
                        <label>Nomor Surat Tugas Tamu</label>
                        <input type="text" class="form-control" name="no_surat_tugas_tamu" placeholder="Masukan Nomor Surat Tugas Tamu">
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
<script>
    $('#jenistamu_umum').change(function() {
        if ($(this).attr('checked', true)) {
            $('#tamu_dinas').addClass('d-none');
            $('#tamu_khusus').addClass('d-none');
        }
    });

    $('#jenistamu_khusus').change(function() {
        if ($(this).attr('checked', true)) {
            $('#tamu_khusus').removeClass('d-none');
            $('#tamu_dinas').addClass('d-none');
        }
    });


    $('#jenistamu_dinas').change(function() {
        if ($(this).attr('checked', true)) {
            $('#tamu_khusus').addClass('d-none');
            $('#tamu_dinas').removeClass('d-none');
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rw/tamu_kunjungan/create.blade.php ENDPATH**/ ?>