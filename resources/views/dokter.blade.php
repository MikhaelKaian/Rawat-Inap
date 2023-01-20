@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1 class="m-0 text-dark">Data Dokter</h1>
@stop

@section('content')

    <?php
    $params_id = null;

    ?>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahDokterModal" id="createNewDokter">
                    <i class="fa fa-plus">Tambah Data</i>
                </button>
                <hr>
                <table id="table-data" class="table table-bordered">
                    <thead>
                        {{-- tambah data Dokter --}}
                        <div class="modal fade" id="tambahDokterModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dokter</5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="dokterForm" name="dokterForm" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nama_dokter">Nama Dokter</label>
                                                    <input type="text"class="form-control" name="nama_dokter" id="nama_dokter"
                                                        required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_spesialis">ID Spesialis</label>
                                                        <select class="form-control" name="id_spesialis" id="id_spesialis">
                                                            @foreach ( $spesialis as $s )
                                                            <option value=""></option>
                                                            <option value="{{$s->id_spesialis}}">{{ $s->nama_spesialis }}</option>
                                                        @endforeach
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jam_praktek">Jam Praktek</label>
                                                    <input type="text"class="form-control" name="jam_praktek"
                                                        id="jam_praktek" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_kelamin_d">Jenis Kelamin</label>
                                                    <select class="form-control" name="jenis_kelamin_d" id="jenis_kelamin_d">
                                                        <option value=""></option>
                                                        <option value="laki-laki">Laki-Laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary" id="saveBtn"
                                                    value="create">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </thead>
                </table>
            </div>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>Id Dokter</th>
                        <th>Nama Dokter</th>
                        <th>ID Spesialis</th>
                        <th>Jam Praktek</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @php

                    $no = 1;
                @endphp
                @foreach ($dokter as $dokters)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $dokters->id_dokter }}</td>
                        <td>{{ $dokters->nama_dokter }}</td>
                        <td>{{ $dokters->id_spesialis }}</td>
                        <td>{{ $dokters->jam_praktek }}</td>
                        <td>{{ $dokters->jenis_kelamin_d }}</td>
                        <td>{{ $dokters->fil_created }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btn-edit-dokter"
                                    class="btn btn-success editDokter-{{ $dokters->id_dokter }}"
                                    onclick="updateConfirmation('{{ $dokters->id_dokter }}')" data-toggle="modal"
                                    data-target="#editDokterModal" data-id="{{ $dokters->id_dokter }}"
                                    data-nama_dokter="{{ $dokters->nama_dokter }}"
                                    data-id_spesialis="{{ $dokters->id_spesialis }}"
                                    data-jam_praktek="{{ $dokters->jam_praktek }}"
                                    data-jenis_kelamin_d="{{ $dokters->jenis_kelamin_d }}"
                                    data-fil_created="{{ $dokters->fil_created }}">
                                    Edit
                                </button>
                                <a type="button" id="btn-hapus-dokter"
                                    class="btn btn-danger hapusDokter-{{ $dokters->id_dokter }}"
                                    onclick="return confirm('Apakah Kamu yakin?')"
                                    href="{{ url('dokter/delete/' . $dokters->id_dokter) }}">
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tbody>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Dokter -->
<div class="modal fade" id="editDokterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times; </span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" name="dokterFormUpdate" id="editForm">
                    @csrf
                    @method ('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-nama_dokter">Nama Dokter</label>
                                <input type="text" class="form-control" name="nama_dokter" id="edit-nama_dokter"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="edit-id_spesialis">ID Spesialis</label>
                                    <select class="form-control" name="id_spesialis" id="edit-id_spesialis">
                                        @foreach ( $spesialis as $s )
                                        <option value="{{$s->id_spesialis}}">{{ $s->nama_spesialis }}</option>
                                    @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-jam_praktek">Jam Praktek</label>
                                <input type="year" class="form-control" name="jam_praktek" id="edit-jam_praktek"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="edit-jenis_kelamin_d">Jenis Kelamin</label>
                                <select name="jenis_kelamin_d" class="form-control" id="edit-jenis_kelamin_d">
                                    <option value=""></option>
                                    <option value="laki-laki">Laki - Laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

    @push('js')
    <script>
    //create
    $(function() {})

    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
            data: $('#dokterForm').serialize(),
            url: "{{ route('dokter.store') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
                $('#dokterForm').trigger("reset");
                $('#tambahDokterModal').modal('hide');
                table.draw();
            },
            error: function(data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
        location.reload();
    });

    //update
    function updateConfirmation(id) {
        $("#edit-nama_dokter").val($(".editDokter-" + id).attr("data-nama_dokter"))
        $("#edit-id_spesialis").val($(".editDokter-" + id).attr("data-id_spesialis"))
        $("#edit-jam_praktek").val($(".editDokter-" + id).attr("data-jam_praktek"))
        $("#edit-jenis_kelamin_d").val($(".editDokter-" + id).attr("data-jenis_kelamin_d"))
        $("#editForm").attr("action", "{{ url('dokter/') }}/" + id)
    }
    </script>
    @endpush
