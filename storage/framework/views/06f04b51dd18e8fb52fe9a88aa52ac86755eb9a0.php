<?php $__env->startPush('page-title'); ?>
RT - Detail Penduduk
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
<style>
    .detail-card {
        border-radius: 1rem;
        box-shadow: 0 2px 12px rgba(44,62,80,0.08);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    .detail-card .card-header {
        background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
        color: #fff;
        border-bottom: none;
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.2rem 1.5rem;
    }
    .detail-card .card-header.bg-warning {
        background: linear-gradient(90deg, #f6c23e 0%, #e0a800 100%);
        color: #fff;
    }
    .detail-card .card-header.bg-info {
        background: linear-gradient(90deg, #36b9cc 0%, #117a8b 100%);
        color: #fff;
    }
    .detail-card .media-icon {
        width: 48px;
        height: 48px;
        font-size: 2rem;
        background: rgba(255,255,255,0.18);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .detail-label {
        font-weight: 600;
        color: #4e73df;
        font-size: 1rem;
        margin-bottom: 0.2rem;
    }
    .detail-value {
        font-size: 1.25rem;
        color: #222;
        font-weight: 500;
        margin-bottom: 0.7rem;
    }
    .detail-section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #224abe;
        margin-bottom: 1rem;
        letter-spacing: 1px;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1 class="mb-2">Detail Warga</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/rt/penduduk">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                Data Warga
            </li>
            <li class="breadcrumb-item" aria-current="page">Detail Warga</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div class="card detail-card">
            <div class="card-header">
                <div class="media-icon bg-white text-primary">
                    <i class="mdi mdi-account font-size-20"></i>
                </div>
                <h2 class="mb-0">Identitas Warga</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value"><?php echo e($warga->nama); ?></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">Jenis Kelamin</div>
                        <div class="detail-value">
                            <?php if($warga->jkel == "P" || strtolower($warga->jkel) == "perempuan"): ?>
                                <span class="badge" style="background:#e83e8c; color:#fff;">
                                    <i class="mdi mdi-gender-female"></i> Perempuan
                                </span>
                            <?php else: ?>
                                <span class="badge badge-primary">
                                    <i class="mdi mdi-gender-male"></i> Laki-Laki
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">Tanggal Lahir</div>
                        <div class="detail-value"><?php echo e($warga->tgl_lahir); ?></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">Nomor Induk Penduduk</div>
                        <div class="detail-value"><?php echo e($warga->nik); ?></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">Nomor Kartu Keluarga</div>
                        <div class="detail-value"><?php echo e($warga->no_kk); ?></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">RT / RW</div>
                        <div class="detail-value"><?php echo e($warga->no_rt); ?> / <?php echo e($warga->no_rw); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card detail-card">
            <div class="card-header bg-warning">
                <div class="media-icon bg-white text-warning">
                    <i class="mdi mdi-account-card-details font-size-20"></i>
                </div>
                <h2 class="mb-0">Informasi Warga</h2>
            </div>
            <div class="card-body">
                <div class="detail-section-title"><i class="mdi mdi-information-outline"></i> Data Lainnya</div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">Agama</div>
                        <div class="detail-value"><?php echo e($warga->agama); ?></div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">Status Kawin</div>
                        <div class="detail-value"><?php echo e($warga->status_kawin ?? '-'); ?></div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">Pendidikan</div>
                        <div class="detail-value"><?php echo e($warga->pendidikan); ?></div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">Pekerjaan</div>
                        <div class="detail-value"><?php echo e($warga->pekerjaan); ?></div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">Kewarganegaraan</div>
                        <div class="detail-value"><?php echo e($warga->kewarganegaraan ?? '-'); ?></div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <div class="detail-label">Kedudukan Keluarga</div>
                        <div class="detail-value"><?php echo e($warga->kedudukan_keluarga ?? '-'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card detail-card">
            <div class="card-header bg-info">
                <div class="media-icon bg-white text-info">
                    <i class="mdi mdi-home-map-marker font-size-20"></i>
                </div>
                <h2 class="mb-0">Alamat Warga</h2>
            </div>
            <div class="card-body">
                <div class="detail-section-title"><i class="mdi mdi-map-marker"></i> Alamat</div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                        <div class="detail-label">Alamat KTP</div>
                        <div class="detail-value"><?php echo e($warga->alamat_ktp); ?></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                        <div class="detail-label">Alamat Tinggal</div>
                        <div class="detail-value"><?php echo e($warga->alamat); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rt/penduduk/detail.blade.php ENDPATH**/ ?>