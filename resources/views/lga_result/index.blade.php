         @extends('layouts.app')
         @section('content')  
           
                    <div class="col-md-8 offset-md-2 content"> 
                    <h4>L.G.A Result </h4>
                    <div  class='table-responsive' id="poll_result">
                            
                            
                            
                    </div>  
                    <form>
                    <div class="form-group">
                        <label for="State">Select State</label>
                        <select class="form-control" id="state" disabled>
						@if(isset($states))
							
							@foreach($states as $state)
								<option value="{{$state->state_id}}" {{ $state->state_id == 25 ? 'selected' : '' }}>{{$state->state_name}}</option>
							@endforeach
									

							 
						 @endif
                       
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="Lga">Select L.G.A</label>
                        <select class="form-control" id="lga-select"> 
                             <option>Select LGA</option>
                        </select>  
                    </div>
                
               
               
                </form>
 
            </div>
            <script>
                let page="lga_result";
                
            </script>
            <script  src="{{asset('js/form/api.js')}}"></script>
            <script  src="{{asset('js/form/loop.js')}}"></script>
            <script  src="{{asset('js/form/pollunit.js')}}"></script>
           
      @endsection     