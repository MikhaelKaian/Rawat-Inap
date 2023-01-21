@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1 class="m-0 text-dark">Data spesialis</h1>
@stop

@section('content')
    <?php
    $params_id = null;

    ?>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBukuModal" id="createNewSpesialis">
                    <i class="fa fa-plus">Tambah Data</i>
                </button>
                <hr>
                <table id="table-data" class="table table-bordered">
                    <thead>
                        {{-- TAMBAH DATA SPESIALIS --}}
                        <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Spesialis </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="spesialisForm" name="spesialisForm" method="post"
                                            enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nama_spesialis">Nama Spesialis</label>
                                                    <input type="text"class="form-control" name="nama_spesialis"
                                                        id="nama_spesialis" required />
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
                        <th>ID Spesialis</th>
                        <th>Nama Spesialis</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @php

                    $no = 1;
                @endphp
                @foreach ($spesialis as $spesialiss)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $spesialiss->nama_spesialis }}</td>
                        <td>{{ $spesialiss->created_at != "" ? date("Y-m-d",strtotime($spesialiss->created_at )) : "-"}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btn-edit-spesialis"
                                    class="btn btn-success editSpesialis-{{ $spesialiss->id_spesialis }}"
                                    onclick="updateConfirmation('{{ $spesialiss->id_spesialis }}')" data-toggle="modal"
                                    data-target="#editSpesialisModal" data-nama_spesialis="{{ $spesialiss->nama_spesialis }}"
                                    data-created_at="{{ $spesialiss->created_at }}">
                                    Edit
                                </button>
                                <a type="button" id="btn-hapus-spesialis"
                                    class="btn btn-danger hapusSpesialis-{{ $spesialiss->id_spesialis }}"
                                    onclick="return confirm('Are you sure?')"
                                    href="{{ url('spesialis/delete/' . $spesialiss->id_spesialis) }}">
                                    Hapus
                                </a>
                            </div>
                        </td>
                        <tbody>
                @endforeach
                <!-- <tr>


                     </tr> -->
                </tbody>
            </table>
        </div>
    </div>
    </div>

    {{-- EDIT MODAL --}}
    <div class="modal fade" id="editSpesialisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Spesialis</h5>
                    <button type="button" name="btn_edit" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <form method="post" name="spesialisFormUpdate" enctype="multipart/form-data" id="editForm">
                    <div class="modal-body">
                        @csrf
                        @method ('patch')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-nama-spesialis">Nama Spesialis</label>
                                    <input type="text" class="form-control" name="nama_spesialis"
                                        id="edit-nama_spesialis" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id" />
                        <input type="hidden" name="old_cover" id="edit-old-cover" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" id="btn_update">Update</button>
                    </div>
                </form>
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
                data: $('#spesialisForm').serialize(),
                url: "{{ route('spesialis.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#spesialisForm').trigger("reset");
                    $('#tambahBukuModal').modal('hide');
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
            $("#edit-nama_spesialis").val($(".editSpesialis-" + id).attr("data-nama_spesialis"))
            $("#editForm").attr("action", "{{ url('spesialis/') }}/" + id)
        }
    </script>
@endpush
