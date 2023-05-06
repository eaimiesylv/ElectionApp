         @extends('layouts.app')
         @section('content')  
                    <div class="col-md-8 offset-md-2" style="background:white;margin-top:2em;padding:2em"> 
                    <div>
                            <h4>Enter Poll Result Page</h4>
                           @if(session('success'))
								<div class="alert alert-success">
									{{ session('success') }}
								</div>
							
							@endif
							@if (session('error'))
							<div class="alert alert-danger">
								{{ session('error') }}
							</div>
						    @endif







                            
                    </div>  
                    <form method="post" action="/announced_poll_unit_result">
					@csrf
					<!---{{$parties}}-->
					@if(isset($parties))
						<div class="row">
							@foreach($parties as $party)
								<div class="col-md-6">
									<div class="form-group">
										<label for="select1">{{$party->partyname}}</label>
										<input type="number" class="form-control"  value="" name="{{$party->partyid}}" required/>
									</div>
								</div>
							@endforeach
						</div>
					@endif

                   
                
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
 
                    </div>
               
      @endsection     