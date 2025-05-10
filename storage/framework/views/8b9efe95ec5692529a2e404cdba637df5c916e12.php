<?php $__env->startPush('page-title'); ?>
Warga - Pengumuman
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-wrapper">
    <h1>Pengumuman Terbaru</h1>
</div>
<div class="row">
    <?php $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-default">
            <div class="card-body">
                <h6 class="text-dark mb-4"><?php echo e($val->bagian->nama_bagian); ?></h6>
                <h5 class="card-title text-primary"><?php echo e($val->judul_pengumuman); ?></h5>
                <p class="card-text pb-3"><?php echo e(character_limiter($val->isi_pengumuman, 50)); ?></p>
                <p class="card-text">
                    <small class="text-muted"><?php echo e($val->tgl_pengumuman); ?></small>
                </p>
                <a href="/warga/pengumuman/<?php echo e($val->id); ?>" type="button" class="btn btn-primary text-white mt-4">
                    Baca
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12">
        <?php echo e($pengumuman->links()); ?>

    </div>
    <?php
    function character_limiter($str, $n = 500, $end_char = '....')
    {
    if (strlen($str) < $n) { return $str; } $str=preg_replace("/\s+/", ' ' , str_replace(array("\r\n", "\r" , "\n" ), ' ' , $str)); if (strlen($str) <=$n) { return $str; } $out="" ; foreach (explode(' ', trim($str)) as $val) {
            $out .= $val . ' ';

            if (strlen($out) >= $n) {
                $out = trim($out);
                return (strlen($out) == strlen($str)) ? $out : $out . $end_char;
            }
        }
    }
    ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/warga/pengumuman/index.blade.php ENDPATH**/ ?>