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
    <h1 class="text-center">Data Pasien</h1>
    <p class="text-center">Laporan Data Pasien</p>
    <br/>
    <table id="table-data" class="table table-bordered">
    <thead>
                        <tr class="text-center">
                            <th>ID Pasien</th>
                            <th>Kode Pasien</th>
                            <th>Nama Pasien</th>
                            <th>Umur </th>
                            <th>Tanggal Lahir Pasien </th>
                            <th>Alamat</th>
                            <th>No Telp Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal</th>
                        </tr>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pasien as $pasiens)
                            <tr>
                                <td>{{ $pasiens->id_pasien }}</td>
                                <td>{{ $pasiens->kode_pasien}}</td>
                                <td>{{ $pasiens->nama_pasien }}</td>
                                <td>{{ $pasiens->umur_pasien }}</td>
                                <td>{{ $pasiens->tgl_pasien }}</td>
                                <td>{{ $pasiens->alamat_pasien }}</td>
                                <td>{{ $pasiens->no_tlp }}</td>
                                <td>{{ $pasiens->jenis_kelamin_p }}</td>
                                <td>{{ $pasiens->created_at != "" ? date("Y-m-d",strtotime($pasiens->created_at )) : "-"}}</td>
                            </tr>
                         @endforeach
                    </tbody>
                </thead>
    </body>
</html>
