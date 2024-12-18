@extends('layout.main')
@section('content')
    <div class="row">
        <div class="col-lg-12">

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
                    <h3 class="" style="font-weight: 800">All Comments</h3>

                    <table class="table table-borderless table-hover align-middle shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>ID Komentar</th>
                                <th>User</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr class="table-row align-middle" data-bs-toggle="collapse"
                                    data-bs-target="#accordion-{{ $loop->iteration }}" aria-expanded="false"
                                    aria-controls="accordion-{{ $loop->iteration }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        {{ $item->user->name }}
                                    </td>
                                    <td>
                                        @if ($item->status == 0)
                                            <span class="badge rounded-pill bg-danger">Takedown</span>
                                        @else
                                            <span class="badge rounded-pill bg-success">Live</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-sm btn-outline-primary">Detail</a>
                                    </td>
                                </tr>
                                <tr class="collapse bg-light" id="accordion-{{ $loop->iteration }}">
                                    <td colspan="6">
                                        <div class="p-3">
                                            <div class="d-flex justify-content-between">
                                                <strong>Full Komentar:</strong>
                                                {{ $item->isi_komentar }}
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <strong>Comunity Name:</strong>
                                                {{ $item->komunitas->nama_komunitas ?? 'N/A' }}
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <strong>Username:</strong> {{ $item->user->name }}
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <strong>Created At:</strong> {{ $item->created_at->format('d M Y, H:i') }}
                                            </div>
                                            <div class="d-flex mt-3 justify-content-end">
                                                @if ($item->status == 0)
                                                    <a href="{{ route('komentar.publish', $item->id) }}"
                                                        class="btn btn-sm btn-success mx-1"><i
                                                            class="bi bi-slash-circle"></i> Publish</a>
                                                @else
                                                    <a href="{{ route('komentar.takedown', $item->id) }}"
                                                        class="btn btn-sm btn-warning mx-1"><i class="fa-regular fa-eye-slash me-2"></i>Takedown</a>
                                                @endif
                                                <a href="{{ route('komentar.delete', $item->id) }}" class="btn btn-sm btn-outline-danger mx-1"><i
                                                        class="bi bi-trash"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3 text-muted">
                                        <i class="bi bi-info-circle"></i> There's Nothing to Show
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
@endsection
