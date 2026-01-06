<!DOCTYPE html>
<html>

<head>
    <title>Laporan Statistik Repository</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .stat-box {
            background: #f4f4f4;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #2d3748;
            color: white;
        }

        h3 {
            color: #2d3748;
            border-left: 5px solid #d97706;
            padding-left: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>UNIVERSITAS MALIKUSSALEH</h2>
        <h1>Laporan Distribusi E-Repository</h1>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <div class="stat-box">
        <strong>Total Koleksi Dokumen:</strong> {{ $totalDokumen }} Berkas
    </div>

    <h3>1. Distribusi Berdasarkan Kategori</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Kategori</th>
                <th>Jumlah Dokumen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perKategori as $kat)
                <tr>
                    <td>{{ $kat->name }}</td>
                    <td>{{ $kat->dokumens_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>2. Tren Upload (5 Tahun Terakhir)</h3>
    <table>
        <thead>
            <tr>
                <th>Tahun Terbit</th>
                <th>Jumlah Upload</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perTahun as $thn)
                <tr>
                    <td>{{ $thn->year }}</td>
                    <td>{{ $thn->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right;">
        <p>Lhokseumawe, {{ date('d F Y') }}</p>
        <br><br><br>
        <p><strong>Administrator Repository</strong></p>
    </div>
</body>

</html>
