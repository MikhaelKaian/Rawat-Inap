@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1 class="m-0 text-dark">Data Kamar</h1>
@stop

@section('content')
    <?php
    $params_id = null;

    ?>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahKamarModal" id="createNewKamar">
                    <i class="fa fa-plus">Tambah Data</i>
                </button>
                <hr>
                <table id="table-data" class="table table-bordered">
                    <thead>
                        {{-- tambah data kamar --}}
                        <div class="modal fade" id="tambahKamarModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kamar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="kamarForm" name="kamarForm" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="no_kamar">No Kamar</label>
                                                    <input type="text"class="form-control" name="no_kamar" id="no_kamar"
                                                        required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_kamar">Nama Kamar</label>
                                                    <input type="text"class="form-control" name="nama_kamar"
                                                        id="nama_kamar" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="kelas_kamar">Kelas Kamar</label>
                                                    <select class="form-control" name="kelas_kamar" id="kelas_kamar">
                                                        <option value=""></option>
                                                        <option value="kelas_I">Kelas I</option>
                                                        <option value="kelas_II">Kelas II</option>
                                                        <option value="kelas_III">Kelas III</option>
                                                        <option value="VIP">VIP</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status_kamar">Status</label>
                                                    <select class="form-control" name="status_kamar" id="status_kamar">
                                                        <option value=""></option>
                                                        <option value="terisi">Sudah Terisi</option>
                                                        <option value="kosong">Kosong</option>
                                                    </select>

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
                        </div>
                    </thead>
                </table>
            </div>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>No Kamar</th>
                        <th>Nama Kamar</th>
                        <th>Kelas Kamar</th>
                        <th>Status Kamar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @php

                    $no = 1;
                @endphp
                @foreach ($kamar as $kamars)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $kamars->no_kamar }}</td>
                        <td>{{ $kamars->nama_kamar }}</td>
                        <td>{{ $kamars->kelas_kamar }}</td>
                        <td>{{ $kamars->status_kamar }}</td>
                        <td>{{ $kamars->created_at != "" ? date("Y-m-d",strtotime($kamars->created_at )) : "-"}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btn-edit-kamar"
                                    class="btn btn-success editKamar-{{ $kamars->id_kamar }}"
                                    onclick="updateConfirmation('{{ $kamars->id_kamar }}')" data-toggle="modal"
                                    data-target="#editKamarModal" data-id="{{ $kamars->id_kamar }}"
                                    data-no_kamar="{{ $kamars->no_kamar }}" data-nama_kamar="{{ $kamars->nama_kamar }}"
                                    data-kelas_kamar="{{ $kamars->kelas_kamar }}"
                                    data-status_kamar="{{ $kamars->status_kamar }}" data-created_at="{{ $kamars->created_at }}">
                                    Edit
                                </button>
                                <a type="button" id="btn-hapus-kamar"
                                    class="btn btn-danger hapusKamar-{{ $kamars->id_kamar }}"
                                    onclick="return confirm('Apakah Kamu yakin?')"
                                    href="{{ url('kamar/delete/' . $kamars->id_kamar) }}">
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

    {{-- Edit Modal --}}
    <div class="modal fade" id="editKamarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Kamar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" name="kamarFormUpdate" id="editForm">
                        @csrf
                        @method ('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-no_kamar">No Kamar</label>
                                    <input type="text"class="form-control" name="no_kamar" id="edit-no_kamar"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-nama_kamar">Nama Kamar</label>
                                    <input type="text"class="form-control" name="nama_kamar" id="edit-nama_kamar"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-kelas_kamar">Kelas Kamar</label>
                                    <select name="kelas_kamar" class="form-control" id="edit-kelas_kamar" required>
                                        <option value="kelas_I">Kelas I</option>
                                        <option value="kelas_II">Kelas II</option>
                                        <option value="kelas_III">Kelas III</option>
                                        <option value="VIP">VIP</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit-status_kamar">Status</label>
                                    <select name="status_kamar" class="form-control" id="edit-status_kamar" required>
                                        <option value="terisi">Sudah Terisi</option>
                                        <option value="kosong">Kosong</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="edit-id" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        // create
        $(function() {})

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#kamarForm').serialize(),
                url: "{{ route('kamar.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $('#kamarForm').trigger("reset");
                    $('#tambahKamarModal').modal('hide');
                    table.draw();

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
            location.reload();
        });

        function updateConfirmation(id) {
            $("#edit-no_kamar").val($(".editKamar-" + id).attr("data-no_kamar"))
            $("#edit-nama_kamar").val($(".editKamar-" + id).attr("data-nama_kamar"))
            $("#edit-kelas_kamar").val($(".editKamar-" + id).attr("data-kelas_kamar"))
            $("#edit-status_kamar").val($(".editKamar-" + id).attr("data-status_kamar"))
            $("#editForm").attr("action", "{{ url('kamar/') }}/" + id)
        }
    </script>
@endpush
