<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Growfarm - Website Edukasi Pertanian</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid px-5 d-none d-lg-block">
        <div class="row gx-5 py-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-start">
                    <a href="/" class="navbar-brand ms-lg-5">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">Grow</span>Farm</h1>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-end">
                    @if (Auth::check() && Auth::user()->role_id == 1)
                        <a class="btn btn-primary me-2" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                    @endif
                    @if (!Auth::check())
                        <a class="btn btn-primary me-2" href="/login">Login</a>
                    @else
                        <a class="btn btn-primary me-2"
                            href="{{ route('profile.index', Auth::user()->id) }}">{{ Auth::user()->name }}</a>
                            <a class="btn btn-primary me-2" href="{{ route('logout') }}">logout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
        <a href="index.html" class="navbar-brand d-flex d-lg-none">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">Grow</span>Farm</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="/" class="nav-item nav-link">Home</a>
                <a href="{{ route('komunitas.all') }}" class="nav-item nav-link {{ (request()->is('komunitas/*')) ? 'active' : '' }}">Komunitas</a>
                <a href="{{ route('rekomendasi.user') }}" class="nav-item nav-link {{ (request()->is('rekomendasi/*')) ? 'active' : '' }}">Rekomendasi Pelayanan</a>
                <a href="{{ route('panduan.user') }}" class="nav-item nav-link {{ (request()->is('panduan/*')) ? 'active' : '' }}">Panduan</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 bg-hero mb-5">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-white mb-md-4">Komunitas</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row">
            <!-- Blog list Start -->
            <div class="col-lg-12">
                <div class="row">
                    @forelse ($data as $item)
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ route('komunitas.show', $item->id) }}">
                                        <h4>{{ $item->nama_komunitas }}</h4>
                                        <span class=" fw-bold">{{ $item->created_at }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h1>Nothing to show : (</h1>
                    @endforelse
                    <div class="col-12 mt-5">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-lg justify-content-center m-0">
                                {{-- Previous Page Link --}}
                                @if ($data->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link rounded-0" href="#" aria-label="Previous">
                                            <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link rounded-0" href="{{ $data->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($data->links()->elements[0] as $page => $url)
                                    @if ($page == $data->currentPage())
                                        <li class="page-item active"><a class="page-link"
                                                href="#">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($data->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link rounded-0" href="{{ $data->nextPageUrl() }}"
                                            aria-label="Next">
                                            <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link rounded-0" href="#" aria-label="Next">
                                            <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Blog list End -->

            {{-- <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

            </div>
            <!-- Sidebar End --> --}}
        </div>
    </div>
    <!-- Blog End -->



    <!-- Footer Start -->
    <div class="container-fluid bg-footer bg-primary text-white mt-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">

                        <div class="col-lg col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-white mb-4">Quick Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white mb-2" href="#"><i
                                        class="bi bi-arrow-right text-white me-2"></i>Home</a>
                                <a class="text-white mb-2" href="/"><i
                                        class="bi bi-arrow-right text-white me-2"></i>About Us</a>
                                <a class="text-white mb-2" href="#"><i
                                        class="bi bi-arrow-right text-white me-2"></i>Komunitas</a>
                                <a class="text-white mb-2" href="{{ route('komunitas.all') }}"><i
                                        class="bi bi-arrow-right text-white me-2"></i>Rekomendasi Pelayanan</a>
                                <a class="text-white mb-2" href="#"><i
                                        class="bi bi-arrow-right text-white me-2"></i>Panduan</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <a class="text-secondary fw-bold" href="#">Gr</a>. All Rights
                Reserved. Designed by <a class="text-secondary fw-bold" href="https://htmlcodex.com">HTML Codex</a>
            </p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
