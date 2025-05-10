<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('ui::components.panel', ['title' => __('Tambah Desa/Kelurahan')]); ?>
        <?php echo form()->post(route('indonesia::kelurahan.store')); ?>

        <?php echo form()->text('id')->label('Kode')->required(); ?>

        <?php echo form()->text('name')->label('Nama Desa/Kelurahan')->required(); ?>

        <?php echo form()->select('district_id', \Laravolt\Indonesia\Models\Kecamatan::pluck('name', 'id'))->label('Kecamatan')->required(); ?>

        <?php echo form()->action([
            form()->submit('Save'),
            form()->link('Cancel', route('indonesia::kelurahan.index'))
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
            'title' => __('Desa/Kelurahan'),
            'actions' => [
                [
                    'label' => __('Lihat Semua Desa/Kelurahan'),
                    'class' => '',
                    'icon' => '',
                    'url' => route('indonesia::kelurahan.index')
                ],
            ]
        ],
    ]
, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/vendor/laravolt/indonesia/resources/views/kelurahan/create.blade.php ENDPATH**/ ?>