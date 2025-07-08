@extends('layouts.default')
@push('page-title')
    RT - Penduduk
@endpush
@push('custom-style')
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2-boostrap.min.css')}}">
@endpush
@section('content')
    <div class="breadcrumb-wrapper">
        <h1 class="mb-2">Edit Data Penduduk</h1>
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
                <li class="breadcrumb-item" aria-current="page">Edit Data Penduduk</li>
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
    <form id="form" method="POST" action="{{ route('rt.penduduk.update', $data->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="card card-default">
                    <div class="card-header-border-bottom card-header d-flex justify-content-between">
                        <h2>Edit Data Warga</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-row col-lg-12 col-md-12 col-sm-12 mb-4">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama"
                                       placeholder="Masukan Nama Lengkap" required value="{{ old('nama', $data->nama) }}">
                            </div>
                              <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>NIK (Nomor Induk Penduduk)</label>
                                <input type="text" class="form-control" name="nik" id="inputNIK"
                                       placeholder="Masukan NIK" required minlength="16" maxlength="16" value="{{ old('nik', $data->nik) }}">
                                <div class="valid-feedback">
                                    Bagus! NIK tersedia
                                </div>
                                <div class="invalid-feedback">
                                    Maaf, sudah ada warga dengan NIK sama
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>No. KK</label>
                                <input type="text" class="form-control" name="no_kk" id="inputNoKK"
                                       placeholder="Masukan Nomor KK" required minlength="16" maxlength="16" value="{{ old('no_kk', $data->no_kk) }}">
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>RT</label>
                                <select id="select-rt" class="form-control select2-rt" name="no_rt" required>
                                    <option value="">Pilih RT</option>
                                    @foreach($rts as $rt)
                                        <option value="{{ $rt->id }}" {{ (old('no_rt', $data->no_rt) == $rt->id || old('no_rt', $data->no_rt) == $rt->nama_bagian) ? 'selected' : '' }}>
                                            {{ $rt->nama_bagian }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>RW</label>
                                <select id="select-rw" class="form-control select2-rw" name="no_rw" required>
                                    <option value="">Pilih RW</option>
                                    @foreach($rws as $rw)
                                        <option value="{{ $rw->id }}" {{ (old('no_rw', $data->no_rw) == $rw->id || old('no_rw', $data->no_rw) == $rw->nama_bagian) ? 'selected' : '' }}>
                                            {{ $rw->nama_bagian }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-4 col-md-4 col-sm-12 mb-4">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" id="inputTglLahir"
                                       placeholder="Masukan Tanggal Lahir" required value="{{ old('tgl_lahir', $data->tgl_lahir) }}">
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Jenis Kelamin</label>
                                <div class="w-100 mb-2"></div>
                                <ul class="list-unstyled list-inline">
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Laki Laki
                                            <input type="radio" name="jkel" value="L" {{ old('jkel', $data->jkel) == 'L' ? 'checked' : '' }}/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Perempuan
                                            <input type="radio" name="jkel" value="P" {{ old('jkel', $data->jkel) == 'P' ? 'checked' : '' }}/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Status Kawin</label>
                                <div class="w-100 mb-2"></div>
                                <ul class="list-unstyled list-inline">
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Belum
                                            <input type="radio" name="status_kawin" value="Belum" {{ old('status_kawin', $data->status_kawin) == 'Belum' ? 'checked' : '' }}/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Sudah
                                            <input type="radio" name="status_kawin" value="Sudah" {{ old('status_kawin', $data->status_kawin) == 'Sudah' ? 'checked' : '' }}/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                </ul>
                            </div> 
                            <div class="w-100"></div>
                            <div class="form-row col-lg-4 col-md-6 col-sm-12 mb-4">
                                <label>Agama</label>
                                <select class="form-control" name="agama">
                                    <option value="" disabled selected>Pilih Agama</option>
                                    <option value="Islam" {{ old('agama', $data->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $data->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $data->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $data->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $data->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Pendidikan</label>
                                <select class="form-control" name="pendidikan">
                                    <option value="" disabled selected>Pilih Pendidikan</option>
                                    <option value="SD" {{ old('pendidikan', $data->pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('pendidikan', $data->pendidikan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('pendidikan', $data->pendidikan) == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="Diploma 1" {{ old('pendidikan', $data->pendidikan) == 'Diploma 1' ? 'selected' : '' }}>Diploma 1</option>
                                    <option value="Diploma 2" {{ old('pendidikan', $data->pendidikan) == 'Diploma 2' ? 'selected' : '' }}>Diploma 2</option>
                                    <option value="Diploma 3" {{ old('pendidikan', $data->pendidikan) == 'Diploma 3' ? 'selected' : '' }}>Diploma 3</option>
                                    <option value="Diploma 4" {{ old('pendidikan', $data->pendidikan) == 'Diploma 4' ? 'selected' : '' }}>Diploma 4</option>
                                    <option value="Strata 1" {{ old('pendidikan', $data->pendidikan) == 'Strata 1' ? 'selected' : '' }}>Strata 1</option>
                                    <option value="Strata 2" {{ old('pendidikan', $data->pendidikan) == 'Strata 2' ? 'selected' : '' }}>Strata 2</option>
                                    <option value="Strata 3" {{ old('pendidikan', $data->pendidikan) == 'Strata 3' ? 'selected' : '' }}>Strata 3</option>
                                    <option value="Strata 4" {{ old('pendidikan', $data->pendidikan) == 'Strata 4' ? 'selected' : '' }}>Strata 4</option>
                                    <option value="Lainnya" {{ old('pendidikan', $data->pendidikan) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Pekerjaan</label>
                                <input class="form-control" name="pekerjaan" required placeholder="Masukan Pekerjaan" value="{{ old('pekerjaan', $data->pekerjaan) }}">
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kewarganegaraan</label>
                                <div class="w-100 mb-2"></div>
                                <ul class="list-unstyled list-inline">
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">WNI
                                            <input type="radio" name="kewarganegaraan" value="WNI" {{ old('kewarganegaraan', $data->kewarganegaraan) == 'WNI' ? 'checked' : '' }}/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">WNA
                                            <input type="radio" name="kewarganegaraan" value="WNA" {{ old('kewarganegaraan', $data->kewarganegaraan) == 'WNA' ? 'checked' : '' }}/>
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
                                            <input type="radio" name="kedudukan_keluarga" value="Kepala" {{ old('kedudukan_keluarga', $data->kedudukan_keluarga) == 'Kepala' ? 'checked' : '' }}/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Anggota Keluarga
                                            <input type="radio" name="kedudukan_keluarga" value="Anggota" {{ old('kedudukan_keluarga', $data->kedudukan_keluarga) == 'Anggota' ? 'checked' : '' }}/>
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
                                            <option value="{{ $prov->id }}" {{ old('prov_ktp', $data->prov_ktp_id ?? '') == $prov->id ? 'selected' : '' }}>{{ $prov->nama }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="prov_ktp_nama" value="{{ old('prov_ktp_nama', $data->prov_ktp) }}">
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kota / Kabupaten</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kota-ktp" class="form-control select2-kot" name="kota_ktp" required>
                                        <option value="">Pilih Kota/Kabupaten</option>
                                        {{-- Options will be loaded by JS --}}
                                    </select>
                                    <input type="hidden" name="kota_ktp_nama" value="{{ old('kota_ktp_nama', $data->kota_ktp) }}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kecamatan</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kec-ktp" class="form-control select2-kec" name="kec_ktp" required>
                                        <option value="">Pilih Kecamatan</option>
                                        {{-- Options will be loaded by JS --}}
                                    </select>
                                    <input type="hidden" name="kec_ktp_nama" value="{{ old('kec_ktp_nama', $data->kec_ktp) }}">
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kelurahan / Desa</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kel-ktp" class="form-control select2-kel" name="kel_ktp" required>
                                        <option value="">Pilih Kelurahan/Desa</option>
                                        {{-- Options will be loaded by JS --}}
                                    </select>
                                    <input type="hidden" name="kel_ktp_nama" value="{{ old('kel_ktp_nama', $data->kel_ktp) }}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-12 col-md-12 col-sm-12 mb-4">
                                <label>Alamat Jalan</label>
                                <textarea class="form-control mb-2" rows="2" placeholder="Masukan Alamat"
                                          name="alamat_ktp">{{ old('alamat_ktp', $data->alamat_ktp) }}</textarea>
                                <p style="font-size: 90%">Tidak perlu menyertakan Provinsi, Kota/Kab, Kecamatan,
                                    Kelurahan/Desa</p>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-12">
                                <label class="control outlined control-checkbox checkbox-primary">Apakah alamat KTP sama
                                    dengan alamat tinggal ?
                                    <input id="alamat-sama" name="alamat_sama" type="checkbox" {{ old('alamat_sama', $data->alamat_sama ?? false) ? 'checked' : '' }}/>
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
                                    <select id="provinsi-tinggal" class="form-control select2-prov" name="prov_tinggal" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsi as $prov)
                                            <option value="{{ $prov->id }}" {{ old('prov_tinggal', $data->prov_tinggal_id ?? '') == $prov->id ? 'selected' : '' }}>{{ $prov->nama }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="prov_tinggal_nama" value="{{ old('prov_tinggal_nama', $data->prov_tinggal) }}">
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4 tinggal">
                                <label>Kota / Kabupaten</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kota-tinggal" class="form-control select2-kot" name="kota_tinggal" required>
                                        <option value="">Pilih Kota/Kabupaten</option>
                                        {{-- Options will be loaded by JS --}}
                                    </select>
                                    <input type="hidden" name="kota_tinggal_nama" value="{{ old('kota_tinggal_nama', $data->kota_tinggal) }}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4 tinggal">
                                <label>Kecamatan</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kec-tinggal" class="form-control select2-kec" name="kec_tinggal" required>
                                        <option value="">Pilih Kecamatan</option>
                                        {{-- Options will be loaded by JS --}}
                                    </select>
                                    <input type="hidden" name="kec_tinggal_nama" value="{{ old('kec_tinggal_nama', $data->kec_tinggal) }}">
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4 tinggal">
                                <label>Kelurahan / Desa</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kel-tinggal" class="form-control select2-kel" name="kel_tinggal" required>
                                        <option value="">Pilih Kelurahan/Desa</option>
                                        {{-- Options will be loaded by JS --}}
                                    </select>
                                    <input type="hidden" name="kel_tinggal_nama" value="{{ old('kel_tinggal_nama', $data->kel_tinggal) }}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-12 col-md-12 col-sm-12 mb-4 tinggal">
                                <label>Alamat Jalan</label>
                                <textarea class="form-control mb-2" rows="2" placeholder="Masukan Alamat"
                                          name="alamat_tinggal">{{ old('alamat_tinggal', $data->alamat_tinggal) }}</textarea>
                                <p style="font-size: 90%">Tidak perlu menyertakan Provinsi, Kota/Kab, Kecamatan,
                                    Kelurahan/Desa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Edit Data</button>
    </form>
@endsection
@push('custom-script')
<script src="{{asset('assets/plugins/jquery-mask-input/jquery.mask.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-mask-input/jquery.inputmask.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script>
$(document).ready(function () {
    $(".select2-rt, .select2-rw, .select2-prov, .select2-kot, .select2-kec, .select2-kel").select2({
        theme: "bootstrap",
        placeholder: "Pilih",
    });

    function toggleTinggalRequired(isRequired) {
        $('#provinsi-tinggal').prop('required', isRequired);
        $('#kota-tinggal').prop('required', isRequired);
        $('#kec-tinggal').prop('required', isRequired);
        $('#kel-tinggal').prop('required', isRequired);
        $('textarea[name="alamat_tinggal"]').prop('required', isRequired);
    }

    // Inisialisasi: jika checked, hilangkan required
    if ($('#alamat-sama').is(':checked')) {
        $('.tinggal').addClass('d-none');
        toggleTinggalRequired(false);
    } else {
        $('.tinggal').removeClass('d-none');
        toggleTinggalRequired(true);
    }

    $('#alamat-sama').change(function () {
        if ($(this).is(":checked")) {
            $('.tinggal').addClass('d-none');
            toggleTinggalRequired(false);
        } else {
            $('.tinggal').removeClass('d-none');
            toggleTinggalRequired(true);
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
        $('input[name="prov_ktp_nama"]').val($(this).find(":selected").text());
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
            });
        }
    });

    $('#kota-ktp').change(function () {
        let kotaId = $(this).val();
        $('input[name="kota_ktp_nama"]').val($(this).find(":selected").text());
        $('#kec-ktp').empty().append('<option value="">Pilih Kecamatan</option>');
        $('#kel-ktp').empty().append('<option value="">Pilih Kelurahan/Desa</option>');
        if(kotaId) {
            $.get('/get-kecamatan/' + kotaId, function(data) {
                let html = '<option value="">Pilih Kecamatan</option>';
                data.forEach(function(item) {
                    html += '<option value="' + item.id + '">' + item.nama + '</option>';
                });
                $('#kec-ktp').html(html);
            });
        }
    });

    $('#kec-ktp').change(function () {
        let kecamatanId = $(this).val();
        $('input[name="kec_ktp_nama"]').val($(this).find(":selected").text());
        $('#kel-ktp').empty().append('<option value="">Pilih Kelurahan/Desa</option>');
        if(kecamatanId) {
            $.get('/get-kelurahan/' + kecamatanId, function(data) {
                let html = '<option value="">Pilih Kelurahan/Desa</option>';
                data.forEach(function(item) {
                    html += '<option value="' + item.id + '">' + item.nama + '</option>';
                });
                $('#kel-ktp').html(html);
            });
        }
    });

    $('#kel-ktp').change(function () {
        $('input[name="kel_ktp_nama"]').val($(this).find(":selected").text());
    });

    // --- Alamat Tinggal ---
    let provTinggalId = "{{ old('prov_tinggal', $data->prov_tinggal_id ?? '') }}";
    let kotaTinggalId = "{{ old('kota_tinggal', $data->kota_tinggal_id ?? '') }}";
    let kecTinggalId = "{{ old('kec_tinggal', $data->kec_tinggal_id ?? '') }}";
    let kelTinggalId = "{{ old('kel_tinggal', $data->kel_tinggal_id ?? '') }}";

    if (provTinggalId) {
        $.get('/get-kota/' + provTinggalId, function(data) {
            let html = '<option value="">Pilih Kota/Kabupaten</option>';
            data.forEach(function(item) {
                html += '<option value="' + item.id + '" ' + (item.id == kotaTinggalId ? 'selected' : '') + '>' + item.nama + '</option>';
            });
            $('#kota-tinggal').html(html);
            if (kotaTinggalId) {
                $.get('/get-kecamatan/' + kotaTinggalId, function(data) {
                    let html = '<option value="">Pilih Kecamatan</option>';
                    data.forEach(function(item) {
                        html += '<option value="' + item.id + '" ' + (item.id == kecTinggalId ? 'selected' : '') + '>' + item.nama + '</option>';
                    });
                    $('#kec-tinggal').html(html);
                    if (kecTinggalId) {
                        $.get('/get-kelurahan/' + kecTinggalId, function(data) {
                            let html = '<option value="">Pilih Kelurahan/Desa</option>';
                            data.forEach(function(item) {
                                html += '<option value="' + item.id + '" ' + (item.id == kelTinggalId ? 'selected' : '') + '>' + item.nama + '</option>';
                            });
                            $('#kel-tinggal').html(html);
                        });
                    }
                });
            }
        });
    }

    $('#provinsi-tinggal').change(function () {
        let provinsiId = $(this).val();
        $('input[name="prov_tinggal_nama"]').val($(this).find(":selected").text());
        $('#kota-tinggal').empty().append('<option value="">Pilih Kota/Kabupaten</option>');
        $('#kec-tinggal').empty().append('<option value="">Pilih Kecamatan</option>');
        $('#kel-tinggal').empty().append('<option value="">Pilih Kelurahan/Desa</option>');
        if(provinsiId) {
            $.get('/get-kota/' + provinsiId, function(data) {
                let html = '<option value="">Pilih Kota/Kabupaten</option>';
                data.forEach(function(item) {
                    html += '<option value="' + item.id + '">' + item.nama + '</option>';
                });
                $('#kota-tinggal').html(html);
            });
        }
    });

    $('#kota-tinggal').change(function () {
        let kotaId = $(this).val();
        $('input[name="kota_tinggal_nama"]').val($(this).find(":selected").text());
        $('#kec-tinggal').empty().append('<option value="">Pilih Kecamatan</option>');
        $('#kel-tinggal').empty().append('<option value="">Pilih Kelurahan/Desa</option>');
        if(kotaId) {
            $.get('/get-kecamatan/' + kotaId, function(data) {
                let html = '<option value="">Pilih Kecamatan</option>';
                data.forEach(function(item) {
                    html += '<option value="' + item.id + '">' + item.nama + '</option>';
                });
                $('#kec-tinggal').html(html);
            });
        }
    });

    $('#kec-tinggal').change(function () {
        let kecamatanId = $(this).val();
        $('input[name="kec_tinggal_nama"]').val($(this).find(":selected").text());
        $('#kel-tinggal').empty().append('<option value="">Pilih Kelurahan/Desa</option>');
        if(kecamatanId) {
            $.get('/get-kelurahan/' + kecamatanId, function(data) {
                let html = '<option value="">Pilih Kelurahan/Desa</option>';
                data.forEach(function(item) {
                    html += '<option value="' + item.id + '">' + item.nama + '</option>';
                });
                $('#kel-tinggal').html(html);
            });
        }
    });

    $('#kel-tinggal').change(function () {
        $('input[name="kel_tinggal_nama"]').val($(this).find(":selected").text());
    });

    // Inputmask untuk NIK dan No KK
    $('#inputNIK').inputmask({
        mask: '999999-999999-9999',
    });

    $('#inputNoKK').inputmask({
        mask: '999999-999999-9999',
    });

    // --- Alamat KTP ---
    let provKtpId = "{{ old('prov_ktp', $data->prov_ktp_id ?? '') }}";
    let kotaKtpId = "{{ old('kota_ktp', $data->kota_ktp_id ?? '') }}";
    let kecKtpId = "{{ old('kec_ktp', $data->kec_ktp_id ?? '') }}";
    let kelKtpId = "{{ old('kel_ktp', $data->kel_ktp_id ?? '') }}";

    if (provKtpId) {
        $.get('/get-kota/' + provKtpId, function(data) {
            let html = '<option value="">Pilih Kota/Kabupaten</option>';
            data.forEach(function(item) {
                html += '<option value="' + item.id + '" ' + (item.id == kotaKtpId ? 'selected' : '') + '>' + item.nama + '</option>';
            });
            $('#kota-ktp').html(html);
            if (kotaKtpId) {
                $.get('/get-kecamatan/' + kotaKtpId, function(data) {
                    let html = '<option value="">Pilih Kecamatan</option>';
                    data.forEach(function(item) {
                        html += '<option value="' + item.id + '" ' + (item.id == kecKtpId ? 'selected' : '') + '>' + item.nama + '</option>';
                    });
                    $('#kec-ktp').html(html);
                    if (kecKtpId) {
                        $.get('/get-kelurahan/' + kecKtpId, function(data) {
                            let html = '<option value="">Pilih Kelurahan/Desa</option>';
                            data.forEach(function(item) {
                                html += '<option value="' + item.id + '" ' + (item.id == kelKtpId ? 'selected' : '') + '>' + item.nama + '</option>';
                            });
                            $('#kel-ktp').html(html);
                        });
                    }
                });
            }
        });
    }

    // Saat submit form, jika checkbox "alamat sama" dicentang,
    // set semua field alamat_tinggal = field alamat_ktp sebelum submit
    $('#form').on('submit', function(e) {
        if ($('#alamat-sama').is(':checked')) {
            // Copy value dari KTP ke Tinggal
            $('select[name="prov_tinggal"]').val($('select[name="prov_ktp"]').val());
            $('select[name="kota_tinggal"]').val($('select[name="kota_ktp"]').val());
            $('select[name="kec_tinggal"]').val($('select[name="kec_ktp"]').val());
            $('select[name="kel_tinggal"]').val($('select[name="kel_ktp"]').val());
            $('input[name="prov_tinggal_nama"]').val($('input[name="prov_ktp_nama"]').val());
            $('input[name="kota_tinggal_nama"]').val($('input[name="kota_ktp_nama"]').val());
            $('input[name="kec_tinggal_nama"]').val($('input[name="kec_ktp_nama"]').val());
            $('input[name="kel_tinggal_nama"]').val($('input[name="kel_ktp_nama"]').val());
            $('textarea[name="alamat_tinggal"]').val($('textarea[name="alamat_ktp"]').val());
        }
    });

});
</script>
@endpush