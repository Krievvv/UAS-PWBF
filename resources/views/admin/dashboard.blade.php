@extends('layout.main')
@section('breadcrumbs', 'Dashboard')
@section('content')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Revenue Forecast</h5>
                        </div>
                        <div>
                            <select class="form-select">
                                <option value="1">March 2024</option>
                                <option value="2">April 2024</option>
                                <option value="3">May 2024</option>
                                <option value="4">June 2024</option>
                            </select>
                        </div>
                    </div>
                    <div id="revenue-forecast"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-secondary-subtle">
                                    <iconify-icon icon="solar:football-outline" class="fs-6 text-secondary"> </iconify-icon>
                                </span>
                                <h6 class="mb-0 fs-4">New Customers</h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-6">
                                <h6 class="mb-0 fw-medium">New goals</h6>
                                <h6 class="mb-0 fw-medium">83%</h6>
                            </div>
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="height: 7px;">
                                <div class="progress-bar bg-secondary" style="width: 83%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-6 mb-4">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-danger-subtle">
                                    <iconify-icon icon="solar:box-linear" class="fs-6 text-danger"></iconify-icon>
                                </span>
                                <h6 class="mb-0 fs-4">Total Income</h6>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h4>$680</h4>
                                    <span class="fs-11 text-success fw-semibold">+18%</span>
                                </div>
                                <div class="col-6">
                                    <div id="total-income"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Latest Komunitas</h5>
                    <div class="table-responsive" data-simplebar>
                        <table class="table text-nowrap align-middle table-custom mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-dark fw-normal ps-0">Assigned
                                    </th>
                                    <th scope="col" class="text-dark fw-normal">Progress</th>
                                    <th scope="col" class="text-dark fw-normal">Priority</th>
                                    <th scope="col" class="text-dark fw-normal">Budget</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($komunitas as $item)
                                    <tr>
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center gap-6">
                                                <img src="https://placehold.co/400" alt="prd1" width="48"
                                                    class="rounded" />
                                                <div>
                                                    <h6 class="mb-0">{{ $item->nama_komunitas }}</h6>
                                                    <span>{{ $item->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>73.2%</span>
                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge rounded-pill bg-success">Live</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No data yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Daily activities</h5>
                    </div>
                    <ul class="timeline-widget mb-0 position-relative mb-n5">
                        @forelse ($comments as $item)
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge bg-success flex-shrink-0"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n6 fw-semibold">{{ $item->user->name }} <a
                                        href="{{ route('komunitas.detail', $item->komunitas->id) }}"
                                        class="text-success d-block fw-normal ">{{ Str::limit($item->komunitas->nama_komunitas, 35) }}</a>
                                </div>
                            </li>
                        @empty
                            <h3>No data yet</h3>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
