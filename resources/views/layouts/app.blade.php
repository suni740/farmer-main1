<!doctype html>
<html lang="en">
{{-- to deoo  --}}
<head>
    <meta charset="UTF-8">
    <title>VeggieStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('asset/css/hero.css') }}">
        <link rel="stylesheet" href="{{ asset('asset/css/nav.css') }}">
        <link rel="stylesheet" href="{{ asset('asset/css/user.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .home-img {
            background: linear-gradient(rgba(0, 0, 0, 0.5),
                    rgba(0, 0, 0, 0.5)), url('https://images.pexels.com/photos/1414651/pexels-photo-1414651.jpeg?cs=srgb&dl=background-bell-pepper-broccoli-1414651.jpg&fm=jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 60vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .home-title {
            text-align: center;
            font-size: 3rem;
            font-weight: bold;
        }

        .contact {
            background-color: #000;
            color: #fff;
            padding: 20px 0;
        }

        .contact h2 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 15px;
        }

        .contact p {
            font-size: 0.85rem;
            color: #ccc;
            margin-bottom: 8px;
        }

        footer {
            background-color: #000;
            color: #fff;
            padding: 10px 0;
            font-size: 0.85rem;
        }

        .navbar-custom {
            background-color: #4CAF50;
        }

        .navbar-custom .navbar-brand {
            color: #fff;
            font-weight: bold;
        }

        .navbar-custom .navbar-brand:hover {
            color: #d4f5d4;
        }

        .navbar-custom .nav-link {
            color: #fff;
            font-weight: 500;
        }

        .navbar-custom .nav-link:hover {
            color: #d4f5d4;
        }

        .navbar-toggler {
            border-color: #fff;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        /* Services Section Styles */
        .services {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .service-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .service-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .service-icon {
            color: #4CAF50;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">VeggieStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth('web')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">Cart</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link" style="border: none; background: none;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                    @auth('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link" style="border: none; background: none;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    
    <main class="py-0">
        @yield('content')
    </main>

    @stack('scripts')
 

</body>

</html>

