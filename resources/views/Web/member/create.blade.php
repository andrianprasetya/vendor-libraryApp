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
                        <input type="text" class="form-control {{$errors->has('nis')?'is-invalid':''}}" name="nis">
                        @if($errors->has('nis'))
                            <span
                                class="error invalid-feedback"><strong>{!! $errors->first('nis') !!}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control {{$errors->has('name')?'is-invalid':''}}" name="name">
                        @if($errors->has('name'))
                            <span
                                class="error invalid-feedback"><strong>{!! $errors->first('name') !!}</strong></span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label>Kelas:</label>
                            <select
                                class="form-control select2bs4 select-class {{$errors->has('kelas')?'is-invalid':''}}"
                                name="kelas"
                                style="width: 100%;">
                                @for($i = 1; $i <= 3; $i++){
                                <option value="X IPA {{$i}}">X IPA {{$i}}</option>
                                <option value="X IPS {{$i}}">X IPS {{$i}}</option>
                                <option value="XI IPA {{$i}}">XI IPA {{$i}}</option>
                                <option value="XI IPS {{$i}}">XI IPS {{$i}}</option>
                                <option value="XII IPS {{$i}}">XII IPS {{$i}}</option>
                                }
                                @endfor
                                @for($i = 1; $i <= 2; $i++){
                                <option value="XII IPA {{$i}}">XII IPA {{$i}}</option>
                                }
                                @endfor
                            </select>
                            @if($errors->has('kelas'))
                                <span
                                    class="error invalid-feedback"><strong>{!! $errors->first('kelas') !!}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Alamat:</label>
                                <textarea type="text" class="form-control {{$errors->has('address')?'is-invalid':''}}"
                                          placeholder="Jln. Rancamanyar no.11 Rt 05 Rw 03"
                                          name="address"></textarea>
                                @if($errors->has('address'))
                                    <span
                                        class="error invalid-feedback"><strong>{!! $errors->first('address') !!}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Provinsi:</label>
                                        <select
                                            class="form-control select2bs4 select-province {{$errors->has('province')?'is-invalid':''}}"
                                            name="province"
                                            style="width: 100%;">
                                        </select>
                                        @if($errors->has('province'))
                                            <span
                                                class="error invalid-feedback"><strong>{!! $errors->first('province') !!}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Kabupaten:</label>
                                        <select
                                            class="form-control select2bs4 select-regency {{$errors->has('regency')?'is-invalid':''}}"
                                            name="regency"
                                            style="width: 100%;">
                                        </select>
                                        @if($errors->has('regency'))
                                            <span
                                                class="error invalid-feedback"><strong>{!! $errors->first('regency') !!}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Kecamatan:</label>
                                        <select
                                            class="form-control select2bs4 select-district {{$errors->has('district')?'is-invalid':''}}"
                                            name="district"
                                            style="width: 100%;">
                                        </select>
                                        @if($errors->has('district'))
                                            <span
                                                class="error invalid-feedback"><strong>{!! $errors->first('district') !!}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Kode Pos:</label>
                                        <input type="text"
                                               class="form-control {{$errors->has('code_pos')?'is-invalid':''}}"
                                               name="code_pos">
                                        @if($errors->has('code_pos'))
                                            <span
                                                class="error invalid-feedback"><strong>{!! $errors->first('code_pos') !!}</strong></span>
                                        @endif
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
                            <input type="text"
                                   class="form-control datetimepicker-input {{$errors->has('birthday')?'is-invalid':''}}"
                                   data-target="#reservationdate"
                                   name="birthday"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        @if($errors->has('birthday'))
                            <span
                                class="error invalid-feedback"><strong>{!! $errors->first('birthday') !!}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>No. Telepon/Handphone:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control {{$errors->has('no_telp')?'is-invalid':''}}"
                                   name="no_telp">
                            @if($errors->has('no_telp'))
                                <span
                                    class="error invalid-feedback"><strong>{!! $errors->first('no_telp') !!}</strong></span>
                            @endif
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Institusi:</label>
                        <input type="text" class="form-control {{$errors->has('institution')?'is-invalid':''}}"
                               name="institution">
                        @if($errors->has('institution'))
                            <span
                                class="error invalid-feedback"><strong>{!! $errors->first('institution') !!}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="file" class="invisible" name="image" id="image"
                                       value="{{ old('image') }}"
                                       placeholder="{!! trans('label.image') !!}" accept="image/*">
                                <img id="preview-image"
                                     style="border-radius: 20%; background-position: center center;background-repeat: no-repeat;cursor: pointer;"
                                     data-src="holder.js/200x200?text=upload gambar"
                                     class="img-responsive ">
                                @if($errors->has('image'))
                                    <br>
                                    <span class="text-danger"><strong>{!! $errors->first('image') !!}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control {{$errors->has('email')?'is-invalid':''}}" name="email">
                        @if($errors->has('email'))
                            <span
                                class="error invalid-feedback"><strong>{!! $errors->first('email') !!}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control {{$errors->has('password')?'is-invalid':''}}"
                               name="password">
                        @if($errors->has('password'))
                            <span
                                class="error invalid-feedback"><strong>{!! $errors->first('password') !!}</strong></span>
                        @endif
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
            $('.select-class').select2({
                placeholder: "Pilih Kelas",
                allowClear: true,
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
