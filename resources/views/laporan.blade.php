@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <div class="container-fluid">
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-12 border">
            <div class="form-group">
                <div class="bg-primary p-2 mb-3 text-center">
                    <label for="penulis">Laporan Pasien</label>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="modal-footer">
                            <a href="{{ route('admin.print.pasien') }}" target="_blank"
                                class="btn btn-outline-primary w-100"><i class="fa fa-print"></i>Cetak PDF</a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="modal-footer">
                            <a href="{{ route('admin.export') }}" target="_blank"
                                class="btn btn-outline-primary w-100">Export</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <br>
    <br>
    {{-- periksa --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-4 border">
                <div class="form-group">
                    <div class="bg-danger p-2 mb-3 text-center">
                        <label for="penulis">Laporan Hasil Periksa</label>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="modal-footer">
                                <a href="{{ route('admin.print.hasil') }}" target="_blank"
                                    class="btn btn-outline-danger w-100"><i class="fa fa-print"></i>Cetak PDF</a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="modal-footer">
                                <a href="{{ route('admin.export.hasil') }}" target="_blank"
                                    class="btn btn-outline-danger w-100">Export</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- pembayaran --}}
                    <div class="col-4 border">
                        <div class="form-group">
                            <div class="bg-danger p-2 mb-3 text-center">
                                <label for="pembayaran">Laporan Pembayaran</label>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="modal-footer">
                                        <a href="{{ route('admin.print.pembayaran') }}" target="_blank"
                                            class="btn btn-outline-danger w-100"><i class="fa fa-print"></i>Cetak PDF</a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="modal-footer">
                                        <a href="{{ route('admin.export.pembayaran') }}" target="_blank"
                                            class="btn btn-outline-danger w-100">Export</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
        @endsection
