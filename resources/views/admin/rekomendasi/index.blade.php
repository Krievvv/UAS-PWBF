@extends('layout.main')
@section('breadcrumbs', 'Rekomendasi Pelayanan')
@section('content')
    <div class="row">
        <div class="col">
            <div class="d-flex mb-3">
                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">New
                    Rekomendasi</a>
            </div>
            <div class="card">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID Rekomendasi</th>
                            <th>Judul Rekomendasi</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @forelse ($rekomendasi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama_rekomendasi }}</td>
                            <td>{{ $item->created_by }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>{{ $item->status }}</td>
                            <td class="d-flex gap-1">
                                <a data-bs-toggle="modal" data-bs-target="#detail{{ $item->id }}" class="btn btn-sm btn-primary">Detail</a>
                                <a href="{{ $item->url_rekomendasi }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
                            </td>
                        </tr>

                        <!-- Detail Rekomendasi Modal -->
                        <div class="modal fade" id="detail{{ $item->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" style="min-width: 70%">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Rekomendasi</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('rekomendasi.store') }}" method="post">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="">Judul Rekomendasi</label>
                                                <input type="text" class="form-control" name="nama_rekomendasi" value="{{ $item->nama_rekomendasi }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="">URL rekomendasi</label>
                                                <input type="text" class="form-control" name="url_rekomendasi" value="{{ $item->url_rekomendasi }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="">Deskripsi Rekomendasi</label>
                                                <textarea class="summernote" name="deskripsi_rekomendasi">{{ $item->deskripsi_rekomendasi }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-2"></i>Save changes</button>
                                            <a href="" class="btn text-danger">Delete</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>


    <!-- New Rekomendasi Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="min-width: 70%">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Rekomendasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('rekomendasi.store') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Judul Rekomendasi</label>
                            <input type="text" class="form-control" name="nama_rekomendasi">
                        </div>
                        <div class="form-group mb-3">
                            <label for=""><i class="fa-solid fa-link"></i> URL rekomendasi</label>
                            <input type="text" class="form-control" name="url_rekomendasi">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Deskripsi Rekomendasi</label>
                            <textarea class="summernote" name="deskripsi_rekomendasi"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-2"></i>Save changes</button>
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
                height: 200
            });
        });
    </script>
@endsection
