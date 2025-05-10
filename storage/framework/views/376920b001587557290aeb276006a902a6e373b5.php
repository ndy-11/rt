<?php $__env->startPush('page-title'); ?>
    RT - Penduduk
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
    <link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/select2/css/select2-boostrap.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-wrapper">
        <h1 class="mb-2">Tambah Penduduk</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="/rt/penduduk">
                        <span class="mdi mdi-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    Data Penduduk
                </li>
                <li class="breadcrumb-item" aria-current="page">Tambah Penduduk</li>
            </ol>
        </nav>
    </div>
    <?php if($errors->any()): ?>
        <div class="alert alert-dismissible fade show alert-danger" role="alert">
            <?php echo e(implode('', $errors->all(':message'))); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <form id="form" method="POST" action="<?php echo e(route('rt.penduduk.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="card card-default">
                    <div class="card-header-border-bottom card-header d-flex justify-content-between">
                        <h2>Input Data Warga</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-row col-lg-12 col-md-12 col-sm-12 mb-4">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama"
                                       placeholder="Masukan Nama Lengkap" required value="<?php echo e(old('nama')); ?>">
                            </div>
                         <!--   <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>NIK (Nomor Induk Penduduk)</label>
                                <input type="text" class="form-control" name="nik" id="inputNIK"
                                       placeholder="Masukan NIK" required minlength="16" maxlength="16" value="<?php echo e(old('nik')); ?>">
                                <div class="valid-feedback">
                                    Bagus! NIK tersedia
                                </div>
                                <div class="invalid-feedback">
                                    Maaf, sudah ada warga dengan NIK sama
                                </div>
                            </div> -->
                            <!-- <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>No. KK</label>
                                <input type="text" class="form-control" name="no_kk" id="inputNoKK"
                                       placeholder="Masukan Nomor KK" required minlength="16" maxlength="16" value="<?php echo e(old('no_kk')); ?>">
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                </div>
                            </div> -->
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>RT</label>
                                <select id="select-rt" class="form-control select2-rt" name="no_rt" required>
                                    <option value="">Pilih RT</option>
                                    <?php $__currentLoopData = $rts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($rt->id); ?>"><?php echo e($rt->nama_bagian); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>RW</label>
                                <select id="select-rw" class="form-control select2-rw" name="no_rw" required>
                                    <option value="">Pilih RW</option>
                                    <?php $__currentLoopData = $rws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($rw->id); ?>"><?php echo e($rw->nama_bagian); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-4 col-md-4 col-sm-12 mb-4">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" id="inputTglLahir"
                                       placeholder="Masukan Tanggal Lahir" required value="<?php echo e(old('tgl_lahir')); ?>">
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Jenis Kelamin</label>
                                <div class="w-100 mb-2"></div>
                                <ul class="list-unstyled list-inline">
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Laki Laki
                                            <input type="radio" name="jkel" checked="checked" value="L"/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Perempuan
                                            <input type="radio" name="jkel" value="P"/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                      <!--      <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Status Kawin</label>
                                <div class="w-100 mb-2"></div>
                                <ul class="list-unstyled list-inline">
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Belum
                                            <input type="radio" name="status_kawin" checked="checked" value="Belum"/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Sudah
                                            <input type="radio" name="status_kawin" value="Sudah"/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                </ul>
                            </div> 
                            <div class="w-100"></div>
                            <div class="form-row col-lg-4 col-md-6 col-sm-12 mb-4">
                                <label>Agama</label>
                                <select class="form-control" name="agama">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Pendidikan</label>
                                <select class="form-control" name="pendidikan">
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="Diploma 1">Diploma 1</option>
                                    <option value="Diploma 2">Diploma 2</option>
                                    <option value="Diploma 3">Diploma 3</option>
                                    <option value="Diploma 4">Diploma 4</option>
                                    <option value="Strata 1">Strata 1</option>
                                    <option value="Strata 2">Strata 2</option>
                                    <option value="Strata 3">Strata 3</option>
                                    <option value="Strata 4">Strata 4</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Pekerjaan</label>
                                <input class="form-control" name="pekerjaan" required placeholder="Masukan Pekerjaan">
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kewarganegaraan</label>
                                <div class="w-100 mb-2"></div>
                                <ul class="list-unstyled list-inline">
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">WNI
                                            <input type="radio" name="kewarganegaraan" checked="checked" value="WNI"/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">WNA
                                            <input type="radio" name="kewarganegaraan" value="WNA"/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kedudukan Keluarga</label>
                                <div class="w-100 mb-2"></div>
                                <ul class="list-unstyled list-inline">
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Kepala Keluarga
                                            <input type="radio" name="kedudukan_keluarga" checked="checked"
                                                   value="Kepala"/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Anggota Keluarga
                                            <input type="radio" name="kedudukan_keluarga" value="Anggota"/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                </ul>
                            </div> -->
                            <div class="w-100 mb-4">
                                <hr class="my-4">
                                <h5 class="">Alamat KTP</h5>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Provinsi</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="provinsi-ktp" class="form-control select2-prov">
                                    </select>
                                    <input type="hidden" name="prov_ktp">
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kota / Kabupaten</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kota-ktp" class="form-control select2-kot">
                                    </select>
                                    <input type="hidden" name="kota_ktp">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kecamatan</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kec-ktp" class="form-control select2-kec">
                                    </select>
                                    <input type="hidden" name="kec_ktp">
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kelurahan / Desa</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kel-ktp" class="form-control select2-kel">
                                    </select>
                                    <input type="hidden" name="kel_ktp">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-12 col-md-12 col-sm-12 mb-4">
                                <label>Alamat Jalan</label>
                                <textarea class="form-control mb-2" rows="2" placeholder="Masukan Alamat"
                                          name="alamat_ktp"></textarea>
                                <p style="font-size: 90%">Tidak perlu menyertakan Provinsi, Kota/Kab, Kecamatan,
                                    Kelurahan/Desa</p>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-12">
                                <label class="control outlined control-checkbox checkbox-primary">Apakah alamat KTP sama
                                    dengan alamat tinggal ?
                                    <input id="alamat-sama" name="alamat_sama" type="checkbox"/>
                                    <div class="control-indicator"></div>
                                </label>
                            </div>


                            <div class="w-100 mb-4 tinggal">
                                <hr class="my-4">
                                <h5 class="">Alamat Tinggal</h5>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4 tinggal">
                                <label>Provinsi</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="provinsi-tinggal" class="form-control select2-prov">
                                    </select>
                                    <input type="hidden" name="prov_tinggal">
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4 tinggal">
                                <label>Kota / Kabupaten</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kota-tinggal" class="form-control select2-kot">
                                    </select>
                                    <input type="hidden" name="kota_tinggal">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4 tinggal">
                                <label>Kecamatan</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kec-tinggal" class="form-control select2-kec">
                                    </select>
                                    <input type="hidden" name="kec_tinggal">
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4 tinggal">
                                <label>Kelurahan / Desa</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kel-tinggal" class="form-control select2-kel">
                                    </select>
                                    <input type="hidden" name="kel_tinggal">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-12 col-md-12 col-sm-12 mb-4 tinggal">
                                <label>Alamat Jalan</label>
                                <textarea class="form-control mb-2" rows="2" placeholder="Masukan Alamat"
                                          name="alamat_tinggal"></textarea>
                                <p style="font-size: 90%">Tidak perlu menyertakan Provinsi, Kota/Kab, Kecamatan,
                                    Kelurahan/Desa</p>
                            </div>
                            <div class="w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Tambah Data</button>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-script'); ?>
