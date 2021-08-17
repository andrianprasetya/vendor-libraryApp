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
                            {{-- <div class="form-group">
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">
                                     Add Author
                                 </button>
                             </div>--}}
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$data->author}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Statement Of Responsibility</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" value="{{$data->SOR}}" readonly>
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
                            <label>specific detail info</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-9">
                    <textarea type="text" class="form-control"
                              readonly>{{$data->SDI}}</textarea>
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
                                    <input class="form-control " value="{{$data->PatternCode->code}}" readonly>
                                </div>
                                <div class="col-md-1">
                                    <label>Total items(s):</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" value="{{$data->total_item}}" readonly>
                                </div>
                                <div class="col-md-1">
                                    <label>Collection Type:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" value="{{$data->collection}}" readonly>
                                </div>
                                <div class="col-md-1">
                                    <label>Location:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" value="{{$data->location}}" readonly>
                                </div>
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
                            <input type="text" class="form-control" value="{{$data->GMD}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Content Type</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$data->content_type}}" readonly>
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
                            <label>Carrier Type</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" value="{{$data->carrier_type}}"  readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Frequency</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" value="{{$data->frequency}}" readonly>
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
                            <input type="text" class="form-control"  value="{{$data->publisher}}" readonly>
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
                            <label>collation</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$data->collation}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>series title</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{$data->series_title}}" readonly>
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
                            <label>Subject</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-9">
                            {{-- <div class="form-group row">
                                 <input type="button" class="btn btn-primary" value="Add Subject(s)">
                             </div>--}}
                            <div class="form-group row">
                                <input type="text" class="form-control" value="{{$data->subject}}" readonly>
                            </div>

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
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>File Attachement</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                         <div class="col-sm-2">
                             <label>Data Biblio Terkait:</label>
                         </div>
                         <div class="col-sm-1">
                             <label>:</label>
                         </div>
                         <div class="col-sm-9">
                             <input type="button" class="btn btn-primary" value="Add Relation">
                         </div>
                     </div>--}}
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
                                    <input type="text" class="form-control" name="length" id="length">
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
    {{--<div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Author</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-1">
                            <label>Nama</label>
                        </div>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>--}}
    <!-- /.modal -->
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
        });
    </script>
@endpush
