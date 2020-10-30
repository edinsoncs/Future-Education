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
              @foreach($courses as $c)
                @if($c->id == 1)
                   <div class="col-md-6 stretch-card grid-margin">
                    <a class="card bg-gradient-danger card-img-holder text-white" href="/app/courses/{{ $c->id }}">
                      <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Curso profesional <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h3 class="mb-5">{{ $c->category }}</h3>
                        <h6 class="card-text">Continua aprendiendo</h6>
                      </div>
                    </a>
                  </div>
  
                @elseif($c->id == 2)

                    <div class="col-md-6 stretch-card grid-margin">
                        <a class="card bg-gradient-info card-img-holder text-white" href="/app/courses/{{ $c->id }}">
                          <div class="card-body">
                            <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Curso profesional <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                            </h4>
                            <h3 class="mb-5">{{ $c->category }}</h3>
                            <h6 class="card-text">Continua aprendiendo</h6>
                          </div>
                        </a>
                      </div>
                @else

                     <div class="col-md-4 stretch-card grid-margin">
                        <a class="card bg-gradient-success card-img-holder text-white" href="/app/courses/{{ $c->id }}">
                          <div class="card-body">
                            <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Curso profesional <i class="mdi mdi-diamond mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ $c->category }}</h2>
                            <h6 class="card-text">Continua aprendiendo</h6>
                          </div>
                        </a>
                      </div>

                @endif
              @endforeach
            </div>
            
           
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                 
                    <div class="row mt-3">
                     <img src="/assets/images/live.jpg" alt="" class="w-100">
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
