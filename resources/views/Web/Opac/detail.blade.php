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
                    <h1>OPAC</h1>
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
                OPAC
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <center>
                            <img id="preview-image"
                                 src="{{ asset(\Illuminate\Support\Facades\Storage::url($data->image)) }}"
                                 style=" background-position: center center;background-repeat: no-repeat;cursor: pointer;"
                                 data-src="holder.js/200x200?text=upload gambar"
                                 class="img-responsive"
                                 width="300"
                                 height="350"
                                 alt="{{$data->title}}">
                        </center>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h1>Bahasa {{$data->language}}</h1>
                        </div>
                        <div class="form-group">
                            <h1>{{$data->author}} - {{$data->publisher}}</h1>
                        </div>
                        <div class="form-group">
                            <h1>{{$data->notes}}</h1>
                        </div>
                    </div>
                </div>
                <table border="1" class="table table-bordered table-striped"
                       style="margin-left: 5%;margin-right: 5%;margin-top: 3%;margin-bottom: 3%; width: 90%">
                    <tr>
                        <td style="padding: 5%;">
                            <div class="form-group">
                                <h2>Jumlah eksemplar : {{$data->total_item}}</h2>
                            </div>
                            <div class="form-group">
                                <h2>GMD : {{$data->gmd}}</h2>
                            </div>
                            <div class="form-group">
                                <h2>Kategori : {{$data->collection}}</h2>
                            </div>
                            <div class="form-group">
                                <h2>Lokasi : {{$data->code_book[0]->location}}</h2>
                            </div>
                        </td>
                    </tr>
                </table>
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


            $('.select-book').select2({
                allowClear: true,
                theme: 'bootstrap4',
                ajax: {
                    url: '{!! route($route.".getBook") !!}',
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
