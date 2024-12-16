@extends('layout.main')
@section('breadcrumbs', $komunitas->nama_komunitas)
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
                    <h3 style="font-weight: 800">Community Details : </h3>

                    <div class="content">
                        <div class="d-flex justify-content-between fw-bold">
                            <p class="text-black">Nama Komunitas :</p>
                            <p>{{ $komunitas->nama_komunitas }}</p>
                        </div>
                        <div class="d-flex flex-column fw-bold">
                            <p class="text-black m-0 p-0">Deskripsi Komunitas :</p>
                            <p>{{ $komunitas->deskripsi_komunitas }}</p>
                        </div>
                        <div class="d-flex justify-content-between fw-bold">
                            <p class="text-black">Dibuat pada tanggal :</p>
                            <p>{{ $komunitas->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center fw-bold">
                            <p class="text-black">Status</p>
                            @if ($komunitas->status == 1)
                                <span class="badge rounded-pill bg-success">Live</span>
                            @else
                                <span class="badge rounded-pill bg-danger">Takedown</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-betnween gap-2 my-3">
                        <a href="" class="btn btn-primary">Edit</a>
                        @if ($komunitas->status == 1)
                            <a href="{{ route('komunitas.takedown', $komunitas->id) }}"
                                class="btn btn-outline-danger"><i class="fa-regular fa-eye-slash me-2"></i>Takedown</a>
                        @else
                            <a href="{{ route('komunitas.publish', $komunitas->id) }}"
                                class="btn btn-outline-success">Publish</a>
                        @endif
                    </div>

                    <h3 class="mt-5" style="font-weight: 800">Joined Users : </h3>
                    <div class="row">
                        @forelse ($usersJoined as $item)
                            <div class="col-4">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="name">
                                                <h5 class="m-0 p-0">{{ $item->user->name }}</h5>
                                                <p class="m-0 p-0">Joined since :
                                                    {{ $komunitas->created_at->format('d M Y') }}</p>
                                            </div>
                                            <div class="action">
                                                <a href="" class="btn btn-sm btn-outline-danger">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <h3 class="text-center text-muted">No Users Joined</h3>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
