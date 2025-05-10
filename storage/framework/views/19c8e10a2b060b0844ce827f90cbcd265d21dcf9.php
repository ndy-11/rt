<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('ui::components.panel', ['title' => __('Edit Provinsi')]); ?>
        <?php echo form()->bind($provinsi)->put(route('indonesia::provinsi.update', $provinsi)); ?>

        <?php echo form()->hidden('previous_id')->value($provinsi->getKey()); ?>

        <?php echo form()->text('id')->label('Kode')->required(); ?>

        <?php echo form()->text('name')->label('Name')->required(); ?>

        <?php echo form()->action([
            form()->submit('Save'),
            form()->link('Cancel', route('indonesia::provinsi.index'))
        ]); ?>

        <?php echo form()->close(); ?>

    <?php if (isset($__componentOriginal647a78a6cc9588deff29cdf345200f5d71a9c87a)): ?>
<?php $component = $__componentOriginal647a78a6cc9588deff29cdf345200f5d71a9c87a; ?>
<?php unset($__componentOriginal647a78a6cc9588deff29cdf345200f5d71a9c87a); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(
    config('laravolt.indonesia.view.layout'),
    [
        '__page' => [
            'title' => __('Provinsi'),
            'actions' => [
                [
                    'label' => __('Lihat Semua Provinsi'),
                    'class' => '',
                    'icon' => '',
                    'url' => route('indonesia::provinsi.index')
                ],
            ]
        ],
    ]
, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/vendor/laravolt/indonesia/resources/views/provinsi/edit.blade.php ENDPATH**/ ?>