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
                                       value="Kembalikan" {{$data->deadline < \Carbon\Carbon::now()->format('Y-m-d') ? 'disabled':''}}>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="button" class="btn btn-danger" data-toggle="modal"
                               data-target="#modal-denda"
                               value="Denda" {{$data->deadline > \Carbon\Carbon::now()->format('Y-m-d') ? 'disabled':''}}>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-denda">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form action="{{route('web::sirkulasi.peminjaman.denda', $data->id)}}" method="post">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                                    <input type="text" class="form-control" name="tgl_pinjam" id="tgl_pinjam"
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
                                    <input type="text" class="form-control" name="tgl_kembali" id="tgl_kembali"
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
                                    <input type="text" class="form-control" name="late" id="late" value="{{$diff}}"
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
                                    <input type="text" class="form-control" name="denda" id="denda" value="3000"
                                           readonly>
                                </div>
                            </div>

                            <div class="float-sm-left">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                            <br>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('script')
@endpush
