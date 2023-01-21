@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <div class="container-fluid">
        <div class="alert alert-primary text-center" role="alert">
            Rawat Pasien
        </div>
    </div>
@stop

@section('content')

    <div class="alert alert-success" style="display: none" id="alert">

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-3 border">
                <div class="form-group">
                    <label for="kode">Cek Kode</label>
                    <input type="text" name="kode" id="kode" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success mr-auto" id="cek_kode">Cek Kode</button>
                    <button type="button" onClick="window.location.reload()"
                        class="btn btn-outline-success mr-auto">Refresh</button>
                </div>
            </div>
            <div class="col-9 border container_rawat">
                <div class="form-group">
                    <div class="container-fluid" id="tabel">
                        <div class="bg-primary p-2 mb-3 text-center">
                            <label for="rawatForm" name="rawatForm" id="rawatForm">Form Rawat</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="id_dokter">Daftar Dokter</label>
                                <input type="text" name="id_dokter" id="id_dokter" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="id_kamar">Daftar Kamar</label>
                                <select class="form-control" name="id_kamar" id="id_kamar">
                                    @foreach ($kamar as $k)
                                        <option value="{{ $k->id_kamar }}" data-id_kamar="{{ $k->nama_kamar }}">
                                            {{ $k->nama_kamar }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="lama_inap">Lama Inap</label>
                                <input type="text" name="lama_inap" id="lama_inap" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tanggal_inap">Tanggal Inap</label>
                            <input type="date"class="form-control" name="tanggal_inap" id="tanggal_inap" required />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tanggal_inap_selesai">Tanggal Selesai Inap</label>
                            <input type="date"class="form-control" name="tanggal_inap_selesai" id="tanggal_inap_selesai"
                                required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="mr-auto">
                        <button class="btn btn-primary" id="saveBtn">Simpan
                            Data</button>
                        <button type="select" class="btn btn-outline-primary mr-auto" id="detail">Tampilkan
                            Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid container_simpan" id="detail_pasien">
        <div class="row">
            <div class="col-3 border">
                <div class="form-group">
                    <div class="bg-primary p-2 mb-3 text-center">
                        <label for="penulis">Data Pasien</label>
                    </div>
                    <p>Id Pasien : <span id="detail_id_pasien"></span> </p>
                    <p>Nama Pasien : <span id="detail_nama_pasien"></span> </p>
                    <p>Umur Pasien : <span id="detail_umur_pasien"></span> </p>
                    <p>Tanggal Lahir Pasien : <span id="detail_tgl_pasien"></span> </p>
                    <p>Alamat Pasien : <span id="detail_alamat_pasien"></span> </p>
                    <p>Nomor Telpon Pasien : <span id="detail_no_tlp"></span> </p>
                    <p>Gender Pasien : <span id="detail_jenis_kelamin_p"></span> </p>
                </div>
            </div>
            <div class="col-9 border">
                <div class="form-group">
                    <div class="bg-primary p-2 mb-3 text-center">
                        <label for="penulis">Detail Pasien</label>
                    </div>
                    <label for="penulis">Detail Pasien</label>
                    <br>
                    <hr>
                    <p>Keterangan Dokter : <span id="detail_keterangan"></span> </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script>
        var data_pasien = null

        // ajax data pasien
        $(".container_rawat").hide()

        $("#cek_kode").click(function(event) {

            var id_pasien = $('#kode').val();
            $.ajax({
                url: "{{ url('get_pasien') }}/" + id_pasien,
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    data_pasien = data
                    $(".container_rawat").show()
                    $("#lama_inap").val(data.lama_inap)
                    $("#id_kamar").val(data.nama_kamar)
                    $("#id_dokter").val(data.nama_dokter)
                    $("#tanggal_inap").val(data.tanggal)

                    var date_mulai = new Date(data.tanggal)
                    var date_selesai = new Date()
                    date_selesai.setDate(date_mulai.getDate() + data.lama_inap)
                    console.log(date_selesai);
                    data_pasien.tanggal_inap_selesai = moment(date_selesai).format("YYYY-MM-DD")
                    $("#tanggal_inap_selesai").val(moment(date_selesai).format("YYYY-MM-DD"))
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        })

        // hide table
        $(".container_simpan").hide()

        $("#saveBtn").click(function(event) {

            $.ajax({
                data: {
                    _token:"{{ csrf_token() }}",
                    id_pasien: data_pasien.id_pasien,
                    id_dokter: data_pasien.id_dokter,
                    id_kamar:$("#id_kamar").val(),
                    lama_inap: data_pasien.lama_inap,
                    tanggal_inap: data_pasien.tanggal,
                    tanggal_inap_selesai: data_pasien.tanggal_inap_selesai,

                },
                url: "{{ route('rawat.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $("#alert").text(data.message).show()
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        })

        $("#detail").click(function (event) {
            $(".container_simpan").toggle()
            $("#detail_id_pasien").text(data_pasien.id_pasien)
            $("#detail_nama_pasien").text(data_pasien.nama_pasien)
            $("#detail_umur_pasien").text(data_pasien.umur_pasien)
            $("#detail_tgl_pasien").text(data_pasien.tgl_pasien)
            $("#detail_alamat_pasien").text(data_pasien.alamat_pasien)
            $("#detail_no_tlp").text(data_pasien.no_tlp)
            $("#detail_jenis_kelamin_p").text(data_pasien.jenis_kelamin_p)
            $("#detail_keterangan").text(data_pasien.keterangan)

        })

    </script>
@endpush
