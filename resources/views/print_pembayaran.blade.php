<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 class="text-center">Data Pembayaran</h1>
    <p class="text-center">Laporan Data Pembayaran</p>
    <br/>
    <table id="table-data" class="table table-bordered">
    <thead>
                        <tr class="text-center">
                            <th>ID Pembayaran</th>
                            <th>Jenis Tindakan</th>
                            <th>Biaya Periksa</th>
                            <th>Biaya Rawat </th>
                            <th>Total </th>
                            <th>Tanggal</th>

                        </tr>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pembayaran as $pembayarans)
                            <tr>
                                <td>{{ $pembayarans->id_pembayaran }}</td>
                                <td>{{ $pembayarans->jenis_tindakan}}</td>
                                <td>{{ $pembayarans->biaya_periksa }}</td>
                                <td>{{ $pembayarans->biaya_rawat }}</td>
                                <td>{{ $pembayarans->total }}</td>
                                <td>{{ $pembayarans->created_at != "" ? date("Y-m-d",strtotime($pembayarans->created_at )) : "-"}}</td>
                            </tr>
                         @endforeach
                    </tbody>
                </thead>
    </body>
</html>
