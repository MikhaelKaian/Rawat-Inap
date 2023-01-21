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
    <h1 class="text-center">Data Hasil Periksa</h1>
    <p class="text-center">Laporan Data Hasil Periksa</p>
    <br/>
    <table id="table-data" class="table table-bordered">
    <thead>
                        <tr class="text-center">
                            <th>ID Hasil</th>
                            <th>ID Dokter</th>
                            <th>ID Pasien</th>
                            <th>Kode Pasien</th>
                            <th>Alamat</th>
                            <th>Lama Inap</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                        </tr>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($hasil as $hasils)
                            <tr>
                                <td>{{ $hasils->id_hasil }}</td>
                                <td>{{ $hasils->id_dokter}}</td>
                                <td>{{ $hasils->id_pasien}}</td>
                                <td>{{ $hasils->kode_pasien }}</td>
                                <td>{{ $hasils->alamat }}</td>
                                <td>{{ $hasils->lama_inap }}</td>
                                <td>{{ $hasils->keterangan }}</td>
                                <td>{{ $hasils->created_at != "" ? date("Y-m-d",strtotime($hasils->created_at )) : "-"}}</td>
                            </tr>
                         @endforeach
                    </tbody>
                </thead>
    </body>
</html>