<script src="<?php echo e(asset('assets/plugins/jquery-mask-input/jquery.mask.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/jquery-mask-input/jquery.inputmask.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
<script>
$(document).ready(function () {
    $(".select2-rt, .select2-rw").select2({
        theme: "bootstrap",
        placeholder: "Pilih",
    });

    $('#alamat-sama').change(function () {
        if ($(this).is(":checked")) {
            $('.tinggal').addClass('d-none');
        } else {
            $('.tinggal').removeClass('d-none');
        }
    });

    /**
     * Get Data Daerah Indonesia
     */
    let alamatKtp = {
        idProvinsi: '',
        idKota: '',
        idKec: '',
        idKel: '',
        alamat: '',
    };

    // Load provinsi
    $.get('/get-provinsi', function(data) {
        $('#provinsi-ktp').empty();
        data.forEach(function(item) {
            $('#provinsi-ktp').append('<option value="' + item.id + '">' + item.nama + '</option>');
        });
    });

    $('#provinsi-ktp').change(function () {
        let provinsiId = $(this).val();
        $('input[name="prov_ktp"]').val($(this).find(":selected").text());
        // Load kota
        $.get('/get-kota/' + provinsiId, function(data) {
            $('#kota-ktp').empty();
            data.forEach(function(item) {
                $('#kota-ktp').append('<option value="' + item.id + '">' + item.nama + '</option>');
            });
        });
    });

    $('#kota-ktp').change(function () {
        let kotaId = $(this).val();
        $('input[name="kota_ktp"]').val($(this).find(":selected").text());
        // Load kecamatan
        $.get('/get-kecamatan/' + kotaId, function(data) {
            $('#kec-ktp').empty();
            data.forEach(function(item) {
                $('#kec-ktp').append('<option value="' + item.id + '">' + item.nama + '</option>');
            });
        });
    });

    $('#kec-ktp').change(function () {
        let kecamatanId = $(this).val();
        $('input[name="kec_ktp"]').val($(this).find(":selected").text());
        // Load kelurahan
        $.get('/get-kelurahan/' + kecamatanId, function(data) {
            $('#kel-ktp').empty();
            data.forEach(function(item) {
                $('#kel-ktp').append('<option value="' + item.id + '">' + item.nama + '</option>');
            });
        });
    });

    $('#kel-ktp').change(function () {
        $('input[name="kel_ktp"]').val($(this).find(":selected").text());
    });

    // Process for Alamat Tinggal
    let alamatTinggal = {
        idProvinsi: '',
        idKota: '',
        idKec: '',
        idKel: '',
        alamat: '',
    };

    // Load provinsi tinggal
    $.get('/get-provinsi', function(data) {
        $('#provinsi-tinggal').empty();
        data.forEach(function(item) {
            $('#provinsi-tinggal').append('<option value="' + item.id + '">' + item.nama + '</option>');
        });
    });

    $('#provinsi-tinggal').change(function () {
        alamatTinggal.idProvinsi = $(this).find(":selected").val();
        $('input[name="prov_tinggal"]').val($(this).find(":selected").text());
        // Load kota tinggal
        $.get('/get-kota/' + alamatTinggal.idProvinsi, function(data) {
            $('#kota-tinggal').empty();
            data.forEach(function(item) {
                $('#kota-tinggal').append('<option value="' + item.id + '">' + item.nama + '</option>');
            });
        });
    });

    $('#kota-tinggal').change(function () {
        alamatTinggal.idKota = $(this).find(":selected").val();
        $('input[name="kota_tinggal"]').val($(this).find(":selected").text());
        // Load kecamatan tinggal
        $.get('/get-kecamatan/' + alamatTinggal.idKota, function(data) {
            $('#kec-tinggal').empty();
            data.forEach(function(item) {
                $('#kec-tinggal').append('<option value="' + item.id + '">' + item.nama + '</option>');
            });
        });
    });

    $('#kec-tinggal').change(function () {
        alamatTinggal.idKec = $(this).find(":selected").val();
        $('input[name="kec_tinggal"]').val($(this).find(":selected").text());
        // Load kelurahan tinggal
        $.get('/get-kelurahan/' + alamatTinggal.idKec, function(data) {
            $('#kel-tinggal').empty();
            data.forEach(function(item) {
                $('#kel-tinggal').append('<option value="' + item.id + '">' + item.nama + '</option>');
            });
        });
    });

    $('#kel-tinggal').change(function () {
        $('input[name="kel_tinggal"]').val($(this).find(":selected").text());
    });

    // Inputmask untuk NIK dan No KK
    $('#inputNIK').inputmask({
        mask: '999999-999999-9999',
    });

    $('#inputNoKK').inputmask({
        mask: '999999-999999-9999',
    });

});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rt/penduduk/create.blade.php ENDPATH**/ ?>