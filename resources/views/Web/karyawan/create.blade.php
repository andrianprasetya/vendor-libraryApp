@extends('layouts.template')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Member</h1>
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
                <h2 class="card-title"><b>Buat Anggota</b></h2>
            </div>
            <div class="card-body">
                <form action="{{route('web::member.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>NIS:</label>
                        <input type="text" class="form-control" name="nis" required>
                    </div>
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Alamat:</label>
                                <textarea type="text" class="form-control"
                                          placeholder="Jln. Rancamanyar no.11 Rt 05 Rw 03"
                                          name="address" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Provinsi:</label>
                                        <select class="form-control select2bs4 select-province" name="province"
                                                style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Kabupaten:</label>
                                        <select class="form-control select2bs4 select-regency" name="regency"
                                                style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Kecamatan:</label>
                                        <select class="form-control select2bs4 select-district" name="district"
                                                style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Kode Pos:</label>
                                        <input type="text" class="form-control" name="code_pos" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <label>Jenis Kelamin</label>
                        <div style="margin-left: 20px;">
                            <div class="row">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="gender" value="L" checked>
                                    <label for="radioPrimary1">
                                        Laki Laki
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="gender" value="P">
                                    <label for="radioPrimary2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir:</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"
                                   name="birthday" required/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon/Handphone:</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" name="no_telp" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>Institusi:</label>
                        <input type="text" class="form-control" name="institution" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Foto</label>
                        <input type="file" name="image">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="float-sm-right">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </section>

@endsection
@push('script')
    <script>
        $(function () {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            //Date and time picker
            $('#reservationdatetime').datetimepicker({icons: {time: 'far fa-clock'}});

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY'
                }
            });
            $('.select-regency').on('change', function () {
                $('.select-district').select2({
                    placeholder: "Pilih Kecamatan",
                    allowClear: true,
                    theme: 'bootstrap4',
                    ajax: {
                        url: '{!! route($route.".getDistrict") !!}',
                        datatype: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                id: $('.select-regency').val(),
                                searchTerm: params.term
                            };
                        },
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
            $('.select-province').on('change', function () {
                $('.select-district').val('');
                $('.select-regency').val('');
                $('.select-regency').select2({
                    placeholder: "Pilih Kabupaten",
                    allowClear: true,
                    theme: 'bootstrap4',
                    ajax: {
                        url: '{!! route($route.".getRegency") !!}',
                        datatype: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                id: $('.select-province').val(),
                                searchTerm: params.term
                            };
                        },
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
            $('.select-province').select2({
                placeholder: "Pilih Provinsi",
                allowClear: true,
                theme: 'bootstrap4',
                ajax: {
                    url: '{!! route($route.".getProvince") !!}',
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
