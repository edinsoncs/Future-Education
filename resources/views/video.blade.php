@extends('layouts.app')

@section('content')

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-white">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Comprar el curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-white">
        <div id="paypal-button-container"></div>
<script src="https://www.paypal.com/sdk/js?client-id=AcyD1Jtnudtby7oIIDccUXQukqLocB_S2HAnmkNNMdKUzyaYV_EfEbpF40yKqLLSoQdxTToX8PvRm-9l&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
  paypal.Buttons({
      style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'paypal',
          
      },
      createOrder: function(data, actions) {
          return actions.order.create({
              purchase_units: [{
                  amount: {
                      value: '35'
                  }
              }]
          });
      },
      onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
              alert('Transaction completed by ' + details.payer.name.given_name + '!');
          });
      }
  }).render('#paypal-button-container');
</script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<div class="container-scroller">
      @include('nav');
      <div class="container-fluid page-body-wrapper">
        @include('menu')
        <div class="main-panel">
          <div class="content-wrapper">
            

            <div class="col-lg-12 grid-margin stretch-card pl-0 pr-0">
                <div class="card">
                 
                  @if(auth()->user()->payment == '0')
		            <div class="p-3 d-flex justify-content-between align-items-center flex-wrap">
		            	<h5 class="m-0 text-danger col-12 col-lg-6 pl-0 pr-0">
		            		Hola, el video no se reproducira por falta de pago.
		            	</h5>
		            	<div class="btns col-lg-6 text-righ pr-0 pl-0 mt-2 mt-lg-0">
		            		<button type="button" class="btn btn-gradient-danger btn-fw btn-payment" data-toggle="modal" data-target="#exampleModalLong">Pagar Ahora</button>
		            	</div>
		            </div>

	              @endif


                  @if(session()->has('message'))
                    <div class="alert alert-success" role="alert">{{ session()->get('message') }} </div>
                  @endif

                  <div class="card-body p-lg-3 p-3">
                    <h4 class="card-title">{{ $view[0]->title }}</h4>
                    <p class="card-description"> {{ $view[0]->description }}
                    </p>

                    @if(auth()->user()->payment == '1')
                        @if($view[0]->img)
                            <iframe width="100%" height="463" src="https://www.youtube.com/embed/{{ $view[0]->video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @else
    	                    <video controls width="100%" height="450" id="video-a">
    	                      <source src="{{ $view[0]->video }}" type="video/mp4">
    	                    </video>
	                    @endif
                    @else
	                    <video controls width="100%" height="450" id="video-a">
	                      <source src="" type="video/mp4">
	                    </video>
                    @endif
                    <div class="archives text-right mt-3 d-flex align-items-center justify-content-between flex-wrap">
                      <div class="time text-muted">Tiempo: {{ $view[0]->time }}</div>


                      @if(auth()->user()->payment == '1')

                      	@if($view[0]->files)
						
						<a href="{{ $view[0]->files }}" type="button" class="btn btn-gradient-primary d-block" target="_blank">Descarga Material</a>

						@endif

                      @else

                      	@if($view[0]->files)

                      	<button type="button" class="btn btn-gradient-primary d-block" data-toggle="modal" data-target="#exampleModalLong">Descarga Material</button>

                      	@endif

                      @endif
                      

                    </div>
                  </div>
                </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card pl-0 pr-0">

                <div class="card">
                  <div class="card-body p-lg-3 p-3">
                    <a href="/app/courses/{{ $courses[0]->id }}">
                        <h4 class="card-title">{{ $courses[0]->title }}</h4>
                        <p class="card-description m-0"> {{ $courses[0]->description }}
                        </p>
                    </a>
                  </div>
                </div>
            </div>
            
            <div class="col-lg-12 grid-margin stretch-card pl-0 pr-0">
                <div class="card">

                  <div class="card-body  p-lg-3 p-3">
                    <h4 class="card-title">Comentarios de esta clase</h4>


                  @foreach($cm as $c)

                    <div class="list mb-3 mt-3 border p-3 small">
                      <article class="listShow d-flex">
                        <div class="img">
                          <img src="/assets/images/avatar.jpg" alt="" width="50">
                        </div>
                        <div class="name ml-3">
                          <h3 class="title text-muted small">Un estudiante</h3>
                          <p class="details">{{$c->message}}</p>
                        </div>
                      </article>
                    </div>


                  @endforeach

                  </div>


                  <div class="card-body  p-lg-3 p-3">

                  	@if(auth()->user()->payment == '1')

                  		<form action="{{ route('viewSaveApp') }}" method="post">
	                        @csrf
	                        <input type="hidden" name="courses" value="{{ $view[0]->id }}">
	                        <div class="form-group">
	                            <label for="exampleTextarea1">Publica tu comentario</label>
	                            <textarea class="form-control" id="exampleTextarea1" name="message" rows="4" placeholder="Que opinas de esta clase?"></textarea>
	                        </div>
	                        <button type="submit" class="btn btn-gradient-primary mr-2">Publicar</button>
	                    </form>

                  	@else
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="courses" value="{{ $view[0]->id }}">
                        <div class="form-group">
                            <label for="exampleTextarea1">Publica tu comentario</label>
                            <textarea class="form-control" id="exampleTextarea1" name="message" rows="4" placeholder="Que opinas de esta clase?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2" disabled>Publicar</button>
                    </form>
                    @endif
                  </div>
                </div>
            </div>


           
            
          
            
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
         
            <script>
                // fluidPlayer method is global when CDN distribution is used.
                var player = fluidPlayer('video-a', []);
            </script>
          
          @include('footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection
