@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')

@stop

@section('content')

    @if (\Session::has('success'))
        <div class="alert alert-success">
            {!! \Session::get('success') !!}
        </div>
    @endif

    <form id="rawatForm" name="rawatForm" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 border">
                    <div class="form-group">
                        <label for="kode">Cek Kode</label>
                        <select class="form-control" name="kode" id="kode">
                            @foreach ($pasien as $p)
                                <option value="{{ $p->id_pasien }}">{{ $p->kode_pasien }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success mr-auto" id="cek_kode">Cek Kode</button>
                        <button type="button" onClick="window.location.reload()"
                            class="btn btn-outline-success mr-auto">Refresh</button>
                    </div>
                </div>
                <div class="col-9 border">
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
                                    <select class="form-control" name="id_dokter" id="id_dokter">
                                        @foreach ($dokter as $d)
                                            <option value="{{ $d->id_dokter }}">{{ $d->nama_dokter }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="id_kamar">Daftar Kamar</label>
                                    <select class="form-control" name="id_kamar" id="id_kamar">
                                        @foreach ($kamar as $k)
                                            <option value="{{ $k->id_kamar }}">{{ $k->nama_kamar }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lama_inap" id="lama_inap"
                                        placeholder="...... hari" required />
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
                                <input type="date"class="form-control" name="tanggal_inap_selesai"
                                    id="tanggal_inap_selesai" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="mr-auto">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create" data-toggle="modal"
                                data-target="#tambahRawatModal" id="createNewRawat">Simpan
                                Data</button>
                            <button type="select" class="btn btn-outline-primary mr-auto" id="detail">Tampilkan
                                Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid" id="detail_pasien">
            <div class="row">
                <div class="col-3 border">
                    <div class="form-group">
                        <div class="bg-primary p-2 mb-3 text-center">
                            <label for="penulis">Data Pasien</label>
                        </div>
                        <p>Id Pasien :  @foreach ($pasien as $p)
                            <option value="{{ $p->id_pasien }}">{{ $p->id_pasien }} </option>
                        @endforeach </p>
                        <p>Nama Pasien : @foreach ($pasien as $p)
                            <option value="{{ $p->id_pasien }}">{{ $p->nama_pasien }} </option>
                        @endforeach </p>
                        <p>Umur Pasien : @foreach ($pasien as $p)
                            <option value="{{ $p->id_pasien }}">{{ $p->umur_pasien }} </option>
                        @endforeach </p>
                        <p>Tanggal Lahir Pasien : @foreach ($pasien as $p)
                            <option value="{{ $p->id_pasien }}">{{ $p->tgl_pasien }} </option>
                        @endforeach </p>
                        <p>Alamat Pasien : @foreach ($pasien as $p)
                            <option value="{{ $p->id_pasien }}">{{ $p->alamat_pasien }} </option>
                        @endforeach </p>
                        <p>No telp Pasien : @foreach ($pasien as $p)
                            <option value="{{ $p->id_pasien }}">{{ $p->no_tlp }} </option>
                        @endforeach </p>
                        <p>Gender Pasien : @foreach ($pasien as $p)
                            <option value="{{ $p->id_pasien }}">{{ $p->jenis_kelamin_p }} </option>
                        @endforeach </p>
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
                        <p>Keterangan Dokter :</p>
                        <label for="penulis">Pasien ini inap seminggu we lah @foreach ($hasil as $h)
                            <option value="{{ $h->id_hasil }}">{{ $h->keterangan }} </option>
                        @endforeach</label>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        //hide form
        $("#detail").click(function() {
            $("#detail_pasien").toggle();
        });

        $(function() {})

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#rawatForm').serialize(),
                url: "{{ route('rawat.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#rawatForm').trigger("reset");
                    $('#tambahRawatModal').modal('hide');
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
