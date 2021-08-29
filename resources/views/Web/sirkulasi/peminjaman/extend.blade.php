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
                <form action="{{route('web::sirkulasi.peminjaman.perpanjangan',$data->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="text" class="form-control" style="display: none" value="{{$data->id}}" name="loan_id">

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" style="display: none" value="{{$data->student->id}}" name="siswa_id">
                            <label>{{$data->student->name}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label>Buku</label>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-9">
                            <label>{{$data->book->title}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label>Code</label>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-9">
                            <label>{{$data->code}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label>Tanggal Peminjaman</label>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-9">
                            <label>{{$data->tgl_peminjaman}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label>Due Date</label>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-9">
                            <input type="date" class="form-control" style="display: none" value="{{$data->deadline}}" name="due_date">
                            <label class="text-danger">{{$data->deadline}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label>Perpanjang</label>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-6">
                            <input type="date" class="form-control" name="extend_time">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>

@endsection
@push('script')
    <script>
        $(function () {
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
