@extends('layouts.template')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Peminjaman</h1>
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
                <a href="{{ route($route.'.create') }}" class="btn btn-primary">Pinjam</a>
            </div>
            <div class="card-body">
                <table id="peminjaman" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="d-block d-sm-none">Id</th>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Code</th>
                        <th>Nama</th>
                        <th>Waktu Peminjaman</th>
                        <th>Waktu Kembali</th>
                        <th>Tanggal Kembali</th>
                        <th>Telah Kembali</th>
                        <th>Action</th>
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
    <script>
        $(function () {
            $('#peminjaman').DataTable({
                language: {
                    searchPlaceholder: "Code Book"
                },
                serverSide: true,
                lengthChange: false,
                fixedColumns: true,
                autoWidth: true,
                fixedHeader: {
                    "header": false,
                    "footer": false
                },
                info: false,
                responsive: true,
                ajax: '{!! route($route.".datatables") !!}',
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        width: '5%',
                        visible: false,
                        className: 'center'
                    },
                    {data: 'no'},
                    {data: 'title'},
                    {data: 'code'},
                    {data: 'name'},
                    {data: 'date_loan'},
                    {data: 'deadline'},
                    {data: 'date_return'},
                    {
                        data: 'is_returned',
                        render: function (data) {
                            var icon = '';
                            if (data == true) {
                                icon = 'fas fa-check';
                            }
                            if (data == false) {
                                icon = 'fas fa-times';
                            }
                            return '<i class="  ' + icon + '"></i>';
                        }
                    },
                    {data: 'action'}

                ],
                order: [[0, "asc"]],
                columnDefs: [
                    {targets: 0, sortable: false, orderable: false},
                    {targets: 1, sortable: false, orderable: false, width: '5%', className: 'text-center'},
                    {targets: 2, sortable: true, orderable: true},
                    {targets: 3, sortable: true, orderable: true},
                    {targets: 4, sortable: true, orderable: true},
                    {targets: 5, sortable: true, orderable: true},
                    {targets: 6, sortable: true, orderable: true},
                    {targets: 7, sortable: true, orderable: true},
                    {targets: 8, sortable: true, orderable: true ,  className: 'text-center'},
                    {targets: 9, sortable: false, orderable: false, width: '10%', className: 'text-center'}
                ],
            });
        })
    </script>
@endpush
