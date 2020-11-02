@extends('layouts.landing')
@section('content')

<div id="page">
        <!-- Header Section Start -->
        <div class="header-section header-fluid header-left sticky-header section">
            <div class="header-inner">
                <div class="container position-relative">
                    <div class="row justify-content-between align-items-center">

                        <!-- Header Main Menu Start -->
                        @include('includes.menu')
                        <!-- Header Main Menu End -->

                        <!-- Header Logo Start -->
                        <div class="col-xl-2 col-auto">
                            <div class="header-logo">
                                <a href="index.html">
                                    <img class="dark-logo" src="/landing/images/logo/dark-logo.png" alt="Learts Logo">
                                    <img class="light-logo" src="/landing/images/logo/light-logo.png" alt="Learts Logo">
                                </a>
                            </div>
                        </div>
                        <!-- Header Logo End -->

                        <!-- Header Right Start -->
                        <div class="col-xl-5 col-auto">
                            <div class="header-right">
                                <div class="inner">

                                   
                                    <!-- Header Login Start -->
                                    <div class="header-login">
                                        <a href="#" class="d-flex align-items-center"><i class="far fa-user-circle mr-2"></i>Acceso al Sistema</a>
                                    </div>
                                    <!-- Header Login End -->


                                    <!-- Header Mobile Menu Toggle Start -->
                                    <div class="header-mobile-menu-toggle d-xl-none ml-sm-2">
                                        <button class="toggle">
                                            <i class="icon-top"></i>
                                            <i class="icon-middle"></i>
                                            <i class="icon-bottom"></i>
                                        </button>
                                    </div>
                                    <!-- Header Mobile Menu Toggle End -->
                                </div>
                            </div>
                        </div>
                        <!-- Header Right End -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Header Section End -->

        <!-- Slider/Intro Section Start -->
        <div class="intro3-section section section-fluid" data-bg-image="/landing/images/intro/intro3/bg-1.jpg">

            <div class="container">
                <div class="row">

                    <!-- Intro One Content Start -->
                    <div class="col-12" data-aos="fade-up">
                        <div class="intro3-content text-center">
                            <span class="sub-title">Educación 3.0</span>
                            <h1 class="title">Crea tu CampusVirtual</h1>
                            <a href="JavaScript:Void(0);" class="btn btn-light btn-hover-primary"> Video Tutorial <i class="far fa-long-arrow-right ml-3"></i></a>
                        </div>
                    </div>
                    <!-- Intro One Content End -->

                </div>
            </div>

        </div>
        <!-- Slider/Intro Section End -->

        <!-- About Section Start -->
        <div class="about-section section section-padding-top-190 section-padding-bottom" data-bg-color="#f5f5f5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 order-lg-1 order-2">
                        <div class="about-content mt-sm-50 mt-xs-50">
                            <span class="sub-title">Sistema <strong>para emprendedores y universidades</strong></span>
                            <h2 class="title">Centraliza Toda <span>La información</span> en un solo lugar</h2>
                            <p>Sómos la primera plataforma única del Perú en brindarte una plataforma con las necesidades únicas para tu alumnos y estudiantes.</p>
                           
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 order-lg-1 order-1">
                        <div class="about-image">
                            <div class="about-image-one">
                                <img src="/landing/images/about/about01/about1.jpg" alt="about01">
                            </div>
                            <div class="about-image-two">
                                <img src="/landing/images/about/about01/about2.jpg" alt="about02">
                            </div>


                            <!-- Animation Shape Start -->
                            <div class="shape shape-1 scene">
                                <span data-depth="4">shape 1</span>
                            </div>
                            <div class="shape shape-2 scene">
                                <span data-depth="4"><img src="/landing/images/shape-animation/about-shape-1.png" alt=""></span>
                            </div>
                            <div class="shape shape-3 scene">
                                <span data-depth="4"><img src="/landing/images/shape-animation/nwesletter-shape-2.png" alt=""></span>
                            </div>
                            <div class="shape shape-4 scene">
                                <span data-depth="4"><img src="/landing/images/shape-animation/shape-1.png" alt=""></span>
                            </div>
                            <!-- Animation Shape End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Section End -->

        <!-- Funfact Section Start -->
        <div class="funfact-section section" data-bg-color="#f5f5f5">
            <div class="container">
                <!-- Funfact Wrapper Start -->
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        <div class="row row-cols-md-3 row-cols-1 max-mb-n30">

                            <!-- Funfact Start -->
                            <div class="col max-mb-30" data-aos="fade-up">
                                <div class="funfact">
                                    <div class="number"><span class="counter">13.092</span>+</div>
                                    <h6 class="text">Alumnos Registrados</h6>
                                </div>
                            </div>
                            <!-- Funfact End -->

                            <!-- Funfact Start -->
                            <div class="col max-mb-30" data-aos="fade-up">
                                <div class="funfact">
                                    <div class="number"><span class="counter">32</span></div>
                                    <h6 class="text">Centros de estudios</h6>
                                </div>
                            </div>
                            <!-- Funfact End -->

                            <!-- Funfact Start -->
                            <div class="col max-mb-30" data-aos="fade-up">
                                <div class="funfact">
                                    <div class="number"><span class="counter">100</span>%</div>
                                    <h6 class="text">Tasa de satisfacción</h6>
                                </div>
                            </div>
                            <!-- Funfact End -->

                        </div>
                    </div>
                </div>
                <!-- Funfact Wrapper End -->
            </div>
        </div>
        <!-- Funfact Section End -->

        <!-- About Video Section Start -->
        <div class="about-video-section section section-padding-top section-padding-bottom-160" data-bg-color="#f5f5f5">

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <!-- About Me Video Wrapper Start -->
                        <div class="about-me-video-wrapper about-us-one-video pr-55 pr-sm-0 pr-xs-0">

                            <!-- About Me Video Start -->
                            <a href="https://www.youtube.com/watch?v=WJnsrlnid50" class="about-me-video video-popup" data-aos="fade-up">
                                <img class="image" src="/landing/images/video/about-video.jpg" alt="">
                                <img class="icon" src="/landing/images/icons/icon-youtube-play.png" alt="">
                            </a>
                            <!-- About Me Video End -->

                            <!-- Animation Shape Start -->
                            <div class="shape shape-1 scene">
                                <span data-depth="3">
                                    <img src="/landing/images/shape-animation/shape-2.svg" alt="" class="svgInject">
                                </span>
                            </div>
                            <div class="shape shape-2 scene">
                                <span data-depth="-3"><img src="/landing/images/shape-animation/shape-3.png" alt=""></span>
                            </div>
                            <div class="shape shape-3 scene">
                                <span data-depth="4">shape 3</span>
                            </div>
                            <div class="shape shape-4 scene">
                                <span data-depth="4"><img src="/landing/images/shape-animation/shape-1.png" alt=""></span>
                            </div>
                            <!-- Animation Shape End -->

                        </div>
                        <!-- About Me Video Wrapper End -->
                    </div>

                    <div class="col-lg-4">
                        <div class="about-content mt-sm-50 mt-xs-50">
                            <span class="sub-title">COMO TRABAJAMOS</span>
                            <h2 class="title">PROFESIONALES <span>Y PEDAGOGOS</span> al servicio de la educación</h2>
                            <p>Contamos un equipo multi-disciplinario internacional con profesionales en distintas areas de la educación, programación y soporte. </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- About Video Section End -->

        <!-- Testimonial Section Start -->
        <div class="testimonial-section section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="about-content testimonial-content mb-sm-50 mb-xs-50">
                            <span class="sub-title">Testimonios</span>
                            <h2 class="title">Por qué la gente <span>RECOMIENDA</span>?</h2>
                            <p>Por que somos, los primeros en brindar soluciones especificas y ayudar a la contribución digital en la educación.</p>
                          
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <!--Testimonial Slider Start -->
                        <div class="testimonial-slider-vertical swiper-container" data-aos="fade-up">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="testimonial-two testimonial-three" data-bg-color="#f5f5f5">
                                        <div class="content">
                                            <h4 class="title">Alto nivel de eficiencia y métodos de enseñanza científica.</h4>
                                            <p>Estoy feliz con su disposición de lecciones y materias. Reflejan una investigación científica sobre los métodos efectivos que pueden adoptar los alumnos.</p>
                                        </div>
                                        <div class="author-info">
                                            <div class="image">
                                                <img src="/landing/images/testimonial/70/testimonial-1.jpg" alt="">
                                            </div>
                                            <div class="cite">
                                                <h6 class="name">Florence Themes</h6>
                                                <span class="position">/ Multimedia Admin</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="testimonial-two testimonial-three" data-bg-color="#f5f5f5">
                                        <div class="content">
                                            <h4 class="title">Equipo profesional de especialistas y mentores apasionados al alcance </h4>
                                            <p>Necesito obtener una certificación de dominio del inglés y MaxCoach es mi mejor opción. Sus tutores son inteligentes y profesionales cuando tratan con los estudiantes.</p>
                                        </div>
                                        <div class="author-info">
                                            <div class="image">
                                                <img src="/landing/images/testimonial/70/testimonial-2.jpg" alt="">
                                            </div>
                                            <div class="cite">
                                                <h6 class="name">Madley Pondor</h6>
                                                <span class="position">/ IT Specialist</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="testimonial-two testimonial-three" data-bg-color="#f5f5f5">
                                        <div class="content">
                                            <h4 class="title">Recomiendo encarecidamente sus cursos y sistema de enseñanza.</h4>
                                            <p>Estoy feliz con su disposición de lecciones y materias. Reflejan una investigación científica sobre métodos efectivos que pueden adoptar los alumnos..</p>
                                        </div>
                                        <div class="author-info">
                                            <div class="image">
                                                <img src="/landing/images/testimonial/70/testimonial-3.jpg" alt="">
                                            </div>
                                            <div class="cite">
                                                <h6 class="name">Luvic Dubble</h6>
                                                <span class="position">/ Private Tutor</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="testimonial-two testimonial-three" data-bg-color="#f5f5f5">
                                        <div class="content">
                                            <h4 class="title">Es una opción de calidad para personas que necesitan programas de estudios especializados.</h4>
                                            <p>Soy una persona muy estricta, por lo que necesito que todo esté organizado y ordenado. Entonces, podré hacer las cosas bien y brillar. Los chicos de MaxCoach me acaban de atrapar.</p>
                                        </div>
                                        <div class="author-info">
                                            <div class="image">
                                                <img src="/landing/images/testimonial/70/testimonial-4.jpg" alt="">
                                            </div>
                                            <div class="cite">
                                                <h6 class="name">Florence Themes</h6>
                                                <span class="position">/ Multimedia Admin</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <!--Testimonial Slider End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial Section End -->

        <!-- Team Section Start -->
        <div class="team-section section section-padding-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <!-- Team Image Wrapper Start -->
                        <div class="team-image-wrap">

                            <div class="team-image">
                                <img src="/landing/images/team/home-3-team-image.png" alt="team">
                            </div>

                            <!-- Animation Shape Start -->
                            <div class="shape shape-1 scene">
                                <span data-depth="3">
                                    <img src="/landing/images/shape-animation/shape-2.svg" alt="" class="svgInject">
                                </span>
                            </div>
                            <div class="shape shape-2 scene">
                                <span data-depth="-3"><img src="/landing/images/shape-animation/shape-3.png" alt=""></span>
                            </div>
                            <div class="shape shape-3 scene">
                                <span data-depth="4">shape 3</span>
                            </div>
                            <div class="shape shape-4 scene">
                                <span data-depth="4"><img src="/landing/images/shape-animation/shape-1.png" alt=""></span>
                            </div>
                            <div class="shape shape-5 scene">
                                <span data-depth="5"><img src="/landing/images/shape-animation/cta-shape-01.png" alt=""></span>
                            </div>
                            <!-- Animation Shape End -->

                        </div>
                        <!-- About Me Video Wrapper End -->
                    </div>
                    <div class="col-lg-5">
                        <div class="about-content team-content mt-sm-50 mt-xs-50">
                            <span class="sub-title">Todo en <strong>CampusVirtual</strong></span>
                            <h2 class="title">Nosotros estamos aqui para <span>Transformar</span>!</h2>
                            <p>Como estudiantes, las personas pueden disfrutar de la gran compañía de los mentores y educadores de MaxCoach. Podemos ayudarlo a desarrollarse y crecer al máximo. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team Section End -->



        <div class="footer-section section">
            <div class="container">

                <!-- Footer Top Widgets Start -->
                <div class="row">

                    <!-- Footer Widget Start -->
                    <div class="col-xl-6 col-md-5 col-12 max-mb-50">
                        <div class="footer-widget">
                            <h4 class="footer-widget-title">Address</h4>
                            <div class="footer-widget-content">
                                <div class="content">
                                    <p>Miraflores - Lima - Perú</p>
                                    <p>+51 995931635 (9am - 5pm EST, Lunes - Viernes) </p>
                                    <p><a href="#">info@campusvirtual.edu.pe </a></p>
                                </div>
                                <div class="footer-social-inline">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget End -->

                    <!-- Footer Widget Start -->
                    <div class="col-xl-3 col-md-4 col-sm-7 col-12 max-mb-50">
                        <div class="footer-widget">
                            <h4 class="footer-widget-title">Explore</h4>
                            <div class="footer-widget-content">
                                <ul class="column-2">
                                    <li><a href="#">Como empezar</a></li>
                                    <li><a href="#">Socios</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Cursos</a></li>
                                    <li><a href="#">Nosotros</a></li>
                                    <li><a href="#">Contacto</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget End -->

                    <!-- Footer Widget Start -->
                    <div class="col-xl-3 col-md-3 col-sm-5 col-12 max-mb-50">
                        <div class="footer-widget">
                            <h4 class="footer-widget-title">Information</h4>
                            <div class="footer-widget-content">
                                <ul>
                                    <li><a href="#">Precios</a></li>
                                    <li><a href="#">Beneficios</a></li>
                                    <li><a href="#">Política de privacidad</a></li>
                                    <li><a href="#">Términos de servicio</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget End -->

                </div>
                <!-- Footer Top Widgets End -->
                @include('includes.footer')

            </div>
        </div>


        <!-- Scroll Top Start -->
        <a href="#" class="scroll-top" id="scroll-top">
            <i class="arrow-top fal fa-long-arrow-up"></i>
            <i class="arrow-bottom fal fa-long-arrow-up"></i>
        </a>
        <!-- Scroll Top End -->
    </div>

    <div id="site-main-mobile-menu" class="site-main-mobile-menu">
        <div class="site-main-mobile-menu-inner">
            <div class="mobile-menu-header">
                <div class="mobile-menu-logo">
                    <a href="index.html"><img src="/landing/images/logo/dark-logo.png" alt=""></a>
                </div>
                <div class="mobile-menu-close">
                    <button class="toggle">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-menu-content">
                <nav class="site-mobile-menu">
                    <ul>
                        <li class="has-children position-static">
                            <a href="/"><span class="menu-text">Inicio</span></a>
                            
                        </li>
                        <li class="has-children">
                            <a href="#"><span class="menu-text">Nosotros</span></a>
                            
                        </li>
                        <li class="has-children">
                            <a href="#"><span class="menu-text">Courses</span></a>
                            <span class="menu-toggle"><i class="far fa-angle-down"></i></span>
                            <ul class="sub-menu">
                                <li><a href="courses-grid-1.html"><span class="menu-text">Courses Grid 01</span></a></li>
                                <li><a href="courses-grid-2.html"><span class="menu-text">Courses Grid 02</span></a></li>
                                <li><a href="courses-grid-3.html"><span class="menu-text">Courses Grid 03</span></a></li>
                                <li><a href="membership-levels.html"><span class="menu-text">Membership Levels</span></a></li>
                                <li><a href="become-a-teacher.html"><span class="menu-text">Become a Teacher</span></a></li>
                                <li><a href="profile.html"><span class="menu-text">Profile</span></a></li>
                                <li><a href="checkout.html"><span class="menu-text">Checkout</span></a></li>
                                <li class="has-children">
                                    <a href="course-details-sticky-feature-bar.html"><span class="menu-text">Single Layout</span></a>
                                    <span class="menu-toggle"><i class="far fa-angle-down"></i></span>
                                    <ul class="sub-menu">
                                        <li><a href="course-details-free.html"><span class="menu-text">Free Course</span></a></li>
                                        <li><a href="course-details-sticky-feature-bar.html"><span class="menu-text">Sticky Features Bar</span></a></li>
                                        <li><a href="course-details-standard-sidebar.html"><span class="menu-text">Standard Sidebar</span></a></li>
                                        <li><a href="course-details-no-sidebar.html"><span class="menu-text">No Sidebar</span></a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#"><span class="menu-text">Event</span></a>
                            <span class="menu-toggle"><i class="far fa-angle-down"></i></span>
                            <ul class="sub-menu">
                                <li><a href="event.html"><span class="menu-text">Event</span></a></li>
                                <li><a href="zoom-meetings.html"><span class="menu-text">Zoom Meetings</span></a></li>
                                <li><a href="event-details.html"><span class="menu-text">Event Details</span></a></li>
                                <li><a href="zoom-event-details.html"><span class="menu-text">Zoom Meeting Details</span></a></li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#"><span class="menu-text">Blog</span></a>
                            <span class="menu-toggle"><i class="far fa-angle-down"></i></span>
                            <ul class="sub-menu">
                                <li><a href="blog-grid.html"><span class="menu-text">Blog Grid</span></a></li>
                                <li><a href="blog-masonry.html"><span class="menu-text">Blog Masonry</span></a></li>
                                <li><a href="blog-classic.html"><span class="menu-text">Blog Classic</span></a></li>
                                <li><a href="blog-list.html"><span class="menu-text">Blog List</span></a></li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#"><span class="menu-text">Shop</span></a>
                            <span class="menu-toggle"><i class="far fa-angle-down"></i></span>
                            <ul class="sub-menu">
                                <li><a href="shop.html"><span class="menu-text">Shop Left Sidebar</span></a></li>
                                <li><a href="shop-right-sidebar.html"><span class="menu-text">Shop Right Sidebar</span></a></li>
                                <li><a href="shopping-cart.html"><span class="menu-text">Cart</span></a></li>
                                <li><a href="shopping-cart-empty.html"><span class="menu-text">Cart Empty</span></a></li>
                                <li><a href="wishlist.html"><span class="menu-text">Wishlist</span></a></li>
                                <li><a href="product-details.html"><span class="menu-text">Single Product</span></a></li>
                                <li><a href="my-account.html"><span class="menu-text">My Account</span></a></li>
                                <li><a href="login-register.html"><span class="menu-text">Login Register</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>


@endsection