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
                <a href="{{ route($route.'.create') }}" class="btn btn-primary">Tambah Buku</a>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped display nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th class="d-block d-sm-none">Id</th>
                        <th>No</th>
                        <th>Book Series</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Code</th>
                        <th>Publisher</th>
                        <th>Publishing Year</th>
                        <th>Publishing Place</th>
                        <th>Language</th>
                        <th>Item</th>
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
    <script>
        $(function () {
            /*$("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');*/
            $('#example1').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                lengthChange: false,
                fixedColumns: true,
                autoWidth: true,
                fixedHeader: {
                    "header": false,
                    "footer": false
                },
                searching: true,
                ordering: true,
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
                    {data: 'book_series'},
                    {data: 'title'},
                    {data: 'author'},
                    {data: 'code'},
                    {data: 'publisher'},
                    {data: 'publishing_year'},
                    {data: 'publishing_place'},
                    {data: 'language'},
                    {data: 'total_item'},
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
                    {targets: 9, sortable: true, orderable: true},
                    {targets: 10, sortable: true, orderable: true},
                    {targets: 11, orderable: false, searchable: false, width: '10%', className: 'center action'}
                ],
            });
        });
    </script>
@endpush