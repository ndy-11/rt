<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Penduduk</title>
    <style>
        body {
            font-family: "DejaVu Sans", Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
        thead { display: table-header-group; }
        tr { page-break-inside: avoid; }
    </style>
</head>
<body>
    <h2>Laporan Data Warga per RT/RW</h2>
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
            <?php $__currentLoopData = $rekap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->rw); ?></td>
                    <td><?php echo e($item->rt); ?></td>
                    <td><?php echo e($item->bulan); ?></td>
                    <td><?php echo e($item->l); ?></td>
                    <td><?php echo e($item->p); ?></td>
                    <td><?php echo e($item->jumlah); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH /media/sandy/01D8523B2AAE3E401/Rest In Peace/Project/sirt-web/resources/views/pages/rw/export/pdf.blade.php ENDPATH**/ ?>