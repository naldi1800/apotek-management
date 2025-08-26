<script>
    window.addEventListener("load", function () {
        window.print();
        setTimeout(function () {
            window.close();
        }, 1000);
    });
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Barang Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
            background-color: #fff;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: bold;
            color: black;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            /* background-color: #4CAF50; */
            color: black;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .ttd {
            margin-top: 20px;
            text-align: center;
        }

        .tanggal {
            margin-vertical: 10px;
        }
    </style>
</head>

<body>
    <div>
        <h1>Toko Sparepart Komputer</h1>
        <h4>Jl. Perintis Kemerdekaan No. x, Makassar</h4>
        <hr>
        <h3>Data Barang Masuk</h3>
        <p class="tanggal">
            Mulai Tanggal : {{ date('d F Y', strtotime($from)) }}
            <br>
            Sampai Tanggal : {{ date('d F Y', strtotime($to)) }}
        </p>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
            @php
                $no = 1;
                $total = 0;
            @endphp
            @foreach ($datas as $d)
                @php
                    $total += $d->jumlah * $d->total_harga;
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $d->sparepart->nama_barang }}</td>
                    <td>{{ $d->created_at->format('d-m-Y H:i:s') }}</td>
                    <td>{{ $d->jumlah }}</td>
                    <td>{{ App\Helpers\Fungsi::rupiah($d->total_harga) }}</td>
                    <td>{{ App\Helpers\Fungsi::rupiah($d->jumlah * $d->total_harga) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5">Total</td>
                <td class="fw-bold">
                    {{ App\Helpers\Fungsi::rupiah($total) }}
                </td>
            </tr>
        </table>
    </div>

    <br>
    <br>
    <br>
    <div class="ttd">
        <p>Makassar, {{ date('d F Y') }}</p>
        <br>
        <br>
        <br>
        <p>
            Pemimpin
        </p>
    </div>


</body>

</html>

