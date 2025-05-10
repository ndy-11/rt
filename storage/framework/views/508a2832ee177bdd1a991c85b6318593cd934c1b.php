<?php $__env->startPush('page-title'); ?>
Warga - <?php echo e($pengumuman->judul_pengumuman); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-style'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-body">
                <h3 class="card-title text-dark"><?php echo e($pengumuman->judul_pengumuman); ?></h3>
                <?php
                $date = new DateTime($pengumuman->created_at);
                $result = $date->format('d M Y H:i');
                ?>
                <p><span class="text-primary h6"><?php echo e($pengumuman->bagian->nama_bagian); ?></span></p>
                <p class="mb-5"><?php echo e($result); ?> WIB</p>
                <p>
                    <?php echo e($pengumuman->isi_pengumuman); ?>

                </p>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/warga/pengumuman/detail.blade.php ENDPATH**/ ?>