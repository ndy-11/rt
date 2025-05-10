@extends('layouts.default')
@push('page-title')
RT - Data Penduduk
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
    <h1>Data Warga</h1>
</div>
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="card bg-primary card-default">
            <div class="card-body text-white">
                <h5 class="card-title">Jumlah Warga</h5>
                <span class="h2 mt-2">{{$jmlh_penduduk ?? ''}}</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="card bg-success card-default">
            <div class="card-body text-white">
                <h5 class="card-title">Jumlah Keluarga</h5>
                <span class="h2 mt-2">{{$jmlh_kk}}</span>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Summary</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-6 mb-4 text-center" >
                        <h5 class="mt-2 mb-4">Jenis Kelamin</h5>
                        <canvas id="jkel-chart" style="height: 450px; width:100% !important; max-width: 100%"></canvas>
                    </div>
                   <!-- <div class="col-lg-6 col-md-6 col-sm-12 mb-4 text-center">
                        <h5 class="mt-2 mb-4">Pekerjaan</h5>
                        <canvas id="pekerjaan-chart"></canvas>
                    </div> -->
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

            {{-- Filter Tanggal --}}
            <form method="GET" action="{{ route('pages.rt.penduduk.index') }}" class="form-inline mb-3">
                <div class="form-group mr-2">
                    <label for="tanggal_mulai" class="mr-2">Dari</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                           value="{{ request('tanggal_mulai') }}">
                </div>
                <div class="form-group mr-2">
                    <label for="tanggal_selesai" class="mr-2">Sampai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control"
                           value="{{ request('tanggal_selesai') }}">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            {{-- Tombol Export --}}
            <div class="mb-2">
            <a href="{{ route('pages.rt.export.excel', [
        'start_date' => request('tanggal_mulai'),
        'end_date' => request('tanggal_selesai'),
        'rt' => request('rt'),
        'rw' => request('rw')
    ]) }}"
   class="btn btn-outline-success btn-sm text-uppercase">
    <i class="fas fa-file-excel"></i> Export Excel
</a>

<a href="{{ route('pages.rt.export.pdf', [
        'start_date' => request('tanggal_mulai'),
        'end_date' => request('tanggal_selesai'),
        'rt' => request('rt'),
        'rw' => request('rw')
    ]) }}"
   class="btn btn-outline-info btn-sm text-uppercase" target="_blank">
    <i class="fas fa-print"></i> Print
</a>

            </div>

            {{-- Tabel Data --}}
            <div class="responsive-data-table">
                <table class="table dt-responsive nowrap data-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($warga && count($warga) > 0)
                            @foreach($warga as $key => $val)
                                @if(is_object($val))
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $val->nama }}</td>
                                        <td>{{ $val->jkel }}</td>
                                        <td>{{ $val->alamat }}</td>
                                        <td>{{ $val->status }}</td>
                                        <td><a class="btn btn-sm btn-primary" href="/rt/penduduk/{{ $val->id }}">Detail</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data warga yang tersedia.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <div class="col-lg-4 col-md-8 col-sm-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Mutasi Warga</h2>
            </div>
            <div class="card-body">
                <p class="mb-4">Pengelolaan untuk warga datang / pindah / meninggal</p>
                <a href="/rt/mutasi/create" class="btn btn-primary mb-4">
                    Tambah Mutasi
                </a>
                <a href="/rt/mutasi" class="btn btn-outline-secondary mb-4">
                    Lihat Data
                </a>
            </div>
        </div>
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Warga Sementara</h2>
            </div>
            <div class="card-body">
                <p class="mb-4">Pengelolaan data Warga pendatang, bertujuan untuk tinggal sementara tidak menetap</p>
                <a href="/rt/penduduk-sementara/create" class="btn btn-primary mb-4">
                    Tambah Warga Sementara
                </a>
                <a href="/rt/penduduk-sementara" class="btn btn-outline-secondary mb-4">
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
<script>
   $(document).ready(function() {
        $('.data-table').DataTable();

        /*let pekerjaan = <?= json_encode($pekerjaan); ?>;
        let nama_pekerjaan = [];
        let jmlh_pekerjaan = [];
        pekerjaan.forEach(el => {
            nama_pekerjaan.push(el.pekerjaan);
            jmlh_pekerjaan.push(el.total);
        });
        
        new Chart(document.getElementById("pekerjaan-chart"), {
            type: 'pie',
            data: {
                labels: nama_pekerjaan,
                datasets: [{
                    label: "Orang",
                    data: jmlh_pekerjaan
                }]
            },
            options: {
                legend: {
                    position: 'bottom'
                },
                plugins: {
                    colorschemes: {
                        scheme: 'brewer.Paired12'
                    }
                }
            }
        });*/

        new Chart(document.getElementById("jkel-chart"), {
            type: 'pie',
            data: {
                labels: ["Laki-Laki", "Perempuan"],
                datasets: [{
                    label: "Jenis Kelamin (orang)",
                    data: [
                        <?= $jkel[0] ?>,
                        <?= $jkel[1] ?>
                    ]
                }]
            },
            options: {
                legend: {
                    position: 'bottom'
                },
                plugins: {
                    colorschemes: {
                        scheme: 'brewer.Paired12'
                    }
                }
            }
        });
    });
</script>
@endpush