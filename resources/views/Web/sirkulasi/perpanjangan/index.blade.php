@extends('layouts.template')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Perpanjangan Waktu</h1>
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
                {{--<a href="{{ route($route.'.create') }}" class="btn btn-primary">Tambah Anggota</a>--}}
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped display nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th class="d-block d-sm-none">Id</th>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Judul</th>
                        <th>Nama</th>
                        <th>Waktu Peminjaman</th>
                        <th>Waktu Kembali</th>
                        <th>Extend</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>

@endsection
@push('script')
@endpush
