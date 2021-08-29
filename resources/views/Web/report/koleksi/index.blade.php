@extends('layouts.template')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Koleksi</h1>
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
                <table id="example1" class="table table-bordered table-striped display nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th class="d-block d-sm-none">Id</th>
                        <th>No</th>
                        <th>Jenis Koleksi</th>
                        <th>Jumlah Judul</th>
                        <th>Jumlah Satuan</th>
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
                ajax: '{!! route($route.".datatableReportCollectiones") !!}',
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        width: '5%',
                        visible: false,
                        className: 'center'
                    },
                    {data: 'no'},
                    {data: 'collection'},
                    {data: 'title_count'},
                    {data: 'satuan_count'},

                ],
                order: [[2, "asc"]],
                columnDefs: [
                    {targets: 0, sortable: false, orderable: false},
                    {targets: 1, sortable: false, orderable: false, width: '5%', className: 'text-center'},
                    {targets: 2, sortable: true, orderable: true},
                    {targets: 3, sortable: false, orderable: false},
                    {targets: 4, sortable: false, orderable: false}
                ],
            });
        });
    </script>
@endpush
