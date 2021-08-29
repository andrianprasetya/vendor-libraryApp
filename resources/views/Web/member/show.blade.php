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
                <h2 class="card-title"><b>Detail Anggota</b></h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>NIS:</label>
                    <input type="text" class="form-control" value="{{$data->nis}}" readonly>
                </div>
                <div class="form-group">
                    <label>Nama:</label>
                    <input type="text" class="form-control" value="{{$data->name}}" readonly>
                </div>
                <div class="form-group">
                    <label>Kelas:</label>
                    <input type="text" class="form-control" value="{{$data->kelas}}" readonly>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Alamat:</label>
                            <textarea type="text" class="form-control"
                                      readonly>{{$data->address}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Provinsi:</label>
                                    <input type="text" class="form-control" value="{{$data->province_id}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kabupaten:</label>
                                    <input type="text" class="form-control" value="{{$data->regency_id}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kecamatan:</label>
                                    <input type="text" class="form-control" value="{{$data->district_id}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Kode Pos:</label>
                                    <input type="text" class="form-control" value="{{$data->code_pos}}" readonly>
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
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"
                           value="{{$data->birthday}}" readonly/>
                </div>
                <div class="form-group">
                    <label>No. Telepon/Handphone:</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" value="{{$data->no_telp}}" readonly>
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="form-group">
                    <label>Institusi:</label>
                    <input type="text" class="form-control" value="{{$data->institution}}" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Foto</label>
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
                    <input type="email" class="form-control" value="{{$data->email}}" readonly>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="text" class="form-control" value="{{$data->password}}" readonly>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </section>

@endsection
@push('script')
    <script>
        $(function () {

        });
    </script>
@endpush
