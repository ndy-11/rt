@extends('layouts.default')
@push('page-title')
    RW - Bagian - Create
@endpush
@push('custom-style')
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2-boostrap.min.css')}}">
@endpush
@section('content')
    <div class="breadcrumb-wrapper">
        <h1 class="mb-2">Tambah Bagian RT</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="/rw/bagian">
                        <span class="mdi mdi-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    Data Bagian RT
                </li>
                <li class="breadcrumb-item" aria-current="page">Tambah Bagian RT</li>
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
    <form id="form" method="POST" action="{{route('rw.bagian.store')}}">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-default">
                    <div class="card-header-border-bottom card-header d-flex justify-content-between">
                        <h2>Identitas RT</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <label>Nama RT</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">RT </span>
                                </div>
                                <input type="text" name="nama_rt" class="form-control" placeholder="Masukan Nama RT"
                                       id="inputGroupRT" required value="{{old('nama_rt')}}">
                            </div>
                            <p style="font-size: 90%">contoh. 001</p>
                            <div class="valid-feedback">
                                Bagus! nama RT belum pernah dibuat
                            </div>
                            <div class="invalid-feedback">
                                Maaf, nama RT sudah pernah dibuat
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="card card-default">
                    <div class="card-header-border-bottom card-header d-flex justify-content-between">
                        <h2>Input Data Ketua / Pengurus RT</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama"
                                       placeholder="Masukan Nama Lengkap" required value="{{old('nama')}}">
                            </div>
                            <div class="w-100"></div>
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
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>No. KK</label>
                                <input type="text" class="form-control" name="no_kk" id="inputNoKK"
                                       placeholder="Masukan Nomor KK" required minlength="16" maxlength="16" value="{{old('no_kk')}}">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
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
                                            <input type="radio" name="jkel" value="L" {{ old('jkel', 'L') == 'L' ? 'checked' : '' }}/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Perempuan
                                            <input type="radio" name="jkel" value="P" {{ old('jkel') == 'P' ? 'checked' : '' }}/>
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
                                            <input type="radio" name="status_kawin" value="Belum" {{ old('status_kawin', 'Belum') == 'Belum' ? 'checked' : '' }}/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Sudah
                                            <input type="radio" name="status_kawin" value="Sudah" {{ old('status_kawin') == 'Sudah' ? 'checked' : '' }}/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-4 col-md-6 col-sm-12 mb-4">
                                <label>Agama</label>
                                <select class="form-control" name="agama">
                                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Pendidikan</label>
                                <select class="form-control" name="pendidikan">
                                    <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="Diploma 1" {{ old('pendidikan') == 'Diploma 1' ? 'selected' : '' }}>Diploma 1</option>
                                    <option value="Diploma 2" {{ old('pendidikan') == 'Diploma 2' ? 'selected' : '' }}>Diploma 2</option>
                                    <option value="Diploma 3" {{ old('pendidikan') == 'Diploma 3' ? 'selected' : '' }}>Diploma 3</option>
                                    <option value="Diploma 4" {{ old('pendidikan') == 'Diploma 4' ? 'selected' : '' }}>Diploma 4</option>
                                    <option value="Strata 1" {{ old('pendidikan') == 'Strata 1' ? 'selected' : '' }}>Strata 1</option>
                                    <option value="Strata 2" {{ old('pendidikan') == 'Strata 2' ? 'selected' : '' }}>Strata 2</option>
                                    <option value="Strata 3" {{ old('pendidikan') == 'Strata 3' ? 'selected' : '' }}>Strata 3</option>
                                    <option value="Strata 4" {{ old('pendidikan') == 'Strata 4' ? 'selected' : '' }}>Strata 4</option>
                                    <option value="Lainnya" {{ old('pendidikan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Pekerjaan</label>
                                <input class="form-control" name="pekerjaan" required placeholder="Masukan Pekerjaan" value="{{ old('pekerjaan') }}">
                            </div>
                            <div class="w-100"></div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4">
                                <label>Kewarganegaraan</label>
                                <div class="w-100 mb-2"></div>
                                <ul class="list-unstyled list-inline">
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">WNI
                                            <input type="radio" name="kewarganegaraan" value="WNI" {{ old('kewarganegaraan', 'WNI') == 'WNI' ? 'checked' : '' }}/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">WNA
                                            <input type="radio" name="kewarganegaraan" value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'checked' : '' }}/>
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
                                            <input type="radio" name="kedudukan_keluarga" value="Kepala" {{ old('kedudukan_keluarga', 'Kepala') == 'Kepala' ? 'checked' : '' }}/>
                                            <div class="control-indicator"></div>
                                        </label>
                                    </li>
                                    <li class="d-inline-block mr-3">
                                        <label class="control control-radio">Anggota Keluarga
                                            <input type="radio" name="kedudukan_keluarga" value="Anggota" {{ old('kedudukan_keluarga') == 'Anggota' ? 'checked' : '' }}/>
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
                                        {{-- Data akan diisi oleh JS --}}
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
                                    <select id="provinsi-tinggal" class="form-control select2-prov" name="prov_tinggal">
                                        <option value="">Pilih Provinsi</option>
                                        {{-- Data akan diisi oleh JS --}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4 tinggal">
                                <label>Kota / Kabupaten</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kota-tinggal" class="form-control select2-kot" name="kota_tinggal">
                                        <option value="">Pilih Kota/Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4 tinggal">
                                <label>Kecamatan</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kec-tinggal" class="form-control select2-kec" name="kec_tinggal">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row col-lg-6 col-md-6 col-sm-12 mb-4 tinggal">
                                <label>Kelurahan / Desa</label>
                                <div class="w-100"></div>
                                <div class="select2-wrapper w-100">
                                    <select id="kel-tinggal" class="form-control select2-kel" name="kel_tinggal">
                                        <option value="">Pilih Kelurahan/Desa</option>
                                    </select>
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
            $('#inputGroupRT').inputmask({
                mask: '999',
                placeholder: '000',
            });

            $('#inputNIK').inputmask({
                mask: '999999-999999-9999',
            });

            $('#inputNoKK').inputmask({
                mask: '999999-999999-9999',
            });

            $(".select2-prov").select2({
                theme: "bootstrap",
                placeholder: "Pilih Provinsi",
                maximumSelectionSize: 6,
            });

            $(".select2-kot").select2({
                theme: "bootstrap",
                placeholder: "Pilih Kota / Kab",
                maximumSelectionSize: 6,
            });

            $(".select2-kec").select2({
                theme: "bootstrap",
                placeholder: "Pilih Kecamatan",
                maximumSelectionSize: 6,
            });

            $(".select2-kel").select2({
                theme: "bootstrap",
                placeholder: "Pilih Kelurahan / Desa",
                maximumSelectionSize: 6,
            });

            // Saat load, nonaktifkan required pada field alamat tinggal jika hidden
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

            $.get('/get-provinsi', function(data) {
                $('#provinsi-ktp').empty().append('<option value="">Pilih Provinsi</option>');
                data.forEach(function(item) {
                    $('#provinsi-ktp').append('<option value="' + item.id + '">' + item.nama + '</option>');
                });
            });

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
                    });
                }
            });


            let alamatTinggal = {
                idProvinsi: '',
                idKota: '',
                idKec: '',
                idKel: '',
                alamat: '',
            };

            $.get('/get-provinsi', function(data) {
                $('#provinsi-tinggal').empty().append('<option value="">Pilih Provinsi</option>');
                data.forEach(function(item) {
                    $('#provinsi-tinggal').append('<option value="' + item.id + '">' + item.nama + '</option>');
                });
            });

            $('#provinsi-tinggal').change(function () {
                let provinsiId = $(this).val();
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
        });


    </script>
@endpush
