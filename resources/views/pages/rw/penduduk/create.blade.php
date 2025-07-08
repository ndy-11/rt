@extends('layouts.default')
@push('page-title')
    RW - Penduduk
@endpush
@push('custom-style')
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2-boostrap.min.css')}}">
@endpush
@section('content')
    <div class="breadcrumb-wrapper">
        <h1 class="mb-2">Tambah Penduduk</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="/rw/penduduk">
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
    @if($errors->any())
        <div class="alert alert-dismissible fade show alert-danger" role="alert">
            {{ implode('', $errors->all(':message')) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form id="form" method="POST" action="{{route('rw.penduduk.store')}}">
        @csrf
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
                                       placeholder="Masukan Nama Lengkap" required value="{{old('nama')}}">
                            </div>
                         <!--   <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>NIK (Nomor Induk Penduduk)</label>
                                <input type="text" class="form-control" name="nik" id="inputNIK"
                                       placeholder="Masukan NIK" required minlength="16" maxlength="16" value="{{old('nik')}}">
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
                                       placeholder="Masukan Nomor KK" required minlength="16" maxlength="16" value="{{old('no_kk')}}">
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                </div>
                            </div> -->
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>RT</label>
                                <select id="select-rt" class="form-control select2-rt" name="no_rt" required>
                                    <option value="">Pilih RT</option>
                                    @foreach($rts as $rt)
                                        <option value="{{ $rt->id }}">{{ $rt->nama_bagian }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>RW</label>
                                <select id="select-rw" class="form-control select2-rw" name="no_rw" required>
                                    <option value="">Pilih RW</option>
                                    @foreach($rws as $rw)
                                        <option value="{{ $rw->id }}">{{ $rw->nama_bagian }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-4 col-md-4 col-sm-12 mb-4">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" id="inputTglLahir"
                                       placeholder="Masukan Tanggal Lahir" required value="{{old('tgl_lahir')}}">
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
                            <div class="w-100 mb-4">
                                <hr class="my-4">
                                <h5 class="">Alamat KTP</h5>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Provinsi</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="provinsi-ktp" class="form-control select2-prov" name="prov_ktp" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsi as $prov)
                                            <option value="{{ $prov->id }}">{{ $prov->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kota / Kabupaten</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kota-ktp" class="form-control select2-kot" name="kota_ktp" required>
                                        <option value="">Pilih Kota/Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kecamatan</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kec-ktp" class="form-control select2-kec" name="kec_ktp" required>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kelurahan / Desa</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kel-ktp" class="form-control select2-kel" name="kel_ktp" required>
                                        <option value="">Pilih Kelurahan/Desa</option>
                                    </select>
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
@endsection
@push('custom-script')
<script src="{{asset('assets/plugins/jquery-mask-input/jquery.mask.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-mask-input/jquery.inputmask.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
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
    $('#provinsi-ktp').val('');
    $('#kota-ktp').empty().append('<option value="">Pilih Kota/Kabupaten</option>');
    $('#kec-ktp').empty().append('<option value="">Pilih Kecamatan</option>');
    $('#kel-ktp').empty().append('<option value="">Pilih Kelurahan/Desa</option>');

    $('#provinsi-ktp').change(function () {
        let provinsiId = $(this).val();
        $('#kota-ktp').empty().append('<option value="">Pilih Kota/Kabupaten</option>');
        $('#kec-ktp').empty().append('<option value="">Pilih Kecamatan</option>');
        $('#kel-ktp').empty().append('<option value="">Pilih Kelurahan/Desa</option>');
        if(provinsiId) {
            $.get('/get-kota/' + provinsiId, function(data) {
                let html = '<option value="">Pilih Kota/Kabupaten</option>';
                data.forEach(function(item) {
                    html += '<option value="' + item.id + '">' + item.nama + '</option>';
                });
                $('#kota-ktp').html(html);
            }).fail(function(xhr) {
                alert('Gagal load kota: ' + xhr.responseText);
            });
        }
    });

    $('#kota-ktp').change(function () {
        let kotaId = $(this).val();
        $('#kec-ktp').empty().append('<option value="">Pilih Kecamatan</option>');
        $('#kel-ktp').empty().append('<option value="">Pilih Kelurahan/Desa</option>');
        if(kotaId) {
            $.get('/get-kecamatan/' + kotaId, function(data) {
                let html = '<option value="">Pilih Kecamatan</option>';
                data.forEach(function(item) {
                    html += '<option value="' + item.id + '">' + item.nama + '</option>';
                });
                $('#kec-ktp').html(html);
            }).fail(function(xhr) {
                alert('Gagal load kecamatan: ' + xhr.responseText);
            });
        }
    });

    $('#kec-ktp').change(function () {
        let kecamatanId = $(this).val();
        $('#kel-ktp').empty().append('<option value="">Pilih Kelurahan/Desa</option>');
        if(kecamatanId) {
            $.get('/get-kelurahan/' + kecamatanId, function(data) {
                let html = '<option value="">Pilih Kelurahan/Desa</option>';
                data.forEach(function(item) {
                    html += '<option value="' + item.id + '">' + item.nama + '</option>';
                });
                $('#kel-ktp').html(html);
            }).fail(function(xhr) {
                alert('Gagal load kelurahan: ' + xhr.responseText);
            });
        }
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
@endpush