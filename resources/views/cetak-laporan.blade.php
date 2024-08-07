<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan</title>

    <script>
        window.onload =function(){
            window.print();
            window.onafterprint = function(){
                window.location.href = '/laporan';
            }
        }
    </script>
</head>

<body>

    <div align='center'>
        <h2>Laporan Penjualan</h2>
        <table width='700' border="1" cellpadding='1' cellspacing='0'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Penjaualan</th>
                    <th>Pelanggan</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tgl_penjualan }}</td>
                        <td>{{ $item->pelanggan->namaPelanggan }}</td>
                        <td>{{ $item->total_harga }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
