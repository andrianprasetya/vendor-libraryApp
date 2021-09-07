@extends('layouts.template')

@section('content')
    <section class="content-header">
        @if(session('status'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>
                    <i class="icon fa fa-close"></i> Fail! {{ session('status') }}
                </h4>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    {!! $breadcrumb !!}
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Profile
                    </div>
                    <div class="card-body">
                        <div class="form-group post text-center">
                        <img id="preview-image"
                             src="{{ asset(\Illuminate\Support\Facades\Storage::url($data->image)) }}"
                             style=" background-position: center center;background-repeat: no-repeat;cursor: pointer;"
                             data-src="holder.js/200x200?text=upload gambar"
                             width="250"
                             height="300"
                             class="img-responsive">
                        </div>
                        <div class="form-group post clearfix">
                            <b><i class="fas fa-user-tag"></i> Hak Akses</b>
                            <br>
                            {{$data->roles[0]->name}}
                        </div>
                        <div class="form-group post clearfix">
                            <b><i class="fas fa-user-tag"></i> No Telp</b>
                            <br>
                            {{$data->no_telp}}
                        </div>
                        <div class="form-group post clearfix">
                            <b><i class="fas fa-user-tag"></i> Alamat</b>
                            <br>
                            {{$data->address}}
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <div class="card" >
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama:</label>
                            <input type="text" class="form-control" name="name" value="{{$data->name}}" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Alamat:</label>
                                    <textarea type="text" class="form-control"
                                              placeholder="Jln. Rancamanyar no.11 Rt 05 Rw 03"
                                              name="address" readonly>{{$data->address}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Provinsi:</label>
                                            <select class="form-control select2bs4 select-province" name="province"
                                                    style="width: 100%;" readonly>
                                                @foreach($provinces as $key => $province)
                                                    <option
                                                        value="{{$province->id}}" {{in_array($province->id, $listSelectedProvince ?: []) ? 'selected': ''}}>
                                                        {{empty($province->name)}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Kabupaten:</label>
                                            <select class="form-control select2bs4 select-regency" name="regency"
                                                    style="width: 100%;" readonly>
                                                @foreach($regencies as $key => $regency)
                                                    <option
                                                        value="{{$regency->id}}" {{in_array($regency->id, $listSelectedRegency ?: []) ? 'selected': ''}}>
                                                        {{$regency->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Kecamatan:</label>
                                            <select class="form-control select2bs4 select-district" name="district"
                                                    style="width: 100%;" readonly>
                                                @foreach($districts as $key => $district)
                                                    <option
                                                        value="{{$district->id}}" {{in_array($district->id, $listSelectedDistrict ?: []) ? 'selected': ''}}>
                                                        {{$district->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Kode Pos:</label>
                                            <input type="text" class="form-control" name="code_pos" value="{{$data->code_pos}}" readonly>
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
                                        <input type="radio" id="radioPrimary1" name="gender" value="L" {{$data->gender == "L" ? 'checked' : ''}} readonly>
                                        <label for="radioPrimary1">
                                            Laki Laki
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" name="gender" value="P" {{$data->gender == "P" ? 'checked' : ''}} readonly>
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
                                       name="birthday" value="{{$data->birthday}}" readonly/>
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
                                <input type="text" class="form-control" name="no_telp" value="{{$data->no_telp}}" readonly>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Institusi:</label>
                            <input type="text" class="form-control" name="institution" value="{{$data->institution}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" value="{{$data->email}}" readonly>
                        </div>
                        <input type="button" class="btn btn-primary" data-toggle="modal"
                               data-target="#modal-generator" value="Change Password">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-generator">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form action="{{route('web::member.changePassword',$data->id)}}" method="post">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label>Password Baru</label>
                                </div>
                                <div class="col-sm-1">
                                    <label>:</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label>Konfirmasi Password</label>
                                </div>
                                <div class="col-sm-1">
                                    <label>:</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password">
                                </div>
                            </div>
                            <div class="float-sm-left">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                            <br>
                            <br>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>

@endsection
@push('script')
    <script>

        $(function () {
            var previewApk = document.getElementById('preview-image');
            Holder.run({
                images: [previewApk]
            });

            function previewAttachment(input, image) {
                if (input.files && input.files[0]) {
                    var imageInfo = [];
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(image).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                    var sizeInKB = Math.floor(input.files[0].size / 1024);
                    var size = sizeInKB + ' KB';
                    if (sizeInKB >= 1024) {
                        var sizeInMB = Math.floor(sizeInKB / 1024);
                        size = sizeInMB + ' MB';
                    }
                    imageInfo['name'] = input.files[0].name;
                    imageInfo['size'] = size;
                    return imageInfo;
                }
            }

            var CALL = {
                previewImage: function (input, image) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $(image).attr('src', e.target.result);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                },
            };
            $(document).on('change', '#image', function () {
                CALL.previewImage(this, '#preview-image');
            });
            $(document).on('click', '#preview-image', function () {
                $('#image').click();
            });
            $(document).on('change', '.input-file', function () {
                $('#preview-upload-wrapper').slideDown();
                var imageInfo = previewAttachment(this, '.preview-upload');
                $('.mailbox-attachment-name').html('<i class="fa fa-camera"></i> ' + trimLength(imageInfo['name'], 15));
                $('.mailbox-attachment-size').text(imageInfo['size']);
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
