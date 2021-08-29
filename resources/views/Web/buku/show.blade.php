@extends('layouts.template')
<style>
    .border-wrapper {
        border-width: thin;
        border-style: dashed;
        border-radius: 25px;
        margin-bottom: 10px;
    }

    .icon-wrapper {
        padding-top: 25px;
        padding-bottom: 25px;
    }

    .hidden {
        display: none;
    }

    .icon-wrapper {
        padding-top: 25px;
        padding-bottom: 25px;
    }
</style>

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
                        <input type="text" class="form-control" value="{{$data->title}}" readonly>
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
                            <input type="text" class="form-control" value="{{$data->author}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Edition</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$data->edition}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Code :</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <table id="table-code" class="table table-bordered table-striped display nowrap"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th class="d-block d-sm-none">Id</th>
                                    <th>Code</th>
                                    <th>Collection</th>
                                    <th>Location</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>GMD</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$data->gmd}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Media Type</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$data->media_type}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>ISBN/ISSN</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" value="{{$data->book_series}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Publisher</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$data->publisher}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Publishing Year</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" value="{{$data->publishing_year}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Publishing Place</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$data->publishing_place}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Classification</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$data->classification}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Call Number</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$data->call_number}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Language:</label>
                    </div>
                    <div class="col-sm-1">
                        <label>:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$data->language}}" readonly>
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
                        <input type="text" class="form-control" value="{{$data->notes}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <img id="preview-image"
                             src="{{ asset(\Illuminate\Support\Facades\Storage::url($data->image)) }}"
                             style="border-radius: 10%;background-position: center center;background-repeat: no-repeat;cursor: pointer;"
                             @if($isEdit)
                             data-src="holder.js/2=200x200?text=Klik untuk meng-upload gambar"
                             @else
                             data-src="holder.js/200x200?text=Belum ada gambar"
                             @endif
                             width="300"
                             height="300"
                             class="img-responsives">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label">File</label>
                    <div class="border-wrapper document-wrapper">
                        <div class="icon-wrapper">
                            @if ($data->file)
                                <center><a href="{{ asset(\Illuminate\Support\Facades\Storage::url($data->file)) }}" class="document-url" target="_blank">{{ $data->slug_file }}</a></center>
                            @else
                                <center><i class="fa fa-5x fa-plus-circle"></i></center>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
    </section>

@endsection
@push('script')
    <script>
        $(document).on('click', '.document-wrapper', function () {
            $(this).parent().find('.input-document').click();
        });

        $(document).on('change', '.input-document', function (e) {
            let fileName = e.target.files[0].name;
            $(this).parent().find('.icon-wrapper').html(
                '<center><p>' + fileName + '</p></center>'
            );
        });
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

            var prefix = $('#prefix').val();
            var length;
            var digit = "0";

            $('#prefix').change(function () {
                prefix = $('#prefix').val();
                if (length == null) {
                    $('#code').val(prefix);
                } else {
                    for (var i = 0; i < length; i++) {
                        digit = digit + "0";
                    }
                    $('#code').val(prefix + digit);
                }
            });
            $('#length').change(function () {
                length = $('#length').val();
                for (var i = 0; i < length; i++) {
                    digit = digit + "0";
                }
                $('#code').val(prefix + digit);
            });
            $('#table-code').DataTable({
                processing: true,
                scrollY: "100px",
                scrollCollapse: true,
                serverSide: true,
                lengthChange: false,
                fixedColumns: true,
                autoWidth: true,
                fixedHeader: {
                    "header": false,
                    "footer": false
                },
                searching: false,
                ordering: false,
                paging: false,
                info: false,
                responsive: true,
                ajax: {
                    url:'{!! route($route.".datatableCodes") !!}',
                    data: function (data){
                        data.book_id = '{!! $data->id !!}';
                        return data;
                    }
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        width: '5%',
                        visible: false,
                        className: 'center'
                    },
                    {data: 'code'},
                    {data: 'collection'},
                    {data: 'location'}

                ],
                order: [[0, "asc"]],
                columnDefs: [
                    {targets: 0, sortable: false, orderable: false},
                    {targets: 1, sortable: true, orderable: true},
                    {targets: 2, sortable: false, orderable: false},
                    {targets: 3, sortable: false, orderable: false},
                ],
            });
        });
    </script>
@endpush
