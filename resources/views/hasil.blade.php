@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1 class="m-0 text-dark">Hasil Periksa</h1>
@stop

@section('content')
    <?php
    $params_id = null;

    ?>
    <form id="hasilForm" name="hasilForm" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="card card-default">
                <div class="form-group border">
                    <div class="bg-primary p-2 mb-3 text-center">
                        <label for="hasilForm" name="hasilForm" id="hasilForm">Form Hasil Periksa</label>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="daftar_dokter">Daftar Dokter</label>
                                <select class="form-control" name="id_dokter" id="daftar_dokter">
                                    <option value="">== Pilih Daftar Dokter ==</option>
                                    @foreach ($dokter as $d)
                                        <option value="{{ $d->id_dokter }}">{{ $d->nama_dokter }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="daftar_pasien">Daftar Pasien</label>
                                <select class="form-control" name="daftar_pasien" id="daftar_pasien">
                                    <option value="">== Pilih Daftar Pasien ==</option>
                                    @foreach ($pasien as $p)
                                        <option value="{{ $p->id_pasien }}">{{ $p->nama_pasien }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <select class="form-control" name="alamat" id="alamat">
                                    <option value="">== Pilih Alamat Pasien ==</option>
                                    @foreach ($pasien as $p)
                                        <option value="{{ $p->id_pasien }}">{{ $p->alamat_pasien }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tahun">Keterangan</label>
                                        <select name="keterangan" class="form-control" id="keterangan">
                                            <option value="rawat_inap">Rawat Inap</option>
                                            <option value="pulang">Pulang</option>
                                        </select>
                                        <label for="tanggal">Tanggal </label>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal" required />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="lama_inap">Lama Inap</label>
                                        <input type="text" class="form-control" name="lama_inap" id="lama_inap"
                                            placeholder="...... hari" required />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="mr-auto">
                                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create"
                                            data-toggle="modal" data-target="#tambahHasilModal" id="createNewHasil">Simpan
                                            Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
@endsection

@push('js')
    <script>
        //create
        $(function() {})

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#hasilForm').serialize(),
                url: "{{ route('hasil.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#hasilForm').trigger("reset");
                    $('#tambahHasilModal').modal('hide');
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
            location.reload();
        });
    @endpush
