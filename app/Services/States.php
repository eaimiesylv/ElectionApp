<?php

namespace App\Services;
Use App\Models\State;

class States{

	
   public function all(){
	   
	   return State::all();
   }
}

?>