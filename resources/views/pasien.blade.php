@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1 class="m-0 text-dark">Data Pasien</h1>
@stop

@section('content')
    <?php
    $params_id = null;

    ?>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPasienModal" id="createNewPasien">
                    <i class="fa fa-plus">Tambah Data</i>
                </button>
                <hr>
                <table id="table-data" class="table table-bordered">
                    <thead>
                        {{-- Tambah Pasien --}}
                        <div class="modal fade" id="tambahPasienModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="pasienForm" name="pasienForm" method="post"
                                            enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nama_pasien">Nama Pasien</label>
                                                    <input type="text"class="form-control" name="nama_pasien"
                                                        id="nama_pasien" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="umur_pasien">Umur Pasien</label>
                                                    <input type="text"class="form-control" name="umur_pasien"
                                                        id="umur_pasien" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="tgl_pasien">Tanggal lahir Pasien</label>
                                                    <input type="date"class="form-control" name="tgl_pasien"
                                                        id="tgl_pasien" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat_pasien">Alamat</label>
                                                    <textarea type="text" class="form-control" id="alamat_pasien" name="alamat_pasien"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_tlp">No Telp Pasien</label>
                                                    <input type="text"class="form-control" name="no_tlp" id="no_tlp"
                                                        required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_kelamin_p">Jenis Kelamin</label>
                                                    <select name="jenis_kelamin_p" class="form-control"
                                                        id="jenis_kelamin_p">
                                                        <option>Pilih Jenis Kelamin....</option>
                                                        <option value="laki-laki">Laki - Laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input type="date"class="form-control" name="tanggal" id="tanggal"
                                                        required />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary" id="saveBtn"
                                                        value="create">Kirim</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </thead>
                </table>
                <table id="table-data" class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>ID Pasien</th>
                            <th>Nama Pasien</th>
                            <th>Umur </th>
                            <th>Tanggal Lahir Pasien </th>
                            <th>Alamat</th>
                            <th>No Telp Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php

                            $no = 1;
                        @endphp
                        @foreach ($pasien as $pasiens)
                            <tr>

                                <td>{{ $pasiens->id_pasien }}</td>
                                <td>{{ $pasiens->nama_pasien }}</td>
                                <td>{{ $pasiens->umur_pasien }}</td>
                                <td>{{ $pasiens->tgl_pasien }}</td>
                                <td>{{ $pasiens->alamat_pasien }}</td>
                                <td>{{ $pasiens->no_tlp }}</td>
                                <td>{{ $pasiens->jenis_kelamin_p }}</td>
                                <td>{{ $pasiens->tanggal }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" id="btn-edit-pasien"
                                    class="btn btn-success editPasien-{{ $pasiens->id_pasien }}"
                                    onclick="updateConfirmation('{{ $pasiens->id_pasien }}')" data-toggle="modal"
                                    data-target="#editPasienModal" data-nama_pasien={{ $pasiens->nama_pasien }}
                                    data-umur_pasien={{ $pasiens->umur_pasien }} data-tgl_pasien={{ $pasiens->tgl_pasien }} data-alamat_pasien={{ $pasiens->alamat_pasien }}
                                    data-no_tlp={{ $pasiens->no_tlp }} data-jenis_kelamin_p={{ $pasiens->jenis_kelamin_p }} data-tanggal={{ $pasiens->tanggal }}>
                                    Edit
                                </button>
                                <a type="button" id="btn-hapus-pasien"
                                    class="btn btn-danger hapusPasien-{{ $pasiens->id_pasien }}"
                                    onclick="return confirm('Are you sure?')"
                                    href="{{ url('pasien/delete/' . $pasiens->id_pasien) }}">
                                    Hapus
                                </a>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div class="modal fade" id="editPasienModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        @method ('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-nama_pasien">Nama</label>
                                    <input type="text" class="form-control" name="nama_pasien" id="edit-nama_pasien"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-umur_pasien">Umur</label>
                                    <input type="text" class="form-control" name="umur" id="edit-umur_pasien"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-tgl_pasien">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal" id="edit-tgl_pasien"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-alamat_pasien">Alamat</label>
                                    <textarea type="text" class="form-control" name="description" id="edit-alamat_pasien" value=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit-no_tlp">No Telp Pasien</label>
                                    <input type="text" class="form-control" name="nomor" id="edit-no_tlp"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-jenis_kelamin_p">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="edit-jenis_kelamin_p" class="form-control">
                                        <option value="">Pilih Jenis Kelamin....</option>
                                        <option value="laki-laki">Laki - Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit-tanggal">Tanggal </label>
                                    <input type="date" class="form-control" name="tanggal" id="edit-tanggal"
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="edit-id" />
                            <input type="hidden" name="old_cover" id="edit-old-cover" />
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
                data: $('#pasienForm').serialize(),
                url: "{{ route('pasien.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $('#pasienForm').trigger("reset");
                    $('#tambahPasienModal').modal('hide');
                    table.draw();

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
            location.reload()
        });

        function updateConfirmation(id) {
            $("#edit-nama_pasien").val($(".editPasien-" + id).attr("data-nama_pasien"))
            $("#edit-umur_pasien").val($(".editPasien-" + id).attr("data-umur_pasien"))
            $("#edit-tgl_pasien").val($(".editPasien-" + id).attr("data-tgl_pasien"))
            $("#edit-alamat_pasien").val($(".editPasien-" + id).attr("data-alamat_pasien"))
            $("#edit-no_tlp").val($(".editPasien-" + id).attr("data-no_tlp"))
            $("#edit-jenis_kelamin_p").val($(".editPasien-" + id).attr("data-jenis_kelamin_p"))
            $("#edit-tanggal").val($(".editPasien-" + id).attr("data-tanggal"))
            $("#editForm").attr("action", "{{ url('pasien/') }}/" + id)
        }
    </script>
@endpush
