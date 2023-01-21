@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <div class="container-fluid">
        <div class="alert alert-primary text-center" role="alert">
            Pembayaran
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
            <div class="col-9 border container_bayar">
                <div class="form-group">
                    <div class="container-fluid" id="tabel">
                        <div class="bg-primary p-2 mb-3 text-center">
                            <label for="bayarForm" name="bayarForm" id="bayarForm">Form Pembayaran</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jenis_tindakan">Jenis Tindakan</label>
                                <select name="jenis_tindakan" class="form-control" id="jenis_tindakan">
                                    <option value=""></option>
                                    <option value="rawat_inap">Rawat Inap</option>
                                    <option value="rawat_jalan">Rawat Jalan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="biaya_periksa">Biaya Periksa</label>
                                <input type="text" name="biaya_periksa" id="biaya_periksa" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="biaya_inap">Biaya Inap (bila dirawat)</label>
                                <input type="text" name="biaya_inap" id="biaya_inap" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text" name="total" id="total" class="form-control" disabled>
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
        <div class="container-fluid container_simpan" id="detail">
            <div class="row">
                <div class="col-3 border">
                    <div class="form-group">
                        <div class="bg-primary p-2 mb-3 text-center">
                            <label for="data_pasien">Data Pasien</label>
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
                            <label for="detail_pasien">Detail Pasien</label>
                        </div>
                        <label for="detail_pasien">Detail Pasien</label>
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
            var pembayaran = null

            // ajax data pasien
            $(".container_bayar").hide()

            $("#cek_kode").click(function(event) {

                var id_pasien = $('#kode').val();
                $.ajax({
                    url: "{{ url('get_pasien') }}/" + id_pasien,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        data_pasien = data
                        $(".container_bayar").show()
                        $("#jenis_tindakan").val(data.jenis_tindakan)
                        $("#biaya_periksa").val(data.biaya_periksa)
                        $("#biaya_rawat").val(data.biaya_rawat)
                        $("#total").val(data.total)
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
                        _token: "{{ csrf_token() }}",
                        jenis_tindakan: $("#jenis_tindakan").val(),
                        biaya_periksa: $("#biaya_periksa").val(),
                        biaya_rawat: $("#biaya_inap").val(),
                        total: $("#total").val(),

                    },
                    url: "{{ route('pembayaran.store') }}",
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

            $("#jenis_tindakan").change(function(event) {
                if ($(this).val() == "rawat_jalan") {
                    $("#biaya_inap").val(0)
                } else {
                    $("#biaya_inap").val(data_pasien.lama_inap * 100000)
                }
            })

            $("#biaya_periksa").change(function(event) {
                var value = $(this).val()
                $("#total").val(parseInt(value) + parseInt($("#biaya_inap").val()))
            })
        </script>
    @endpush
