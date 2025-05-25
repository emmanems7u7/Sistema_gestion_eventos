@extends('welcome')
@section('content')

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
                        <img class="position-absolute w-100 h-100" src="img/carousel-3.jpg" style="object-fit: cover;">
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
                            <img src="{{ Storage::url('imagenes/inventario.jpeg') }}" alt="Imagen de {{ $inventario->nombre }}"
                                class="img-fluid d-block mx-auto w-90">

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
@endsecion