<?php $__env->startPush('page-title'); ?>
RW - Data Penduduk
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
    <h1>Data Penduduk</h1>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card-default ">
            <div class="card-header card-header-border-bottom">
                <h2>Filter RT</h2>
            </div>
            <div class="card-body">
            <form method="get" action="<?php echo e(route('rw.penduduk.index')); ?>">
                <div class="row mb-4">
                    <!-- Filter RT -->
                    <div class="col-md-3">
                        <label for="rts">Pilih RT</label>
                        <select class="form-control" id="rts" name="rts">
                            <option value="">Pilih RT</option>
                            <?php $__currentLoopData = $rtOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($rt); ?>" <?php echo e(request('rts') == $rt ? 'selected' : ''); ?>><?php echo e($rt); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <!-- Filter RW -->
                    <div class="col-md-3">
                        <label for="rw">Pilih RW</label>
                        <select class="form-control" name="rw">
                            <option value="">Pilih RW</option>
                            <?php $__currentLoopData = $rwOptions ?? ''; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($rw); ?>" <?php echo e(request('rw') == $rw ? 'selected' : ''); ?>><?php echo e($rw); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <!-- Filter Tanggal Mulai -->
                    <div class="col-md-2">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" value="<?php echo e(request('tanggal_mulai')); ?>">
                    </div>
                    <!-- Filter Tanggal Selesai -->
                    <div class="col-md-2">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" value="<?php echo e(request('tanggal_selesai')); ?>">
                    </div>
                    <!-- Button Cari -->
                    <div class="col-md-2 d-flex align-items-end">
                        <button id="cari-penduduk" type="submit" class="btn btn-primary w-100">Cari</button>
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
                        <h3 class="text-dark"><?php echo e($jmlh_warga); ?> Orang</h3>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Jumlah Keluarga</label>
                        <div class="w-100"></div>
                        <h3 class="text-dark"><?php echo e($jmlh_kk); ?> Keluarga</h3>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <label for="">Jumlah Penduduk Sementara</label>
                        <div class="w-100"></div>
                        <h3 class="text-dark"><?php echo e($jmlh_sementara); ?> Orang</h3>
                    </div>
                    <div class="w-100"></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <!-- Persebaran Penduduk -->
                            <div class="col-lg-5 col-md-6 col-sm-12 mb-4" style="margin-right: 50px;">
                                <div class="text-center mb-2">
                                    <label class="fw-bold">Persebaran Penduduk</label>
                                </div>
                                <div style="position: relative;height: 450px; width:100%; max-width: 100%">
                                    <canvas id="persebaran-chart"></canvas>
                                </div>
                            </div>
                            <!-- Jenis Kelamin -->
                            <div class="col-lg-5 col-md-6 col-sm-12 mb-4" style="margin-left: 50px;">
                                <div class="text-center mb-2">
                                    <label class="fw-bold">Jenis Kelamin</label>
                                </div>
                                <div style="position: relative;height: 400px; width:100%; max-width: 100%; margin-top: 10px">
                                    <canvas id="jkel-chart"></canvas>
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
                <a href="<?php echo e(route('pages.rw.export.excel', ['start_date' => request('tanggal_mulai'),'end_date' => request('tanggal_selesai'),'rt' => request('rt'),'rw' => request('rw')])); ?>"class="btn btn-outline-success btn-sm text-uppercase">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                    <a href="<?php echo e(route('pages.rw.export.pdf', ['start_date' => request('tanggal_mulai'),'end_date' => request('tanggal_selesai'),'rt' => request('rt'),'rw' => request('rw')])); ?>"class="btn btn-outline-info btn-sm text-uppercase" target="_blank">
                        <i class="fas fa-print"></i> Print
                    </a>
                </div>
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
                            <?php $no = 1; ?>
                            <?php $__currentLoopData = $list_warga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no); ?></td>
                                <td><?php echo e($val['nama']); ?></td>
                                <td><?php echo e($val['jkel']); ?></td>
                                <td><?php echo e($val['alamat']); ?></td>
                                <td><?php echo e($val['status']); ?></td>
                                <td>
                                    <a class="btn btn-sm text-white btn-primary" href="/rw/penduduk/<?php echo e($val['id']); ?>">Detail</a>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-script'); ?>
<script src="<?php echo e(asset('assets/plugins/charts/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/charts/chartjs-plugin-colorschemes.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/data-tables/jquery.datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/data-tables/datatables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/data-tables/datatables.responsive.min.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  $(document).ready(function() {
    $('.data-table').DataTable();
    function applyFilter() {
        // Ambil nilai tanggal mulai dan tanggal akhir dari input
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        // Kirimkan data tanggal ke controller menggunakan fetch
        fetch(`/grafik-persebaran?start_date=${startDate}&end_date=${endDate}`)
            .then(response => response.json())
            .then(data => {
                // Update chart dengan data yang difilter
                updateChart(data);
            })
            .catch(error => console.error('Error:', error));
    }
    // Hancurkan chart lama jika ada
    if (window.jkelChart) {
        window.jkelChart.destroy();
    }

    // Data Jenis Kelamin
    let jkel = <?= json_encode($jkel ?? []); ?>;
    let nama_jkel = [];
    let jmlh_jkel = [];
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
                backgroundColor: ['#36A2EB', '#FF6384'],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
let persebaran = <?= json_encode($persebaran ?? []); ?>;
let nama_bagian = [];
let jmlh_warga = [];
let backgroundColors = [];

// Define multiple colors for the chart (more colors for variety)
let colorPalette = [
    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
    '#FF9F40', '#C9CBCF', '#F7464A', '#46BFBD', '#FDB45C'
];

// Keep all RT entries, including those with zero population
persebaran.forEach((el, index) => {
    nama_bagian.push(el.nama_bagian);
    jmlh_warga.push(el.jmlh_warga);
    
    // Set a grey color for zero population
    if (el.jmlh_warga === 0) {
        backgroundColors.push('#D3D3D3');  // Grey for zero population
    } else {
        // Cycle through available colors for non-zero population
        backgroundColors.push(colorPalette[index % colorPalette.length]);  // Cycle through the color palette
    }
});

// Destroy old chart if exists
if (window.persebaranChart) {
    window.persebaranChart.destroy();
}

// Create the new chart
window.persebaranChart = new Chart(document.getElementById("persebaran-chart"), {
    type: 'pie',
    data: {
        labels: nama_bagian,
        datasets: [{
            label: "Jumlah Warga",
            data: jmlh_warga,
            backgroundColor: backgroundColors,  // Use the background colors array
            borderColor: '#ffffff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rw/penduduk/index.blade.php ENDPATH**/ ?>