@extends('layouts.default')
@push('page-title')
RT - Master Data Warga
@endpush
@push('custom-style')
<link href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/data-tables/responsive.datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2-boostrap.min.css')}}">
<style>
    .table-lg-font {
        font-size: 1.1rem;
    }
    .master-card {
        border-radius: 1rem;
        box-shadow: 0 2px 12px rgba(44,62,80,0.08);
        margin-bottom: 2rem;
        overflow: hidden;
    }
    .master-card .card-header {
        background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
        color: #fff;
        border-bottom: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.2rem 1.5rem;
    }
    .master-card .card-header h2 {
        margin-bottom: 0;
        font-size: 1.4rem;
        font-weight: 700;
        letter-spacing: 1px;
    }
    .master-card .card-body {
        background: #f8fafc;
        padding: 2rem 1.5rem 1.5rem 1.5rem;
        border-radius: 0 0 1rem 1rem;
    }
    .btn-outline-primary {
        border-radius: 0.5rem;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .responsive-data-table {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 1px 8px rgba(44,62,80,0.06);
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    .data-table th, .data-table td {
        vertical-align: middle !important;
    }
    .data-table th {
        background: #e3eafc;
        color: #224abe;
        font-weight: 700;
        border-top: none;
    }
    .data-table tr {
        transition: background 0.15s;
    }
    .data-table tbody tr:hover {
        background: #f1f5fa;
    }
    .btn-sm {
        border-radius: 0.4rem;
        font-size: 0.95rem;
        font-weight: 500;
    }
    .card-master-side {
        border-radius: 1rem;
        box-shadow: 0 2px 12px rgba(44,62,80,0.08);
        margin-bottom: 1.5rem;
        background: #f8fafc;
    }
    .card-master-side .card-header {
        background: linear-gradient(90deg, #36b9cc 0%, #117a8b 100%);
        color: #fff;
        border-bottom: none;
        padding: 1rem 1.2rem;
        border-radius: 1rem 1rem 0 0;
    }
    .card-master-side .card-header.bg-warning {
        background: linear-gradient(90deg, #f6c23e 0%, #e0a800 100%);
        color: #fff;
    }
    .card-master-side .card-body {
        padding: 1.2rem 1.2rem 1rem 1.2rem;
    }
    /* Custom pagination style */
    .dataTables_wrapper .dataTables_paginate .pagination {
        justify-content: flex-end;
        margin-top: 1.5rem;
    }
    .dataTables_wrapper .dataTables_paginate .page-item .page-link {
        border-radius: 0.5rem !important;
        margin: 0 0.15rem;
        color: #224abe;
        border: 1px solid #e3eafc;
        font-weight: 600;
        background: #f8fafc;
        transition: background 0.2s, color 0.2s;
    }
    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link,
    .dataTables_wrapper .dataTables_paginate .page-item .page-link:focus,
    .dataTables_wrapper .dataTables_paginate .page-item .page-link:hover {
        background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
        color: #fff !important;
        border-color: #4e73df;
        box-shadow: 0 2px 8px rgba(44,62,80,0.08);
    }
    .dataTables_wrapper .dataTables_paginate .page-item.disabled .page-link {
        background: #e9ecef;
        color: #b0b3b8;
        border-color: #e3eafc;
    }
    .btn-export {
        border-radius: 0.5rem;
        font-weight: 600;
        letter-spacing: 1px;
        padding: 0.5rem 1.2rem;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 2px 8px rgba(44,62,80,0.06);
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    }
    .btn-export-excel {
        background: linear-gradient(90deg, #28a745 0%, #218838 100%);
        color: #fff !important;
        border: none;
    }
    .btn-export-excel:hover, .btn-export-excel:focus {
        background: linear-gradient(90deg, #218838 0%, #28a745 100%);
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(40,167,69,0.13);
    }
    .btn-export-pdf {
        background: linear-gradient(90deg, #17a2b8 0%, #138496 100%);
        color: #fff !important;
        border: none;
    }
    .btn-export-pdf:hover, .btn-export-pdf:focus {
        background: linear-gradient(90deg, #138496 0%, #17a2b8 100%);
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(23,162,184,0.13);
    }
    .btn-export i {
        font-size: 1.2rem;
        margin-right: 0.3rem;
    }
    .btn-action {
        border-radius: 0.5rem;
        font-weight: 600;
        letter-spacing: 1px;
        padding: 0.45rem 1.1rem;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 2px 8px rgba(44,62,80,0.06);
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        border: none;
    }
    .btn-action-filter {
        background: linear-gradient(90deg, #36b9cc 0%, #117a8b 100%);
        color: #fff !important;
    }
    .btn-action-filter:hover, .btn-action-filter:focus {
        background: linear-gradient(90deg, #117a8b 0%, #36b9cc 100%);
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(54,185,204,0.13);
    }
    .btn-action-reset {
        background: linear-gradient(90deg, #858796 0%, #6c757d 100%);
        color: #fff !important;
    }
    .btn-action-reset:hover, .btn-action-reset:focus {
        background: linear-gradient(90deg, #6c757d 0%, #858796 100%);
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(133,135,150,0.13);
    }
    .btn-action-mutasi {
        background: linear-gradient(90deg, #36b9cc 0%, #138496 100%);
        color: #fff !important;nt;
    }
    .btn-action-mutasi:hover, .btn-action-mutasi:focus {
        
        background: linear-gradient(90deg, #138496 0%, #36b9cc 100%);
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(54,185,204,0.13);
    }
    .btn-action-sementara {
        
        background: linear-gradient(90deg, #f6c23e 0%, #e0a800 100%);
        color: #fff !important;
    }
    .btn-action-sementara:hover, .btn-action-sementara:focus {
        background: linear-gradient(90deg, #e0a800 0%, #f6c23e 100%);
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(246,194,62,0.13);
    }
</style>
@endpush
@section('content')
<div class="breadcrumb-wrapper">
    <h1>Data Warga</h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card master-card">
            <div class="card-header card-header-border-bottom d-flex justify-content-between mb-4">
                <h2><i class="mdi mdi-account-group"></i> Data Warga</h2>
                <!-- <div>
                    <a href="/rt/penduduk/create" target="" class="btn btn-outline-primary text-uppercase">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Data Warga
                    </a>
                </div> -->
            </div>
            <div class="card-body">
                {{-- Filter Tanggal --}}
                <form method="GET" action="{{ route('rt.penduduk.index') }}" class="form-inline mb-3">
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
                    <button type="submit" class="btn btn-action btn-action-filter"><i class="mdi mdi-filter-variant"></i> Filter</button>
                    <a href="{{ route('rt.penduduk.index') }}" class="btn btn-action btn-action-reset ml-2"><i class="mdi mdi-refresh"></i> Reset</a>
                </form>
                {{-- Tombol Export --}}
                <div class="mb-2">
                    <a href="{{ route('pages.rt.export.excel', [
                        'start_date' => request('tanggal_mulai'),
                        'end_date' => request('tanggal_selesai'),
                        'rt' => request('rt'),
                        'rw' => request('rw')
                    ]) }}"
                    class="btn btn-export btn-export-excel mr-2">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                    <a href="{{ route('pages.rt.export.pdf', [
                        'start_date' => request('tanggal_mulai'),
                        'end_date' => request('tanggal_selesai'),
                        'rt' => request('rt'),
                        'rw' => request('rw')
                    ]) }}"
                    class="btn btn-export btn-export-pdf"
                    target="_blank">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                </div>
                {{-- Tabel Data --}}
                <div class="responsive-data-table" style="overflow-x:auto;">
                    <table class="table dt-responsive nowrap data-table table-lg-font w-100" style="min-width:1200px; font-size: 1rem;">
                        <thead>
                            <tr>
                                <th style="font-size:1.1rem;">No</th>
                                <th style="font-size:1.1rem;">NIK</th>
                                <th style="font-size:1.1rem;">Nomor KK</th>
                                <th style="font-size:1.1rem;">Nama Lengkap</th>
                                <th style="font-size:1.1rem;">Jenis Kelamin</th>
                                <th style="font-size:1.1rem;">Alamat</th>
                                <th style="font-size:1.1rem;">Status</th>
                                <th style="font-size:1.1rem; white-space:nowrap;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($warga && count($warga) > 0)
                                @foreach($warga as $key => $val)
                                    @if(is_object($val))
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $val->nik }}</td>
                                            <td>{{ $val->no_kk }}</td>
                                            <td>{{ $val->nama }}</td>
                                            <td>
                                                @if($val->jkel == "Perempuan" || $val->jkel == "P")
                                                    <span class="badge" style="background:#e83e8c; color:#fff; border-radius:0.4rem;">
                                                        <i class="mdi mdi-gender-female"></i> Perempuan
                                                    </span>
                                                @else
                                                    <span class="badge badge-primary" style="border-radius:0.4rem;">
                                                        <i class="mdi mdi-gender-male"></i> Laki-Laki
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $val->alamat }}</td>
                                            <td>
                                                @if($val->status == "Tetap")
                                                    <span class="badge badge-success" style="border-radius:0.4rem;">Tetap</span>
                                                @elseif($val->status == "Sementara")
                                                    <span class="badge badge-warning">Sementara</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $val->status }}</span>
                                                @endif
                                            </td>
                                            <td style="white-space:nowrap;">
                                                <a class="btn btn-action btn-action-detail btn-xs d-inline-flex align-items-center btn-primary" style="min-width: 80px; font-size:0.92rem; padding:0.3rem 0.7rem;" href="/rt/penduduk/{{ $val->id }}"><i class="mdi mdi-eye"></i> Detail</a>
                                                <a class="btn btn-action btn-warning text-white btn-xs d-inline-flex align-items-center" style="min-width: 70px; font-size:0.92rem; padding:0.3rem 0.7rem;" href="{{ route('rt.penduduk.edit', $val->id) }}"><i class="mdi mdi-pencil"></i> Edit</a>
                                                <form action="{{ route('rt.penduduk.destroy', $val->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete(this, event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-action btn-danger text-white btn-xs d-inline-flex align-items-center" style="min-width: 70px; font-size:0.92rem; padding:0.3rem 0.7rem;">
                                                        <i class="mdi mdi-delete"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data warga yang tersedia.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card card-master-side">
                    <div class="card-header">
                        <i class="mdi mdi-swap-horizontal-bold mr-2"></i> Mutasi Warga
                    </div>
                    <div class="card-body">
                        <p class="mb-4">Pengelolaan untuk warga datang / pindah / meninggal</p>
                        <a href="/rt/mutasi/create" class="btn btn-action btn-action-mutasi mb-4">
                            <i class="mdi mdi-plus-circle"></i> Tambah Mutasi
                        </a>
                        <a href="/rt/mutasi" class="btn btn-outline-secondary mb-4">
                            <i class="mdi mdi-eye"></i> Lihat Data
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-master-side">
                    <div class="card-header bg-warning">
                        <i class="mdi mdi-account-clock-outline mr-2"></i> Warga Sementara
                    </div>
                    <div class="card-body">
                        <p class="mb-4">Pengelolaan data Warga pendatang, bertujuan untuk tinggal sementara tidak menetap</p>
                        <a href="/rt/penduduk-sementara/create" class="btn btn-action btn-action-sementara mb-4">
                            <i class="mdi mdi-plus-circle"></i> Tambah Warga Sementara
                        </a>
                        <a href="/rt/penduduk-sementara" class="btn btn-outline-secondary mb-4">
                            <i class="mdi mdi-eye"></i> Lihat Data
                        </a>
                    </div>
                </div>
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
        // Hanya inisialisasi DataTable sekali saja, tanpa destroy
        if (!$.fn.DataTable.isDataTable('.data-table')) {
            $('.data-table').DataTable({
                "lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, 100] ],
                "pageLength": 10,
                 "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
            });
        }

        let pekerjaan = <?= json_encode($pekerjaan); ?>;
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
        });

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

   // Custom confirm dialog for delete
   function confirmDelete(form, event) {
        event.preventDefault();
        let dialog = document.createElement('div');
        dialog.innerHTML = `
            <div id="custom-confirm-overlay" style="position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(44,62,80,0.25);z-index:9999;display:flex;align-items:center;justify-content:center;">
                <div style="background:#fff;border-radius:1rem;box-shadow:0 4px 32px rgba(44,62,80,0.18);padding:2rem 2.5rem;max-width:350px;text-align:center;">
                    <div style="font-size:2.5rem;color:#e74a3b;"><i class='mdi mdi-alert-circle-outline'></i></div>
                    <div style="font-size:1.15rem;font-weight:600;margin-bottom:1rem;color:#222;">Konfirmasi Hapus Data</div>
                    <div style="font-size:1rem;color:#555;margin-bottom:1.5rem;">Yakin ingin menghapus data ini?<br><span style='font-size:0.95rem;color:#e74a3b;'>Tindakan ini tidak dapat dibatalkan.</span></div>
                    <button id="btn-confirm-yes" style="background:linear-gradient(90deg,#e74a3b 0%,#c0392b 100%);color:#fff;border:none;border-radius:0.5rem;padding:0.5rem 1.3rem;font-weight:600;margin-right:0.7rem;box-shadow:0 2px 8px rgba(231,74,59,0.13);">Ya, Hapus</button>
                    <button id="btn-confirm-no" style="background:linear-gradient(90deg,#858796 0%,#6c757d 100%);color:#fff;border:none;border-radius:0.5rem;padding:0.5rem 1.3rem;font-weight:600;">Batal</button>
                </div>
            </div>
        `;
        document.body.appendChild(dialog);

        document.getElementById('btn-confirm-no').onclick = function() {
            document.body.removeChild(dialog);
        };
        document.getElementById('btn-confirm-yes').onclick = function() {
            document.body.removeChild(dialog);
            form.submit();
        };
        return false;
   }
</script>
@endpush