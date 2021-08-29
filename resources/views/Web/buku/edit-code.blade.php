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
                <h2 class="card-title"><b>Edit Code</b></h2>
            </div>
            <div class="card-body">
                <form action="{{route('web::book.update-code', $data->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Collection:</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-5">
                            <select class="form-control select2bs4" name="collection" required>
                                <option value="reference" {{$data->collection == "reference" ? 'selected':''}}>
                                    Reference
                                </option>
                                <option value="textbook" {{$data->collection == "textbook" ? 'selected':''}}>Textbook
                                </option>
                                <option value="fiction" {{$data->collection == "fiction" ? 'selected':''}}>Fiction
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Location</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-5">
                            <select class="form-control" name="location" required>
                                <option>My Library</option>
                            </select>
                        </div>
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

@endpush
