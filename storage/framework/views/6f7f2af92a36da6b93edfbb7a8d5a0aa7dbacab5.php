<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('ui::components.panel', ['title' => __('Edit Kota/Kabupaten')]); ?>
        <?php echo form()->bind($kabupaten)->put(route('indonesia::kabupaten.update', $kabupaten)); ?>

        <?php echo form()->hidden('previous_id')->value($kabupaten->getKey()); ?>

        <?php echo form()->text('id')->label('Kode')->required(); ?>

        <?php echo form()->text('name')->label('Name')->required(); ?>

        <?php echo form()->select('province_id', \Laravolt\Indonesia\Models\Provinsi::pluck('name', 'id'))->label('Provinsi')->required(); ?>

        <?php echo form()->action([
            form()->submit('Save'),
            form()->link('Cancel', route('indonesia::kabupaten.index'))
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
            'title' => __('Kota/Kabupaten'),
            'actions' => [
                [
                    'label' => __('Lihat Semua Kota/Kabupaten'),
                    'class' => '',
                    'icon' => '',
                    'url' => route('indonesia::kabupaten.index')
                ],
            ]
        ],
    ]
, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/vendor/laravolt/indonesia/resources/views/kabupaten/edit.blade.php ENDPATH**/ ?>