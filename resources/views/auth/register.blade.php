@extends('layouts.landing')

@section('content')

 <div id="page">
        <!-- Header Section Start -->
        @include('includes.header-base')
        <!-- Header Section End -->

        <!-- Page Title Section Start -->
        <div class="page-title-section section">
            <div class="page-title">
                <div class="container">
                    <h1 class="title">Ingresar o Registrar</h1>
                </div>
            </div>
           
        </div>
        <!-- Page Title Section End -->


        <!--Login Register section start-->
        <div class="login-register-section section section-padding-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-12">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6">
                                <!-- Login Form Start -->
                                <div class="login-form-wrapper">
                                    <h3 class="title">Ingresar</h3>
                                    <form class="login-form" action="#">
                                        <div class="single-input mb-30">
                                            <label for="username">DNI</label>
                                            <input type="text" id="username" name="username" placeholder="DNI Personal">
                                        </div>
                                        <div class="single-input mb-30">
                                            <label for="password">Contraseña</label>
                                            <input type="text" id="password" name="password" placeholder="Contraseña">
                                        </div>
                                        <div class="single-input mb-30">
                                            <div class="row">
                                                <div class="col-sm-12 lost-your-password-wrap">
                                                    <p>
                                                        <a href="#" class="lost-your-password">Restablecer contraseña?</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-input">
                                            <button class="btn btn-primary btn-hover-secondary btn-width-100">Ingresar</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Login Form End -->
                            </div>
                            <div class="col-xl-6 offset-xl-1 col-lg-6">
                                <!-- Register Form Start -->
                                <div class="login-form-wrapper mt-sm-50 mt-xs-50">
                                    <h3 class="title">Registro</h3>
                                    <form class="register-form" action="#">
                                        <div class="single-input mb-30">
                                            <label for="usernameOne">Nombre del campus</label>
                                            <input type="text" id="usernameOne" name="username" placeholder="Username">
                                        </div>
                                        <div class="single-input mb-30">
                                            <label for="email">Email</label>
                                            <input type="text" id="email" name="username" placeholder="Email">
                                        </div>
                                        <div class="single-input mb-30">
                                            <label for="passwordOne">Password</label>
                                            <input type="text" id="passwordOne" name="password" placeholder="Password">
                                            <p class="description">La contraseña debe tener al menos doce caracteres, contener letras mayúsculas y minúsculas, contener números, contener símbolos como ! " ? $ % ^ &amp; ).</p>
                                        </div>
                                        <div class="single-input">
                                            <button class="btn btn-primary btn-hover-secondary btn-width-100">Crear Cuenta</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Register Form End -->
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!--Login Register section end-->

        @include('includes.footer-menu')

        <!-- Scroll Top Start -->
        <a href="#" class="scroll-top" id="scroll-top">
            <i class="arrow-top fal fa-long-arrow-up"></i>
            <i class="arrow-bottom fal fa-long-arrow-up"></i>
        </a>
        <!-- Scroll Top End -->
    </div>

    @include('includes.menu-mobiles')



<div class="container-scroller d-none">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="../../assets/images/logo.svg">
                </div>
                <h4>Hola, Bienvenidos</h4>
                <h6 class="font-weight-light">Completa los campos porfavor</h6>
                <form method="POST" action="{{ route('register') }}" class="pt-3">
                    @csrf
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username" name="name" value="{{ old('name') }}" required >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" required >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  
                  <div class="mt-3">
                    <input type="submit" value="Registrar" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Ya tienes cuenta? <a href="/login" class="text-primary">Ingresar</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

@endsection
