@extends('layout.main')
@section('breadcrumbs', 'Komunitas')
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

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="m-0 p-0" style="font-weight: 800">Komunitas</h3>
                        <a data-bs-toggle="modal" data-bs-target="#addKomunitas" class="btn btn-outline-success">Add Komunitas</a>
                    </div>
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-dark fw-normal ps-0" style="word-wrap: break-word;">ID - Nama
                                    Komunitas
                                </th>
                                <th scope="col" class="text-dark fw-normal">Created At</th>
                                <th scope="col" class="text-dark fw-normal">Status</th>
                                <th scope="col" class="text-dark fw-normal">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($komunitas as $item)
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center gap-6">
                                            {{ $loop->iteration }}
                                            <div>
                                                <h6 class="mb-0">{{ $item->nama_komunitas }}</h6>
                                                <span>10 Users Joined</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span>{{ $item->created_at }}</span>
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-success-subtle text-success">Live</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Takedown</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('komunitas.detail', $item->id) }}"
                                            class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Nothing to shows : (</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal --}}

    <div class="modal fade" id="addKomunitas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Komunitas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('komunitas.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Komunitas</label>
                            <input type="text" name="nama_komunitas" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi_komunitas" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-2"></i>Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
