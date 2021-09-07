@extends('layouts.template')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buku</h1>
                </div>
                <div class="col-sm-6">
                    {!! $breadcrumb !!}
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><b>pengembalian Buku</b></h2>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="float-sm-right">
                            <form action="{{route('web::sirkulasi.peminjaman.return', $data->id)}}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-success"
                                       value="Kembalikan" {{$data->deadline < \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d') ? 'disabled':''}}>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="button" class="btn btn-danger" data-toggle="modal"
                               data-target="#modal-dendaNominal"
                               value="Denda" {{$data->deadline > \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d') ? 'disabled':''}}>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-dendaNominal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                           href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                           aria-selected="true">Uang</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                           href="#custom-tabs-one-profile" role="tab"
                                           aria-controls="custom-tabs-one-profile" aria-selected="false">Buku</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                         aria-labelledby="custom-tabs-one-home-tab">
                                        <form action="{{route('web::sirkulasi.peminjaman.dendaNominal', $data->id)}}"
                                              method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>NIS</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="nis" id="nis"
                                                           value="{{$data->student->nis}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Nama</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="name" id="name"
                                                           value="{{$data->student->name}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Judul</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="title" id="title"
                                                           value="{{$data->book->title}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Tanggal Peminjaman</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="tgl_pinjam"
                                                           id="tgl_pinjam"
                                                           value="{{$data->tgl_peminjaman}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Tanggal Kembali</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="tgl_kembali"
                                                           id="tgl_kembali"
                                                           value="{{$data->deadline}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Terlambat</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="late" id="late"
                                                           value="{{$days}}"
                                                           readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Denda</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="dendaNominal"
                                                           value="{{$dendaNominal}}"
                                                           id="dendaNominal">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Keterangan</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <textarea class="form-control" name="description"></textarea>
                                                </div>
                                            </div>
                                            <div class="float-sm-left">
                                                <input type="submit" class="btn btn-primary" value="Save">
                                            </div>
                                            <br>
                                            <br>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                         aria-labelledby="custom-tabs-one-profile-tab">
                                        <form action="{{route('web::sirkulasi.peminjaman.dendaBook', $data->id)}}"
                                              method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>NIS</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="nis" id="nis"
                                                           value="{{$data->student->nis}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Nama</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="name" id="name"
                                                           value="{{$data->student->name}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Judul</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="title" id="title"
                                                           value="{{$data->book->title}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Tanggal Peminjaman</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="tgl_pinjam"
                                                           id="tgl_pinjam"
                                                           value="{{$data->tgl_peminjaman}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Tanggal Kembali</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="tgl_kembali"
                                                           id="tgl_kembali"
                                                           value="{{$data->deadline}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Terlambat</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="late" id="late"
                                                           value="{{$days}}"
                                                           readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div style="margin-left: 20px;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="icheck-primary d-inline">
                                                                <input type="radio" id="oldBook" name="jenis_buku"
                                                                       value="old">
                                                                <label for="oldBook">
                                                                    Buku Koleksi
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="icheck-primary d-inline">
                                                                <input type="radio" id="newBook" name="jenis_buku"
                                                                       value="new">
                                                                <label for="newBook">
                                                                    Buku Baru
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="display: none" id="old-book">
                                                <div class="col-sm-3">
                                                    <label>Denda</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <select class="form-control select2bs4 select-book"
                                                            name="dendaBook"
                                                            style="width: 100%;">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="new-book" style="display: none">
                                                <div class="col-sm-3">
                                                    <label>Denda</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <a href="{{ route('web::book.create') }}" class="btn btn-primary">Tambah Buku</a>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>Keterangan</label>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <textarea class="form-control" name="description"></textarea>
                                                </div>
                                            </div>
                                            <div class="float-sm-left">
                                                <input type="submit" class="btn btn-primary" value="Save">
                                            </div>
                                            <br>
                                            <br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('script')
    <script>
        $(function () {
            $('#oldBook').on('click', function () {
                $('#old-book').show('slow');
                $('#new-book').hide('slow');
            });
            $('#newBook').on('click', function () {
                $('#old-book').hide('slow');
                $('#new-book').show('slow');
            });

            $('.select-book').select2({
                placeholder: "Pilih Buku",
                allowClear: true,
                theme: 'bootstrap4',
                ajax: {
                    url: '{!! route($route.".getBook") !!}',
                    datatype: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.text,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush
