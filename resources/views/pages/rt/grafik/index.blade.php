@extends('layouts.default')
@push('page-title')
RT - Grafik Penduduk
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
    .stat-card {
        position: relative;
        overflow: hidden;
        border-radius: 1rem;
        box-shadow: 0 4px 24px rgba(44,62,80,0.08);
        transition: transform 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 8px 32px rgba(44,62,80,0.16);
    }
    .stat-bg-1 {
        background: linear-gradient(120deg, #4e73df 0%, #224abe 100%);
    }
    .stat-bg-2 {
        background: linear-gradient(120deg, #1cc88a 0%, #13855c 100%);
    }
    .stat-icon {
        font-size: 3.5rem;
        opacity: 0.18;
        position: absolute;
        right: 1.5rem;
        bottom: 1.5rem;
        z-index: 0;
    }
    .stat-content {
        position: relative;
        z-index: 1;
    }
    .stat-label {
        font-size: 1.1rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        opacity: 0.85;
    }
    .stat-value {
        font-size: 2.8rem;
        font-weight: bold;
        line-height: 1;
        margin: 0.2rem 0 0.5rem 0;
    }
    .stat-desc {
        font-size: 1rem;
        opacity: 0.85;
    }
    .chart-legend {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.75rem;
        font-size: 1rem;
    }
    .chart-legend-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.2rem 0.7rem;
        border-radius: 1rem;
        background: #f8f9fc;
        color: #222;
        font-weight: 500;
        box-shadow: 0 1px 4px rgba(44,62,80,0.06);
    }
    .chart-legend-color {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        display: inline-block;
        border: 2px solid #e2e6ea;
    }
    .chart-container {
        position: relative;
        min-width: 320px;
        min-height: 320px;
        background: linear-gradient(135deg, #f8fafc 60%, #e3eafc 100%);
        border-radius: 1.5rem;
        box-shadow: 0 2px 12px rgba(44,62,80,0.06);
        padding: 1.5rem 0.5rem 1rem 0.5rem;
        margin-bottom: 1rem;
        transition: box-shadow 0.2s;
    }
    .chart-container:hover {
        box-shadow: 0 8px 32px rgba(44,62,80,0.13);
    }
    .chart-title-ico {
        font-size: 2.2rem;
        vertical-align: middle;
        margin-right: 0.5rem;
        opacity: 0.7;
    }
</style>
@endpush
@section('content')
<div class="breadcrumb-wrapper">
    <h1>Grafik Warga</h1>
</div>
<div class="row mb-4">
    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
        <div class="card stat-card stat-bg-1 text-white border-0 shadow h-100">
            <div class="card-body stat-content d-flex flex-column justify-content-center align-items-start">
                <div class="stat-label mb-1">Jumlah Warga</div>
                <div class="stat-value">{{$jmlh_penduduk}}</div>
                <div class="stat-desc">Total seluruh warga terdaftar</div>
            </div>
            <i class="mdi mdi-account-group stat-icon"></i>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
        <div class="card stat-card stat-bg-2 text-white border-0 shadow h-100">
            <div class="card-body stat-content d-flex flex-column justify-content-center align-items-start">
                <div class="stat-label mb-1">Jumlah Keluarga</div>
                <div class="stat-value">{{$jmlh_kk}}</div>
                <div class="stat-desc">Total seluruh KK terdaftar</div>
            </div>
            <i class="mdi mdi-home-group stat-icon"></i>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Summary</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4 text-center">
                        <h5 class="mt-2 mb-4">
                            <i class="mdi mdi-gender-male-female chart-title-ico" style="color:#4e73df"></i>
                            Jenis Kelamin
                        </h5>
                        <div class="chart-container">
                            <canvas id="jkel-chart" style="max-width:100%;max-height:350px;"></canvas>
                            <div id="jkel-legend" class="chart-legend mt-3"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4 text-center">
                        <h5 class="mt-2 mb-4">
                            <i class="mdi mdi-briefcase-outline chart-title-ico" style="color:#1cc88a"></i>
                            Pekerjaan
                        </h5>
                        <div class="chart-container">
                            <canvas id="pekerjaan-chart" style="max-width:100%;max-height:350px;"></canvas>
                            <div id="pekerjaan-legend" class="chart-legend mt-3"></div>
                        </div>
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

        // Fix ChartJS resize flicker by disabling responsive animation
        Chart.defaults.responsiveAnimationDuration = 0;

        // Custom colors for charts
        const pekerjaanColors = [
            '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69', '#fd7e14', '#20c997', '#6f42c1'
        ];
        const jkelColors = ['#4e73df', '#e83e8c'];

        // Pekerjaan Chart
        let pekerjaan = <?= json_encode($pekerjaan ?? ''); ?>;
        let nama_pekerjaan = [];
        let jmlh_pekerjaan = [];
        pekerjaan.forEach(el => {
            nama_pekerjaan.push(el.pekerjaan);
            jmlh_pekerjaan.push(el.total);
        });

        let pekerjaanChart = new Chart(document.getElementById("pekerjaan-chart"), {
            type: 'doughnut',
            data: {
                labels: nama_pekerjaan,
                datasets: [{
                    label: "Orang",
                    data: jmlh_pekerjaan,
                    backgroundColor: pekerjaanColors,
                    borderWidth: 2,
                    borderColor: "#fff"
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: { display: false },
                    colorschemes: { scheme: 'brewer.Paired12' }
                },
                animation: { duration: 800 }
            }
        });

        // Custom legend for pekerjaan
        let pekerjaanLegendHtml = '';
        pekerjaanChart.data.labels.forEach(function(label, i) {
            pekerjaanLegendHtml += '<span class="chart-legend-item"><span class="chart-legend-color" style="background:' + pekerjaanColors[i % pekerjaanColors.length] + '"></span>' + label + ' (' + pekerjaanChart.data.datasets[0].data[i] + ')</span>';
        });
        $('#pekerjaan-legend').html(pekerjaanLegendHtml);

        // Jenis Kelamin Chart
        let jkelChart = new Chart(document.getElementById("jkel-chart"), {
            type: 'doughnut',
            data: {
                labels: ["Laki-Laki", "Perempuan"],
                datasets: [{
                    label: "Jenis Kelamin (orang)",
                    data: [
                        <?= $jkel[0] ?>,
                        <?= $jkel[1] ?>
                    ],
                    backgroundColor: jkelColors,
                    borderWidth: 2,
                    borderColor: "#fff"
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: { display: false },
                    colorschemes: { scheme: 'brewer.Paired12' }
                },
                animation: { duration: 800 }
            }
        });

        // Custom legend for jenis kelamin
        let jkelLegendHtml = '';
        jkelChart.data.labels.forEach(function(label, i) {
            jkelLegendHtml += '<span class="chart-legend-item"><span class="chart-legend-color" style="background:' + jkelColors[i % jkelColors.length] + '"></span>' + label + ' (' + jkelChart.data.datasets[0].data[i] + ')</span>';
        });
        $('#jkel-legend').html(jkelLegendHtml);
   });
</script>
@endpush