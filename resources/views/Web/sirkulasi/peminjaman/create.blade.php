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
                                <input type="text" class="form-control" id="code_book">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <input type="button" class="btn btn-primary" id="find_book" value="Cari">
                                </div>
                            </div>
                        </div>
                    </div>
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

        var idBook = [];
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
                    },
                    error: function (data) {
                        alert("User Tidak ada");
                    }
                });
            });

            $('#find_book').on('click', function () {
                var code_book = $('#code_book').val();
                $.ajax({
                    url: '{!! route($route.".getDataBook") !!}',
                    dataType: 'json',
                    data: {
                        code: code_book,
                    },
                    success: function (data) {
                        if (data.message == "success") {
                            $('#book_id').val(data.id);
                            $('#code').val(data.code);
                            $('#title').val(data.title);
                            $('#date_loan').val(data.date_loan);
                            $('#deadline').val(data.deadline);

                            $('#peminjaman').show('slow');

                            addRow(data.id, data.code, data.title, data.date_loan, data.deadline);
                        } else {
                            alert("Buku sedang di pinjam");
                        }
                    },
                    error: function (data) {
                        alert("Buku Tidak ada");
                    }
                });
            });
        })
        ;

        function addRow(book_id, code, title, date_loan, deadline) {
            if (idBook.includes(code) == true) {
                alert("Has added");
            } else {
                if (idBook.length == 2) {
                    alert("Loan Can't More add again");
                } else {
                    idBook[count] = code;
                    var append = "<tr class='tr-book' style='display: none'>" +
                        "<td>" +
                        "<input class='form-control hidden_id' type=\"hidden\" style='width: 100%' value='" + book_id + "' name=\"books[" + count + "][id]\">" +
                        "<span readonly type=\"text\" style='width: 100%' >" + code + "</span>" +
                        "<input class='form-control hidden_code' type=\"hidden\" style='width: 100%' value='" + code + "' name=\"books[" + count + "][code]\">" +
                        "</td>" +
                        "<td>" +
                        "<span readonly type=\"text\" style='width: 100%' >" + title + "</span>" +
                        "<input class='form-control hidden_title' type=\"hidden\" style='width: 100%' value='" + title + "' name=\"books[" + count + "][title]\">" +
                        "</td>" +
                        "<td>" +
                        "<span readonly type=\"text\" style='width: 100%'>" + date_loan + "</span>" +
                        "<input class='form-control hidden_date_loan' type=\"hidden\" style='width: 100%' value='" + date_loan + "' name=\"books[" + count + "][date_loan]\">" +
                        "</td>" +
                        "<td>" +
                        "<span readonly type=\"text\" style='width: 100%'>" + deadline + "</span>" +
                        "<input class='form-control hidden_deadline' type=\"hidden\" style='width: 100%' value='" + deadline + "' name=\"books[" + count + "][deadline]\">" +
                        "</td>" +
                        "<td>" +
                        "<a><center><i style=\"color: indianred\" onclick=\"deleteRow(this)\" class=\"far fa-times-circle\"></i></center></a>" +
                        "</td>" +
                        "</tr>";
                    $("#table-body").append(append);
                    $(".tr-book").show('slow');
                    count++;
                }
            }
        }

        function deleteRow(elem) {
            var row = $(elem).closest("tr");
            var code_id = row.find(".hidden_code").val();
            var table = $('#peminjaman');
            var index = idBook.indexOf(code_id);
            idBook.splice(index, 1);
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
