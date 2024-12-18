@extends('layout.main')
@section('breadcrumbs', 'Panduan')
@section('content')


    <div class="row">
        <div class="col">

            @if (session('success'))
                <div class="alert alert-success">
                    <p class="m-0 p-0">{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    <p class="m-0 p-0">{{ session('error') }}</p>
                </div>
            @endif

            <div class="d-flex mb-3">
                <a data-bs-toggle="modal" data-bs-target="#NewPanduan" class="btn btn-primary">Create Panduan</a>
            </div>

            <table class="table table-borderless table-hover">
                <thead>
                    <tr>
                        <th style="width: 10px"></th>
                        <th>ID Panduan</th>
                        <th>Nama Panduan</th>
                        <th>Create By</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($panduan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama_panduan }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('panduan.detail', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                <a href="{{ route('panduan.delete', $item->id) }}" class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No Panduan is available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- New Panduan Modal -->
    <div class="modal fade" id="NewPanduan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Panduan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('panduan.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Nama Panduan</label>
                            <input type="text" name="nama_panduan" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Isi Panduan</label>
                            <textarea name="isi_panduan" class="summernote" id="isi_panduan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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
                height: 400
            });
        });
    </script>
@endsection
