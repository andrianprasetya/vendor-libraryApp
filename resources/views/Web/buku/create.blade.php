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
                <h2 class="card-title"><b>Buat Buku</b></h2>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Title</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Author:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="button" class="btn btn-primary" value="Add Author(s)">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="author" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Pernyataan Tanggung Jawab :</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="responsibility" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Edisi:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Info detail spesifik:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-9">
                    <textarea type="text" class="form-control"
                              name="address" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Item Code Batch generator:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <input type="button" class="btn btn-primary" value="Add New Pattern">
                                        <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="title" required>
                                    <option>P0000</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label>Total items(s):</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="col-md-1">
                                <label>Collection Type:</label>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="title" required>
                                    <option>Reference</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label>Location:</label>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="title" required>
                                    <option>My Library</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>GMD:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <select class="form-control" name="title" required>
                            <option>Text</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Jenis Konten:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control" name="title" required>
                            <option>Not Set</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Jenis Pembawa:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <select class="form-control" name="title" required>
                            <option>Not Set</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Frekuensi:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <select class="form-control" name="title" required>
                            <option>Not Set</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>ISSBN/ISSN:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Penerbit:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <select class="form-control" name="title" required>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Tahun Terbit:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Tempat Terbit:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <select class="form-control" name="title" required>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Pemeriksaan:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Judul Seri:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control" name="address" required>
                        </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Klasifikasi:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <select class="form-control" name="title" required>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Nomor Panggilan:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Subyek:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group row">
                            <input type="button" class="btn btn-primary" value="Add Subject(s)">
                        </div>
                        <div class="form-group row">
                            <input type="text" class="form-control" name="title" required>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Bahasa:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Abstract/Notes:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Gambar:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>File Attachement:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Data Biblio Terkait:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="button" class="btn btn-primary" value="Add Relation">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </section>

@endsection
@push('script')
    {{-- <script>
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
                     format: 'MM/DD/YYYY hh:mm A'
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
     </script>--}}
@endpush
