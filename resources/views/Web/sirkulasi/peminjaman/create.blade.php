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
                                    <th>Kode</th>
                                    <th>Judul</th>
                                    <th>Waktu Peminjaman</th>
                                    <th>Waktu Kembali</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kode Buku : </label>
                                <input type="text" class="form-control" id="code">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <input type="button" class="btn btn-primary" id="find_book" value="Cari">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="book_id" name="book_id" style="display: none">
                    <input type="text" class="form-control" id="code" name="code" style="display: none">
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

        var count = 0;
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
                var code = $('#code').val();
                $.ajax({
                    url: '{!! route($route.".getDataBook") !!}',
                    dataType: 'json',
                    data: {
                        code: code,
                    },
                    success: function (data) {
                        $('#book_id').val(data.id);
                        $('#code').val(data.code);
                        $('#title').val(data.title);
                        $('#date_loan').val(data.date_loan);
                        $('#deadline').val(data.deadline);

                        $('#peminjaman').show('slow');

                        addRow(data.code, data.title, data.date_loan, data.deadline);
                    }
                });
            });
        });
        function addRow(code, title, date_loan, deadline) {
            var append = "<tr class='tr-book' style='display: none'>" +
                "<td>" +
                "<span readonly type=\"text\" style='width: 100%' >" + code + "</span>" +
                "</td>" +
                "<td>" +
                "<span readonly type=\"text\" style='width: 100%' >" + title + "</span>" +
                "</td>" +
                "<td>" +
                "<span readonly type=\"text\" style='width: 100%'>" + date_loan + "</span>" +
                "</td>" +
                "<td>" +
                "<span readonly type=\"text\" style='width: 100%'>" + deadline + "</span>" +
                "</td>" +
                "<td>" +
                "<a><center><i style=\"color: indianred\" onclick=\"deleteRow(this)\" class=\"far fa-times-circle\"></i></center></a>" +
                "</td>" +
                "</tr>";
            $("#table-body").append(append);
            $(".tr-book").show('slow');

            count++;
        }
        function deleteRow(elem) {
            var row = $(elem).closest("tr");
            var table = $('#peminjaman');
            if (count !== 1) {
                count--;
                row.remove();
            } else {
                row.remove();
                table.hide('slow');
            }
        }
    </script>
@endpush
