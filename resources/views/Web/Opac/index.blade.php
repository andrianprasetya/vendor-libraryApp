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
                <form action="{{ route('web::opac.index') }}" method="get">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <select class="form-control select2bs4 select-book" name="search_book" required>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn-default btn" id="find_book"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <form action="{{ route('web::opac.index') }}" method="get">
                    <button type="submit" class="btn-danger btn" id="find_book">Reset
                    </button>
                </form>
                <br>
                @foreach($books as $key => $book)
                    @if($key / 4 == 1 || $key == 0 )
                        <div class="row"> @endif
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img id="preview-image"
                                             src="{{ asset(\Illuminate\Support\Facades\Storage::url($book->image)) }}"
                                             style=" background-position: center center;background-repeat: no-repeat;cursor: pointer;"
                                             data-src="holder.js/200x200?text=upload gambar"
                                             width="100"
                                             height="150"
                                             class="img-responsive"
                                             alt="{{$book->title}}">

                                    </div>
                                    <div class="col-md-6" >
                                        <div class="form-group" style="margin: 0pt">
                                            <label style="text-transform: capitalize">{{$book->language}}</label>
                                        </div>
                                        <div class="form-group" style="margin: 0pt">
                                            <label style="text-transform: capitalize">{{$book->author}} - {{$book->publisher}}</label>
                                        </div>
                                        <div class="form-group" style="margin: 0pt">
                                            <label style="text-transform: capitalize">{{$book->notes}}</label>
                                        </div>
                                    </div>
                                    {{--<a href="{{route('web::book.show',$book->id)}}"> Detail</a>--}}
                                </div>
                                <div class="form-group" style="margin: 0pt; margin-top: 10pt">
                                    <label> Jumlah eksemplar : {{$book->total_item}}</label>
                                </div>
                                <div class="form-group" style="margin: 0pt">
                                    <label> GMD : {{$book->gmd}}</label>
                                </div>
                                <div class="form-group" style="margin: 0pt">
                                    <label> Kategori : {{$book->collection}}</label>
                                </div>
                                <div class="form-group">
                                    <label> Lokasi : {{$book->code_book[0]->location}}</label>
                                </div>
                                <div class="form-group">
                                    <div class="border-wrapper document-wrapper">
                                        <div class="icon-wrapper">
                                            @if ($book->file)
                                                <center><a href="{{ asset(\Illuminate\Support\Facades\Storage::url($book->file)) }}" class="document-url" target="_blank">{{ $book->slug_file }}</a></center>
                                            @else
                                                <center>File Tidak Tersedia</center>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($key / 3 == 1)</div>
                        <br>@endif

                @endforeach
            </div>
            <div>{{ $books->links() }}</div>
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
