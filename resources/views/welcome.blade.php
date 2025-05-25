<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gestion de eventos</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">




    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>



    <!-- Topbar Start -->
    <div class="container-fluid">

        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">EVENt</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">UM</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar eventos">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                    href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categorias</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Eventos <i
                                    class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="" class="dropdown-item">Matrimonios</a>
                                <a href="" class="dropdown-item">15 años</a>
                                <a href="" class="dropdown-item">Otros</a>
                            </div>
                        </div>
                        <a href="#" class="nav-item nav-link">Conferencias</a>
                        <a href="#" class="nav-item nav-link">Seminarios</a>
                        <a href="#" class="nav-item nav-link">Talleres</a>
                        <a href="#" class="nav-item nav-link">Exposiciones</a>
                        <a href="#" class="nav-item nav-link">Conciertos</a>
                        <a href="#" class="nav-item nav-link">Deportes</a>
                        <a href="#" class="nav-item nav-link">Fiestas</a>
                        <a href="#" class="nav-item nav-link">Ferias</a>
                        <a href="#" class="nav-item nav-link">Teatro</a>

                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">EVEN</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">TUM</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.html" class="nav-item nav-link active">Inicio</a>
                            <a href="shop.html" class="nav-item nav-link">Eventos</a>
                            <a href="detail.html" class="nav-item nav-link">Detalles</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Nosotros <i
                                        class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="cart.html" class="dropdown-item">Ubicacion</a>
                                    <a href="checkout.html" class="dropdown-item">Historia</a>
                                </div>
                            </div>
                            <a href="contact.html" class="nav-item nav-link">Contacto</a>
                            @if (Route::has('login'))

                                @auth
                                    <a href="{{ route('home') }} " class="nav-item nav-link"
                                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                        Inicio
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </a>


                                @endauth

                            @endif
                        </div>

                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">120</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">{{ __('Login') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center mt-2">
                                <a class="btn btn-link"
                                    href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item  active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="{{ Storage::url('imagenes/fiesta1.jpg')}}"
                                style="object-fit: cover;">

                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Gestiona
                                        tus eventos</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet
                                        lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Ver ahora</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item " style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="{{ Storage::url('imagenes/fiesta2.avif')}}"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Ofertas
                                        especiales</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet
                                        lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Ver ahora</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item " style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-3.jpg"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Eventos
                                        para niños</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet
                                        lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Ver ahora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="{{ Storage::url('imagenes/fiesta3.jpeg')}}" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Descuentos del 20%</h6>
                        <h3 class="text-white mb-3">En fiestas para niños</h3>
                        <a href="" class="btn btn-primary">Ver ahora</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="{{ Storage::url('imagenes/fiesta4.jpeg')}}" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Descuentos de 20%</h6>
                        <h3 class="text-white mb-3">En eventos de licenciamientos</h3>
                        <a href="" class="btn btn-primary">Ver ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <!-- Productos de calidad -->
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-cogs text-primary m-0 mr-3"></h1> <!-- Icono de calidad -->
                    <h5 class="font-weight-semi-bold m-0">Productos de calidad</h5>
                </div>
            </div>
            <!-- Grabación Full HD -->
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-video text-primary m-0 mr-2"></h1> <!-- Icono de video o grabación -->
                    <h5 class="font-weight-semi-bold m-0">Grabación Full HD</h5>
                </div>
            </div>
            <!-- Personal capacitado -->
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-users-cog text-primary m-0 mr-3"></h1> <!-- Icono de personal capacitado -->
                    <h5 class="font-weight-semi-bold m-0">Personal capacitado</h5>
                </div>
            </div>
            <!-- Respondemos 24/7 -->
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-headset text-primary m-0 mr-3"></h1> <!-- Icono de atención al cliente -->
                    <h5 class="font-weight-semi-bold m-0">Respondemos 24/7</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured End -->


    <!-- empleados Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title  text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Nuestro personal</span>
        </h2>
        <div class="row px-xl-5">
            @foreach ($users as $user)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img  overflow-hidden">
                            @if($user->imagen != null)
                                <img src="{{ asset('storage/' . $user->imagen) }}" alt="Imagen" class="img-thumbnail w-100">
                            @else
                                <img src="{{ Storage::url('imagenes/perfil.png') }}" alt="Imagen de {{ $user->name }}"
                                    class="img-fluid w-100">
                            @endif

                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="https://wa.me/+1234567890" target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a class="btn btn-outline-dark btn-square" href="https://www.facebook.com/yourprofile"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="btn btn-outline-dark btn-square" href="https://twitter.com/yourprofile"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="btn btn-outline-dark btn-square" href="https://www.instagram.com/yourprofile"
                                    target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>


                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{ $user->name }}
                                {{ $user->apellido_paterno }} {{ $user->apellido_materno }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5> Miembro desde: {{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</h5>


                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-12">
                <nav>
                    <ul class="pagination justify-content-center">
                        <!-- Paginación Anterior -->
                        @if ($users->onFirstPage())
                            <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}">Anterior</a>
                            </li>
                        @endif

                        <!-- Páginas numeradas -->
                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            <li class="page-item {{ ($users->currentPage() == $page) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Paginación Siguiente -->
                        @if ($users->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}">Siguiente</a></li>
                        @else
                            <li class="page-item disabled"><a class="page-link" href="#">Siguiente</a></li>
                        @endif
                    </ul>
                </nav>
            </div>


        </div>
    </div>
    <!-- Products End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title  text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categorias</span></h2>
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="{{ Storage::url('imagenes/inventario1.jpeg')}}" alt="">

                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Camaras</h6>
                            <small class="text-body">100 En almacen</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/cat-2.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Camaras HD</h6>
                            <small class="text-body">100 En almacen</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="{{ Storage::url('imagenes/inventario4.jpg')}}" alt="">

                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Microfonos</h6>
                            <small class="text-body">20 En almacen</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="{{ Storage::url('imagenes/inventario2.jpeg')}}" alt="">

                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Grabadoras</h6>
                            <small class="text-body">15 En almacen</small>
                        </div>
                    </div>
                </a>
            </div>



        </div>
    </div>
    <!-- Categories End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title  text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Nuestro Material de
                trabajo</span></h2>
        <div class="row px-xl-5">
            @foreach ($inventarios as $inventario)

                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img  overflow-hidden">


                            @if($inventario->imagenes->first() != null)
                                <img src="{{ asset('storage/' . $inventario->imagenes->first()->ruta) }}" alt="Imagen"
                                    class="img-thumbnail w-100">
                            @else
                                <img src="{{ Storage::url('imagenes/inventario.jpeg') }}"
                                    alt="Imagen de {{ $inventario->nombre }}" class="img-fluid d-block mx-auto w-90">

                            @endif


                            <div class="product-action">
                                <!-- Botón para ver detalles del producto -->
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-eye"></i></a>

                                <!-- Botón para añadir a lista de deseos o favoritos -->
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-heart"></i></a>

                                <!-- Botón para compartir producto -->
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-share-alt"></i></a>

                                <!-- Botón para ver especificaciones o más información -->
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-info-circle"></i></a>
                            </div>

                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{ $inventario->nombre }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">

                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>
    </div>
    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="{{ Storage::url('imagenes/fiesta2.avif')}}" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Descuentos de 20%</h6>
                        <h3 class="text-white mb-3">Matrimonios</h3>
                        <a href="" class="btn btn-primary">Ver ahora</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="{{ Storage::url('imagenes/fiesta4.jpeg')}}" alt="">

                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Descuentos de 20%</h6>
                        <h3 class="text-white mb-3">Fiestas privadas Offer</h3>
                        <a href="" class="btn btn-primary">Ver ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title  text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Nuestros clientes</span>
        </h2>
        <div class="row px-xl-5">
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img  overflow-hidden">

                        <img class="img-fluid w-100" src="{{ Storage::url('imagenes/about-img-02.jpg')}}" alt="">


                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">Carlos Gutierrez Chambi</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>Excelente servicio, grabaciones unicas</h5>

                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(100)</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img  overflow-hidden">
                        <img class="img-fluid w-100" src="{{ Storage::url('imagenes/about-img-01.jpg')}}" alt="">


                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">Daniela Bustamante Mercado</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>Servicio de calidad, recomiendo esta empresa</h5>

                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star-half-alt text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img  overflow-hidden">
                        <img class="img-fluid w-100" src="{{ Storage::url('imagenes/family-05.jpg')}}" alt="">


                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">Marcela Segovia Martinez</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>Me gustó el servicio, la atencion es personalizada </h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star-half-alt text-primary mr-1"></small>
                            <small class="far fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img  overflow-hidden">
                        <img class="img-fluid w-90" src="{{ Storage::url('imagenes/family-06.jpg')}}" alt="">


                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">Marta Higaderda de la Torre</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>Buenisimas camaras, recomiendo el servicio</h5>

                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="far fa-star text-primary mr-1"></small>
                            <small class="far fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title  text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Empresas con las que
                trabajamos</span>

            <div class="row px-xl-5 mt-5">
                <div class="col">
                    <div class="owl-carousel vendor-carousel">
                        <div class="bg-light p-4">
                            <img src="img/vendor-1.jpg" alt="">
                        </div>
                        <div class="bg-light p-4">
                            <img src="img/vendor-2.jpg" alt="">
                        </div>
                        <div class="bg-light p-4">
                            <img src="img/vendor-3.jpg" alt="">
                        </div>
                        <div class="bg-light p-4">
                            <img src="img/vendor-4.jpg" alt="">
                        </div>
                        <div class="bg-light p-4">
                            <img src="img/vendor-5.jpg" alt="">
                        </div>
                        <div class="bg-light p-4">
                            <img src="img/vendor-6.jpg" alt="">
                        </div>
                        <div class="bg-light p-4">
                            <img src="img/vendor-7.jpg" alt="">
                        </div>
                        <div class="bg-light p-4">
                            <img src="img/vendor-8.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- Vendor End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Contáctanos</h5>
                <p class="mb-4">Nos especializamos en organizar eventos inolvidables para todo tipo de ocasiones. Si
                    tienes alguna consulta o necesitas más información, estamos aquí para ayudarte.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Calle de Eventos, Ciudad, País
                </p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>contacto@empresaeventos.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Navegación rápida</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Organizar
                                Evento</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Galería de
                                Eventos</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Servicios</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Testimonios</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contacto</a>
                        </div>
                    </div>

                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Boletín de Noticias</h5>
                        <p>Recibe las últimas noticias y promociones sobre nuestros eventos organizados. ¡No te pierdas
                            nada!</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tu correo electrónico">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Suscribirse</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Síguenos</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Empresa de Eventos</a>. Todos los derechos reservados.
                    Diseñado por
                    <a class="text-primary" href="https://htmlcodex.com">EventUm</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>


    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var myModal = new bootstrap.Modal(document.getElementById('loginModal'));
            document.getElementById('openModalBtn').addEventListener('click', function () {
                myModal.show();
            });
        });
    </script>

</body>

</html>