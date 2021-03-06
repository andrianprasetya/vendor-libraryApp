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
                <form action="{{route('web::book.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
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
                                <input type="text" class="form-control" name="author" required>
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
                            <input type="text" class="form-control" name="edition" required>
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
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="button" class="btn btn-primary" data-toggle="modal"
                                                   data-target="#modal-generator" value="Add New Pattern">
                                            <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control select2bs4 select-code" name="code" required>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label>Total items(s):</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="total_item" required>
                                </div>
                                <div class="col-md-1">
                                    <label>Collection Type:</label>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control select2bs4" name="collection" required>
                                        <option value="Buku Pelajaran Pokok">Buku Pelajaran Pokok</option>
                                        <option value="Buku Pelajaran Pelengkap">Buku Pelajaran Pelengkap</option>
                                        <option value="Buku Bacaan">Buku Bacaan</option>
                                        <option value="Buku Rujukan">Buku Rujukan</option>
                                        <option value="Terbitan Berkala">Terbitan Berkala</option>
                                        <option value="Pamflet atau Brosur">Pamflet atau Brosur</option>
                                        <option value="Media Pendidikan/Media Instruksional">Media Pendidikan/Media Instruksional</option>
                                        <option value="Multi Media">Multi Media</option>
                                        <option value="Kliping">Kliping</option>
                                        <option value="Dokumen Penting">Dokumen Penting</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <label>Location:</label>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="location" required>
                                        <option>My Library</option>
                                    </select>
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
                            <select class="form-control select2bs4 select-language" name="gmd" required>
                                <option value="text">Text</option>
                                <option value="art original">Art Original</option>
                                <option value="chart">Chart</option>
                                <option value="computer software">Computer Software</option>
                                <option value="Daftar kartu aktivitas">Daftar kartu aktivitas</option>
                                <option value="Karya seni reproduksi">Karya seni reproduksi</option>
                                <option value="Braille">Braille</option>
                                <option value="Bahan kartografi">Bahan kartografi</option>
                                <option value="Carta">Carta</option>
                                <option value="Diorama">Diorama</option>
                                <option value="Sumber elektronik">Sumber elektronik</option>
                                <option value="Filmstrip">Filmstrip</option>
                                <option value="Flashcard">Flashcard</option>
                                <option value="Dolanan">Dolanan</option>
                                <option value="Kit">Kit</option>
                                <option value="Manuskrip">Manuskrip</option>
                                <option value="Bentuk mikro">Bentuk mikro</option>
                                <option value="Slaid mikroskop">Slaid mikroskop</option>
                                <option value="Model">Model</option>
                                <option value="Musik">Musik</option>
                                <option value="Gambar hidup">Gambar hidup</option>
                                <option value="Gambar">Gambar</option>
                                <option value="Realia">Realia</option>
                                <option value="Slaid">Slaid</option>
                                <option value="Rekaman suara">Rekaman suara</option>
                                <option value="Gambar teknik">Gambar teknik</option>
                                <option value="Teks">Teks</option>
                                <option value="Mainan">Mainan</option>
                                <option value="Transparansi">Transparansi</option>
                                <option value="Rekaman video">Rekaman video</option>
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
                            <input type="text" class="form-control" name="media_type" required>
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
                            <input type="text" class="form-control" name="book_series" required>
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
                            <input type="text" class="form-control" name="publisher" required>
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
                            <input type="text" class="form-control" name="publishing_year" required>
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
                            <input type="text" class="form-control" name="publishing_place" required>
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
                            <input type="text" class="form-control" name="classification" required>
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
                            <input type="text" class="form-control" name="call_number" required>
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
                                <option value="indonesia">Indonesia</option>
                                <option value="english">English</option>
                                <option value="sunda">Sunda</option>
                                <option value="arab">Arab</option>
                                <option value="jepang">Jepang</option>
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
                            <input type="text" class="form-control" name="notes" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <input type="file" class="invisible" name="image" id="image"
                                   value="{{ old('image') }}"
                                   placeholder="{!! trans('label.image') !!}" accept="image/*">
                            <img id="preview-image"
                                 style="border-radius: 20%; background-position: center center;background-repeat: no-repeat;cursor: pointer;"
                                 data-src="holder.js/200x200?text=upload gambar"
                                 class="img-responsive ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">File</label>
                        <div class="border-wrapper document-wrapper">
                            <div class="icon-wrapper">
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
        });
    </script>
@endpush
