@extends('layouts.template')
@push('style');

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mulai Peminjaman</h1>
                </div>
                <div class="col-sm-6">
                    {!! $breadcrumb !!}
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" id="searchNIS" class="form-control form-control-lg"
                                   placeholder="NIS SISWA">
                            <div class="input-group-append">
                                <button type="submit" id="submitNIS" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style=" margin-top: 30px;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NIS : </label>
                            <input type="text" class="form-control" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama : </label>
                            <input type="text" class="form-control" value="" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Registrasi : </label>
                            <input type="text" class="form-control" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label>Akhir Masa berlaku : </label>
                            <input type="text" class="form-control" value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style=" margin-top: 10px;">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kode Buku : </label>
                            <input type="text" class="form-control" value="" readonly>
                        </div>
                        <div class="float-sm-right">
                            <input type="button" class="btn btn-primary" value="Cari">
                        </div>
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-striped"
                       style="width: 50%; margin-top: 30px; display: none;">
                    <thead>
                    <tr>
                        <th class="d-block d-sm-none">Id</th>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Waktu Peminjaman</th>
                        <th>Waktu Kembali</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>

@endsection
@push('script')
    {{--<script>
        $(function () {
            $('#submitNIS').on('click', function () {
                var NIS = $('#searchNIS').val();
                $.ajax({
                    url: '{!! route($route.".getDataUser") !!}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            id: NIS,
                        };
                    },
                    success: function (data) {
                        console.log(data)
                    }
                });
            });
        });
    </script>--}}
@endpush
