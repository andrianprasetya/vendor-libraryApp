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
            </div>
            <div class="card-body">
                <table id="peminjaman" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="d-block d-sm-none">Id</th>
                        <th>No</th>
                        <th>code</th>
                        <th>title</th>
                        <th>Waktu Peminjaman</th>
                        <th>Waktu Kembali</th>
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
                serverSide: true,
                lengthChange: false,
                fixedColumns: true,
                autoWidth: true,
                fixedHeader: {
                    "header": false,
                    "footer": false
                },
                search:false,
                paging:false,
                info: false,
                responsive: true,
                ajax: '{!! route($route.".datatableDetailMemberReports") !!}',
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        width: '5%',
                        visible: false,
                        className: 'center'
                    },
                    {data: 'no'},
                    {data: 'code'},
                    {data: 'title'},
                    {data: 'date_loan'},
                    {data: 'deadline'},
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
                    {targets: 6, sortable: true, orderable: true ,  className: 'text-center'},
                    {targets: 7, sortable: false, orderable: false, width: '5%', className: 'text-center'}
                ],
            });
        })
    </script>
@endpush
