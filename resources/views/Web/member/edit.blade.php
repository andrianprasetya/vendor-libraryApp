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
                <h2 class="card-title"><b>Edit</b></h2>
            </div>
            <div class="card-body">
                <form action="{{route('web::member.update', $data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>NIS:</label>
                        <input type="text" class="form-control" name="nis" value="{{$data->nis}}" required>
                    </div>
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" name="name" value="{{$data->name}}" required>
                    </div>
                    <div class="form-group">
                        <label>Kelas:</label>
                        <input type="text" class="form-control" name="kelas" value="{{$data->kelas}}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Alamat:</label>
                                <textarea type="text" class="form-control"
                                          placeholder="Jln. Rancamanyar no.11 Rt 05 Rw 03"
                                          name="address" required>{{$data->address}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Provinsi:</label>
                                        <select class="form-control select2bs4 select-province" name="province"
                                                style="width: 100%;">
                                            @foreach($provinces as $key => $province)
                                                <option
                                                    value="{{$province->id}}" {{in_array($province->id, $listSelectedProvince ?: []) ? 'selected': ''}}>
                                                    {{$province->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Kabupaten:</label>
                                        <select class="form-control select2bs4 select-regency" name="regency"
                                                style="width: 100%;">
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
                                                style="width: 100%;">
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
                                        <input type="text" class="form-control" name="code_pos" value="{{$data->code_pos}}" required>
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
                                    <input type="radio" id="radioPrimary1" name="gender" value="L" {{$data->gender == "L" ? 'checked' : ''}}>
                                    <label for="radioPrimary1">
                                        Laki Laki
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="gender" value="P" {{$data->gender == "P" ? 'checked' : ''}}>
                                    <label for="radioPrimary2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir:</label>
                            <input type="date" class="form-control datetimepicker-input"
                                   name="birthday" value="{{$data->birthday}}" required/>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon/Handphone:</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" name="no_telp" value="{{$data->no_telp}}" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>Institusi:</label>
                        <input type="text" class="form-control" name="institution" value="{{$data->institution}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Foto</label>
                        <input type="file" class="invisible" name="image" id="image"
                               value="{{ old('image') }}"
                               placeholder="{!! trans('label.image') !!}" accept="image/*">
                        <img id="preview-image"
                             src="{{ asset(Storage::url($data->image)) }}"
                             style="border-radius: 10%;background-position: center center;background-repeat: no-repeat;cursor: pointer;"
                             @if($isEdit)
                             data-src="holder.js/2=200x200?text=Klik untuk meng-upload gambar"
                             @else
                             data-src="holder.js/400x200?text=Belum ada gambar"
                             @endif
                             width="300"
                             height="300"
                             class="img-responsives">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" value="{{$data->email}}" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="text" class="form-control" name="password" value="{{$data->password}}" required>
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
        });
    </script>
@endpush
