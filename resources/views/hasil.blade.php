@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1 class="m-0 text-dark">Hasil Periksa</h1>
@stop



@section('content')

        @if (\Session::has('success'))
            <div class="alert alert-success">
                {!! \Session::get('success') !!}
            </div>
        @endif

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
                    <div class="row col-md-12">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="id_dokter">Daftar Dokter</label>
                                <select class="form-control" name="id_dokter" id="id_dokter">
                                    <option value="">== Pilih Daftar Dokter ==</option>
                                    @foreach ($dokter as $d)
                                        <option value="{{ $d->id_dokter }}">{{ $d->nama_dokter }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_pasien">Daftar Pasien</label>
                                <select class="form-control" name="id_pasien" id="id_pasien" onchange="fill_kode_pasien()">
                                    <option value="">== Pilih Daftar Pasien ==</option>
                                    @foreach ($pasien as $p)
                                        <option value="{{ $p->id_pasien }}" data-kode_pasien="{{ $p->kode_pasien }}">{{ $p->nama_pasien }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="kode_pasien" id="kode_pasien">
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
                    <div class="row col-md-12">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <select name="keterangan" class="form-control" id="keterangan">
                                            <option value="rawat_inap">Rawat Inap</option>
                                            <option value="pulang">Pulang</option>
                                        </select>
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
        function fill_kode_pasien(){
            $("#kode_pasien").val($("#id_pasien").find(":selected").attr("data-kode_pasien"))
        }

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
    </script>
@endpush
