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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIS</th>
                        <th>Jenis Kelamin</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>Provinsi</th>
                        <th>Institusi</th>
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
   {{-- <script>
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
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'nis'},
                    {data: 'gender'},
                    {data: 'districts'},
                    {data: 'regency'},
                    {data: 'province'},
                    {data: 'institution'},
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
                    {targets: 8, sortable: true, orderable: true},
                    {targets: 9, orderable: false, searchable: false, width: '10%', className: 'center action'}
                ],
            });
        });
    </script>--}}
@endpush
