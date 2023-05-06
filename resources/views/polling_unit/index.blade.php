         @extends('layouts.app')
         @section('content')  
           
                    <div class="col-md-8 offset-md-2 content"> 
                    <h4>Poll Result Page</h4>
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
                
                <div class="form-group">
                    <label for="Ward">Select  Ward</label>
                    <select class="form-control" id="ward">
                        <option>Select Ward</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="Poll_unit">Select Poll Unit</label>
                    <select class="form-control" id="poll_unit">
                        <option>Select Poll Unit</option>
                   
                    </select>
                </div>
                
               
                </form>
 
            </div>
            <script  src="{{asset('js/form/api.js')}}"></script>
            <script  src="{{asset('js/form/loop.js')}}"></script>
            <script  src="{{asset('js/form/pollunit.js')}}"></script>
           
      @endsection     