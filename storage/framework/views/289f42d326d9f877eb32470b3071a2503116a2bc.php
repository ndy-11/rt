<table>
    <thead>
        <tr>
            <th>RW</th>
            <th>RT</th>
            <th>Bulan</th>
            <th>L</th>
            <th>P</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php $grouped = $data->groupBy('no_rw'); ?>
        <?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rw => $rwData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $rwPrinted = false; ?>
            <?php $__currentLoopData = $rwData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <?php if(!$rwPrinted): ?>
                        <?php echo e($rw); ?>

                        <?php $rwPrinted = true; ?>
                    <?php endif; ?>
                </td>
                <td><?php echo e($item->no_rt); ?></td>
                <td><?php echo e(\Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F')); ?></td>
                <td><?php echo e($item->laki); ?></td>
                <td><?php echo e($item->perempuan); ?></td>
                <td><?php echo e($item->laki + $item->perempuan); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rw/export/excel.blade.php ENDPATH**/ ?>