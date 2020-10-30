@extends('layouts.app')

@section('content')
<div class="container-scroller">
      @include('nav');
      <div class="container-fluid page-body-wrapper">
        @include('menu')
        <div class="main-panel">
          <div class="content-wrapper">
            

          <div class="col-12 grid-margin stretch-card pl-0 pr-0">
                
                <div class="card">
                  <div class="card-body p-3">
                    @if(session()->has('message'))
                    <div class="alert alert-success" role="alert">{{ session()->get('message') }} </div>
                    @endif
                    
                    <h4 class="card-title">Mi Perfil</h4>
                    <p class="card-description"> Actualizar mi informacion </p>
                    <form class="forms-sample" method="post" action="{{ route('profileUpdated') }}">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Nombre</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Nombre" name="name" value="{{ auth()->user()->name }}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password" name="password" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Sexo</label>
                        <select class="form-control" id="exampleSelectGender" name="gender">
                          @if(auth()->user()->gender == 'Masculino')
                              <option value="Masculino" selected>Masculino</option>
                              <option value="Femenino">Femenino</option>
                          @elseif(auth()->user()->gender == 'Femenino')
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino" selected>Femenino</option>
                          @else 
                              <option value="" selected disabled>Selecciona una opción</option>
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option>
                          @endif;
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputCity1">Ciudad</label>
                        <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location" name="city" value="{{auth()->user()->city}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Informacion</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4" name="description" >{{auth()->user()->description}}</textarea>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary mr-2">Actualizar</button>
                      <button class="btn btn-light">Cancelar</button>
                    </form>
                  </div>
                </div>
              </div>


           
            
          
            
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection
