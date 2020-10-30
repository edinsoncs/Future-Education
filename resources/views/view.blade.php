@extends('layouts.app')

@section('content')
<div class="container-scroller">
      @include('nav');
      <div class="container-fluid page-body-wrapper">
        @include('menu')
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Mis cursos </h3>
              <nav aria-label="breadcrumb">
                
              </nav>
            </div>
            <div class="row">
                   <div class="col-md-12 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                      <div class="card-body">
                        <img src="/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Curso profesional <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h3 class="mb-5">{{ $courses[0]->category }}</h3>
                        <h6 class="card-text">{{ $courses[0]->description }}</h6>
                      </div>
                    </div>
                  </div>
               
            </div>
            
           
            <div class="d-none d-lg-block">
              <div class="row">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Temario del curso</h4>
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th> Titulo </th>
                              <th> Tiempo </th>
                              <th> Acceso</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($view as $v)
                                <tr>
                                  <td>
                                    {{ $v->title }}
                                  </td>
                                  <td>
                                    <label class="badge badge-gradient-success"> Duracion del video: {{ $v->time }}</label>
                                  </td>
                                  <td>
                                      <a type="button"  href="/app/view/{{$v->id}}" class="btn btn-gradient-danger btn-rounded btn-fw">Continuar</button>
                                  </td>
                                </tr>
                              @endforeach
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-block d-lg-none">
              
              <div class="row">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body p-lg-3 p-3">
                      <h4 class="card-title">Temario del curso</h4>
                      <div class="table-responsive">

                        @foreach($view as $v)
                          <div class="listTemary mb-3">
                            <a href="/app/view/{{$v->id}}" type="button" class="btn btn-gradient-light btn-rounded btn-fw w-100">
                              {{ $v->title }}
                            </a>
                          </div>
                        @endforeach

                      </div>
                    </div>
                  </div>
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
