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
                            <th>ID PEMBAYARAN</th>
                            <th>JENIS TINDAKAN</th>
                            <th>JUMLAH PASIEN TINDAKAN</th>
                            <th>JUMLAH PASIEN INAP</th>
                            <th>TOTAL</th>
                        </tr>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($hasil as $hasils)
                            <tr>
                                <td>{{ $pembayaran->id_pembayaran }}</td>
                                <td>{{ $pembayaran->jenis_tindakan}}</td>
                                <td>{{ $pembayaran->jumlah_p_tindakan}}</td>
                                <td>{{ $pembayaran->jumlah_p_inap }}</td>
                                <td>{{ $pembayaran->total }}</td>
                                
                            </tr>
                         @endforeach
                    </tbody>
                </thead>
    </body>
</html>