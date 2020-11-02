@extends('layouts.landing')

@section('content')

<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="/assets/images/logo.svg">
                </div>
                <h4>Hola! bienvenidos</h4>
                <h6 class="font-weight-light">Ingresa con tu cuenta.</h6>
                <form class="pt-3"  method="POST" action="{{ route('login') }}">
                    @csrf
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" required>
                    @error('password')
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                    @enderror
                  </div>
                  <div class="mt-3">
                    <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="Ingresar">
                  </div>
                  <div class="my-2 d-flex justify-content-center align-items-center">
                     <a href="{{ route('password.request') }}" class="auth-link text-black d-block text-center">Restablecer contraseña?</a>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> No tienes cuenta? <a href="/register" class="text-primary">Registro</a>
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
