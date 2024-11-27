@extends('layout.main')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Komunitas</h5>
                    <a data-bs-toggle="modal" data-bs-target="#addKomunitas">Add Komunitas</a>
                    <div class="table-responsive" data-simplebar="init">
                        <div class="simplebar-wrapper" style="margin: 0px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                        aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                        <div class="simplebar-content" style="padding: 0px;">
                                            <table class="table table-responsive align-middle mb-0">
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
                                                                <span class="badge bg-success-subtle text-success">Active</span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-warning btn-sm">Takedown</a>
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
                            <div class="simplebar-placeholder" style="width: auto; height: 358px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                        </div>
                    </div>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
