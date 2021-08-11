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
            <form action="{{route('web::sirkulasi.peminjaman.store')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" id="searchNIS" class="form-control form-control-lg"
                                       placeholder="NIS SISWA">
                                <div class="input-group-append">
                                    <button type="button" id="submitNIS" class="btn btn-lg btn-default">
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
                                <input type="text" class="form-control" name="nis" id="nis" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama : </label>
                                <input type="text" class="form-control" name="name" id="name" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Registrasi : </label>
                                <input type="text" class="form-control" name="registered_date" id="registered_date"
                                       readonly>
                            </div>
                            <input type="text" class="form-control" id="siswa_id" name="siswa_id" style="display: none">
                        </div>
                    </div>
                    <div class="row" style=" margin-top: 10px;">
                        <div class="col-md-8">
                            <table id="peminjaman" class="table table-bordered table-striped"
                                   style="display: none;">
                                <thead>
                                <tr>
                                    <th class="d-block d-sm-none">Id</th>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Judul</th>
                                    <th>Waktu Peminjaman</th>
                                    <th>Waktu Kembali</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Book Call Number : </label>
                                <input type="text" class="form-control" id="call_number">
                            </div>
                            <div class="float-sm-right">
                                <input type="button" class="btn btn-primary" id="find_book" value="Cari">
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="book_id" name="book_id" style="display: none">
                    <input type="text" class="form-control" id="book_series" name="book_series" style="display: none">
                    <input type="text" class="form-control" id="title" name="title" style="display: none">
                    <input type="text" class="form-control" id="date_loan" name="date_loan" style="display: none">
                    <input type="text" class="form-control" id="deadline" name="deadline" style="display: none">
                    <div class="form-group">
                        <div class="float-sm-left">
                            <input type="submit" class="btn btn-default" value="Finish Transaction">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>
    </section>

@endsection
@push('script')
    <script>
        $(function () {
            var NIS = "";
            $('#submitNIS').on('click', function () {
                NIS = $('#searchNIS').val();
                $.ajax({
                    url: '{!! route($route.".getDataUser") !!}',
                    dataType: 'json',
                    data: {
                        nis: NIS,
                    },
                    success: function (data) {
                        $('#siswa_id').val(data.id);
                        $('#nis').val(data.nis);
                        $('#name').val(data.name);
                        $('#registered_date').val(data.created_at);
                    }
                });
            });
            $('#find_book').on('click', function () {
                var call_number = $('#call_number').val();
                $.ajax({
                    url: '{!! route($route.".getDataBook") !!}',
                    dataType: 'json',
                    data: {
                        call_number: call_number,
                    },
                    success: function (data) {
                        $('#book_id').val(data.id);
                        $('#book_series').val(data.book_series);
                        $('#title').val(data.title);
                        $('#date_loan').val(data.date_loan);
                        $('#deadline').val(data.deadline);
                    }
                });
                $('#peminjaman').show('slow');
                $('#peminjaman').DataTable({
                    serverSide: true,
                    lengthChange: false,
                    fixedColumns: true,
                    autoWidth: true,
                    fixedHeader: {
                        "header": false,
                        "footer": false
                    },
                    searching: false,
                    ordering: false,
                    info: false,
                    paging: false,
                    responsive: true,
                    ajax: {
                        url: '{!! route($route.".datatableSingle") !!}',
                        data: {
                            call_number: call_number
                        }
                    },
                    columns: [
                        {
                            data: 'id',
                            name: 'id',
                            width: '5%',
                            visible: false,
                            className: 'center'
                        },
                        {data: 'no'},
                        {data: 'book_series'},
                        {data: 'title'},
                        {data: 'date_loan'},
                        {data: 'deadline'},

                    ],
                    order: [[0, "asc"]],
                    columnDefs: [
                        {targets: 0, sortable: false, orderable: false},
                        {targets: 1, sortable: false, orderable: false, width: '5%', className: 'text-center'},
                        {targets: 2, sortable: true, orderable: true},
                        {targets: 3, sortable: true, orderable: true},
                        {targets: 4, sortable: true, orderable: true},
                        {targets: 5, sortable: true, orderable: true}
                    ],
                });
            });
        });
    </script>
@endpush
