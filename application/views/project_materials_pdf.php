<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .nota-container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
            border-radius: 8px;
        }

        .nota-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .nota-header .tanggal,
        .nota-header .posted {
            font-size: 14px;
            color: #555;
        }

        .nota-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .nota-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .nota-table th,
        .nota-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .nota-table th {
            background-color: #f2f2f2;
        }

        .nota-footer {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="nota-container">
        <div class="nota-header">
            <div class="tanggal">Tanggal : <?= date('d-M-Y') ?></div>
            <div class="posted">Posted : 2131730078@student.polinema.ac.id</div>
        </div>
        <div class="nota-title">
            <?= isset($nota) ? $nota : 'Nilai nota tidak ditemukan' ?>
        </div>
        <table class="nota-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Keluar</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tableData)) : ?>
                    <?php foreach ($tableData as $index => $row) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $row['kodeBarang'] ?></td>
                            <td><?= $row['namaBarang'] ?></td>
                            <td><?= $row['keluar'] ?></td>
                            <td><?= $row['satuan'] ?></td>
                            <td><?= $row['keterangan'] ?></td>
                            <td><?= $row['tanggal'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="nota-footer">
            <?= isset($nota) ? $nota : 'Nilai nota tidak ditemukan' ?>
        </div>
    </div>
</body>

</html>