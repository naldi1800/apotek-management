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

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
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
        <h1>Apotek Harapan Sehat</h1>
        <h4>Jl. Paccerakkang No.78 Kec. Biringkanaya Kota Makassar</h4>
        <hr>
        <h3>Data Obat Keluar/Masuk</h3>
        <p class="tanggal">
            Mulai Tanggal : {{ date('d F Y', strtotime($from)) }}
            <br>
            Sampai Tanggal : {{ date('d F Y', strtotime($to)) }}
        </p>
        <table>
            <tr class="text-center text-align-middle text-capitalize">
                <th>No</th>
                <th>Nama Obat</th>
                <th>Batch Number</th>
                <th>Keteragan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
            @if($datas->isEmpty())
                <tr class="text-center text-align-middle text-capitalize">
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
            @else
                @foreach ($datas as $d)
                    <tr class="text-center text-align-middle text-capitalize">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $d->medicine->generic_name }}</td>
                        <td>{{ $d->stock->batch_number }}</td>
                        <td>{{ $d->type }}</td>
                        <td>{{ $d->quantity }}</td>
                        <td>{{ $d->date }}</td>
                    </tr>
                @endforeach
            @endif
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