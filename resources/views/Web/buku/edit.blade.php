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
                <h2 class="card-title"><b>Edit Buku</b></h2>
            </div>
            <div class="card-body">
                <form action="{{route('web::book.update', $data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Title</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title" value="{{$data->title}}" required>
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
                                <input type="text" class="form-control" name="author" value="{{$data->author}}"
                                       required>
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
                            <input type="text" class="form-control" name="edition" value="{{$data->edition}}" required>
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
                                        <th class="text-center">Action</th>
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
                            <label>Total Item</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" name="total_item" value="{{$data->total_item}}"
                                   required>
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
                            <select class="form-control select2bs4 select-language" name="gmd" required>
                                <option value="text" {{$data->gmd == "text" ? 'selected':''}}>Text</option>
                                <option value="art original" {{$data->gmd == "art original" ? 'selected':''}}>Art Original</option>
                                <option value="chart" {{$data->gmd == "chart" ? 'selected':''}}>Chart</option>
                                <option value="computer software" {{$data->gmd == "computer software" ? 'selected':''}}>Computer Software</option>
                            </select>
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
                            <input type="text" class="form-control" name="media_type" value="{{$data->media_type}}"
                                   required>
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
                            <input type="text" class="form-control" name="book_series" value="{{$data->book_series}}"
                                   required>
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
                            <input type="text" class="form-control" name="publisher" value="{{$data->publisher}}"
                                   required>
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
                            <input type="text" class="form-control" name="publishing_year"
                                   value="{{$data->publishing_year}}" required>
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
                            <input type="text" class="form-control" name="publishing_place"
                                   value="{{$data->publishing_place}}" required>
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
                            <input type="text" class="form-control" name="classification"
                                   value="{{$data->classification}}" required>
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
                            <input type="text" class="form-control" name="call_number" value="{{$data->call_number}}"
                                   required>
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
                            <select class="form-control select2bs4 select-language" name="language" required>
                                <option value="indonesia" {{$data->language == "indonesia" ? 'selected' : ''}}>
                                    Indonesia
                                </option>
                                <option value="english" {{$data->language == "indonesia" ? 'english' : ''}}>English
                                </option>
                            </select>
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
                            <input type="text" class="form-control" name="notes" value="{{$data->notes}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <input type="file" class="invisible" name="image" id="image" value="{{$data->image}}"
                                   placeholder="{!! trans('label.image') !!}" accept="image/*">
                            <img id="preview-image"
                                 src="{{ asset(Storage::url($data->image)) }}"
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
                                    <center><a href="{{ asset(\Illuminate\Support\Facades\Storage::url($data->file)) }}"
                                               class="document-url" target="_blank">{{ $data->slug_file }}</a></center>
                                @else
                                    <center><i class="fa fa-5x fa-plus-circle"></i></center>
                                @endif
                                <center><i class="fa fa-5x fa-plus-circle"></i></center>
                            </div>
                        </div>
                        <input type="file" name="file" class="hidden input-document" accept="application/*">
                    </div>
                    <div class="float-sm-right">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>

        <div class="modal fade" id="modal-generator">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form action="{{route('web::book.pattern_book')}}" method="post">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label>Prefix</label>
                                </div>
                                <div class="col-sm-1">
                                    <label>:</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="prefix" id="prefix">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label>Length Serial number</label>
                                </div>
                                <div class="col-sm-1">
                                    <label>:</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="length" id="length">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-1">
                                    <label>Preview</label>
                                </div>
                                <div class="col-sm-1">
                                    <label>:</label>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="code" id="code" readonly>
                                </div>
                            </div>
                            <div class="float-sm-left">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
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
                    for (var i = 1; i < length; i++) {
                        digit = digit + "0";
                    }
                    $('#code').val(prefix + digit);
                }
            });
            $('#length').change(function () {
                length = $('#length').val();
                for (var i = 1; i < length; i++) {
                    digit = digit + "0";
                }
                $('#code').val(prefix + digit);
            });
            $('.select-code').select2({
                allowClear: true,
                theme: 'bootstrap4',
                ajax: {
                    url: '{!! route($route.".getCode") !!}',
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
            $('.select-language').select2({
                allowClear: true,
                theme: 'bootstrap4',
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
