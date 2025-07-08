@extends('layouts.default')
@push('page-title')
RW - Data Penduduk
@endpush
@push('custom-style')
<link href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/data-tables/responsive.datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2-boostrap.min.css')}}">
@endpush
@section('content')
<div class="breadcrumb-wrapper">
    <h1>Data Penduduk</h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-default ">
            <div class="card-header card-header-border-bottom">
                <h2>Filter RT</h2>
            </div>
            <div class="card-body">
            <form method="get" action="{{ route('rw.penduduk.index') }}">
                <div class="form-row mb-4">
                    <!-- Filter RT -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                        <label for="rts">Pilih RT</label>
                        <select class="form-control" id="rts" name="rts">
                            <option value="">Pilih RT</option>
                            @foreach($rtOptions as $rt)
                                <option value="{{ $rt }}" {{ request('rts') == $rt ? 'selected' : '' }}>{{ $rt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Filter RW -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                        <label for="rw">Pilih RW</label>
                        <select class="form-control" name="rw">
                            <option value="">Pilih RW</option>
                            @foreach($rwOptions ?? '' as $rw)
                                <option value="{{ $rw }}" {{ request('rw') == $rw ? 'selected' : '' }}>{{ $rw }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Filter Tanggal Mulai -->
                    <div class="col-lg-2 col-md-6 col-sm-12 mb-2">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
                    </div>
                    <!-- Filter Tanggal Selesai -->
                    <div class="col-lg-2 col-md-6 col-sm-12 mb-2">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
                    </div>
                    <!-- Button Cari & Reset -->
                    <div class="col-12 d-flex align-items-end mb-2 mt-2">
                        <button id="cari-penduduk" type="submit" class="btn btn-primary mr-2">Cari</button>
                        <a href="{{ route('rw.penduduk.index') }}" class="btn btn-secondary ml-2">Reset</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Summary</h2>
            </div>
            <div class="card-body">
                <div class="form-row mb-4">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Jumlah Warga</label>
                        <div class="w-100"></div>
                        <h3 class="text-dark">{{$jmlh_warga}} Orang</h3>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Jumlah Keluarga</label>
                        <div class="w-100"></div>
                        <h3 class="text-dark">{{$jmlh_kk}} Keluarga</h3>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Jumlah Penduduk Sementara</label>
                        <div class="w-100"></div>
                        <h3 class="text-dark">{{$jmlh_sementara}} Orang</h3>
                    </div>
                    <div class="w-100"></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <!-- Persebaran Penduduk -->
                            <div class="col-lg-8 col-md-10 col-sm-12 mb-4">
                                <div class="text-center">
                                    <label class="fw-bold mb-2">Persebaran Penduduk</label>
                                    <div style="position: relative; height: 480px; width:100%; max-width: 100%">
                                        <canvas id="persebaran-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <!-- Jenis Kelamin -->
                            <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
                                <div class="text-center">
                                    <label class="fw-bold mb-2">Jenis Kelamin</label>
                                    <div style="position: relative; height: 450px; width:100%; max-width: 100%">
                                        <canvas id="jkel-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- Spacer -->
                            <div class="col-lg-1 d-none d-lg-block"></div>
                            <!-- Chart Pekerjaan -->
                            <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
                                <div class="text-center">
                                    <label class="fw-bold mb-2">Pekerjaan</label>
                                    <div style="position: relative; height: 480px; width:100%; max-width: 100%">
                                        <canvas id="pekerjaan-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between mb-4">
                <h2>Data Warga</h2>
            </div>
            <div class="card-body">
                <div class="mb-2">
                <a href="{{ route('pages.rw.export.excel', ['start_date' => request('tanggal_mulai'),'end_date' => request('tanggal_selesai'),'rt' => request('rt'),'rw' => request('rw')]) }}"class="btn btn-outline-success btn-sm text-uppercase">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                    <a href="{{ route('pages.rw.export.pdf', ['start_date' => request('tanggal_mulai'),'end_date' => request('tanggal_selesai'),'rt' => request('rt'),'rw' => request('rw')]) }}"class="btn btn-outline-info btn-sm text-uppercase" target="_blank">
                        <i class="fas fa-print"></i> Print
                    </a>
                </div>
                <div class="responsive-data-table">
                    <table class="table dt-responsive nowrap data-table" style="width:100%; font-size: 1rem;">
                    <thead>
                        <tr>
                            <th style="font-size:1.1rem;">No</th>
                            <th style="font-size:1.1rem;">NIK</th>
                            <th style="font-size:1.1rem;">Nomor KK</th>
                            <th style="font-size:1.1rem;">Nama Lengkap</th>
                            <th style="font-size:1.1rem;">Jenis Kelamin</th>
                            <th style="font-size:1.1rem;">Alamat</th>
                            <th style="font-size:1.1rem;">Status</th>
                            <th style="font-size:1.1rem;">Aksi</th>
                        </tr>
                    </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($list_warga as $val)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$val['nik']}}</td>
                                <td>{{$val['no_kk']}}</td>
                                <td>{{$val['nama']}}</td>
                                <td>{{$val['jkel']}}</td>
                                <td>{{$val['alamat']}}</td>
                                <td>{{$val['status']}}</td>
                                <td>
                                    <a class="btn btn-sm text-white btn-primary" href="/rw/penduduk/{{$val['id']}}">Detail</a>   
                                </td>
                            </tr>
                            @php $no++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Mutasi Warga</h2>
            </div>
            <div class="card-body">
                <p class="mb-4">Pengelolaan untuk warga datang / pindah / meninggal</p>
                <a href="/rw/mutasi" class="btn btn-primary mb-4">
                    Lihat Data
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Penduduk Sementara</h2>
            </div>
            <div class="card-body">
                <p class="mb-4">Pengelolaan data penduduk pendatang, bertujuan untuk tinggal sementara tidak menetap</p>
                <a href="/rw/penduduk-sementara" class="btn btn-primary mb-4">
                    Lihat Data
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-script')
<script src="{{asset('assets/plugins/charts/Chart.min.js')}}"></script>
<script src="{{asset('assets/plugins/charts/chartjs-plugin-colorschemes.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{asset('assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/data-tables/datatables.responsive.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  $(document).ready(function() {
            // Hanya inisialisasi DataTable sekali saja, tanpa destroy
        if (!$.fn.DataTable.isDataTable('.data-table')) {
            $('.data-table').DataTable({
                "lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, 100] ],
                "pageLength": 10,
                 "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
                  });
        }
    // Color palette for charts
    const colorPalette = [
        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
        '#FF9F40', '#C9CBCF', '#F7464A', '#46BFBD', '#FDB45C',
        '#B3E283', '#F7B7A3', '#A3A1F7', '#F7E6A3', '#A3F7D1'
    ];

    // Data Jenis Perkerjaan
    let pekerjaan = <?= isset($pekerjaan) ? json_encode($pekerjaan) : '[]'; ?>;
    let nama_pekerjaan = [];
    let jmlh_pekerjaan = [];
    pekerjaan.forEach(el => {
        nama_pekerjaan.push(el.pekerjaan);
        jmlh_pekerjaan.push(el.total);
    });

    if (window.pekerjaanChart) {
        window.pekerjaanChart.destroy();
    }
    window.pekerjaanChart = new Chart(document.getElementById("pekerjaan-chart"), {
        type: 'pie',
        data: {
            labels: nama_pekerjaan,
            datasets: [{
                label: "Orang",
                data: jmlh_pekerjaan,
                backgroundColor: colorPalette,
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 20 // Tampilkan kotak warna legend
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Data Jenis Kelamin
    if (window.jkelChart) {
        window.jkelChart.destroy();
    }
    let jkel = <?= isset($jkel) ? json_encode($jkel) : '[]'; ?>;
    let nama_jkel = [];
    let jmlh_jkel = [];
    let warna_jkel = ['#36A2EB', '#FF6384'];
    jkel.forEach(el => {
        nama_jkel.push(el.jkel === "L" ? "Laki-Laki" : "Perempuan");
        jmlh_jkel.push(el.total);
    });

    window.jkelChart = new Chart(document.getElementById("jkel-chart"), {
        type: 'pie',
        data: {
            labels: nama_jkel,
            datasets: [{
                label: "Jenis Kelamin (orang)",
                data: jmlh_jkel,
                backgroundColor: warna_jkel,
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 20 // Tampilkan kotak warna legend
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Persebaran Penduduk
    let persebaran = <?= json_encode($persebaran ?? []); ?>;
    let nama_bagian = [];
    let jmlh_warga = [];
    let backgroundColors = [];
    persebaran.forEach((el, index) => {
        nama_bagian.push(el.nama_bagian);
        jmlh_warga.push(el.jmlh_warga);
        if (el.jmlh_warga === 0) {
            backgroundColors.push('#D3D3D3');
        } else {
            backgroundColors.push(colorPalette[index % colorPalette.length]);
        }
    });
    if (window.persebaranChart) {
        window.persebaranChart.destroy();
    }
    window.persebaranChart = new Chart(document.getElementById("persebaran-chart"), {
        type: 'pie',
        data: {
            labels: nama_bagian,
            datasets: [{
                label: "Jumlah Warga",
                data: jmlh_warga,
                backgroundColor: backgroundColors,
                borderColor: '#ffffff',
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 20 // Tampilkan kotak warna legend
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
</script>
@endpush
