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
        .nota-header .posted,
        .nota-header .rekap {
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
            <?php if (isset($user) && !empty($user)) : ?>
                <div class="posted">Posted : <?= $user->username; ?></div>
            <?php endif; ?>
            <?php
            function formatTanggal($tanggal)
            {
                // Asumsi format input adalah 'dd-mm-yyyy'
                $parts = explode('-', $tanggal);
                if (count($parts) == 3) {
                    return $parts[0] . '/' . $parts[1] . '/' . $parts[2]; // Format 'dd/mm/yyyy'
                }
                return $tanggal; // Kembalikan format asli jika tidak sesuai
            }
            ?>

            <?php if (isset($min) && isset($max)) : ?>
                <div class="rekap">Rekap Stock Masuk Tanggal <?= formatTanggal($min); ?> - <?= formatTanggal($max); ?></div>
            <?php endif; ?>
        </div>
        <table class="nota-table">
            <thead>
                <tr>
                    <th>Nota</th>
                    <th>Keterangan</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Tukang</th>
                    <th>Project</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tableData)) : ?>
                    <?php foreach ($tableData as $index => $row) : ?>
                        <tr>
                            <td><?= $row['nota'] ?></td>
                            <td><?= $row['ket'] ?></td>
                            <td><?= $row['kodeb'] ?></td>
                            <td><?= $row['namab'] ?></td>
                            <td><?= $row['masuk'] ?></td>
                            <td><?= $row['namat'] ?></td>
                            <td><?= $row['projectt'] ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tgl'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td>Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>