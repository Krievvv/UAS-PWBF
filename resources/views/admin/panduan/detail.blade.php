@extends('layout.main')
@section('breadcrumbs', 'Panduan Detail - ' . $panduan->nama_panduan)
@section('content')


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('panduan.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="">Nama Panduan</label>
                                <input type="text" name="nama_panduan" class="form-control" value="{{ $panduan->nama_panduan }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Isi Panduan</label>
                                <textarea name="isi_panduan" class="summernote" id="isi_panduan" value="{!! $panduan->isi_panduan !!}"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <a href="{{ route('panduan.index') }}" class="btn btn-outline">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('custom-plugins')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 500
            });
        });
    </script>
@endsection
