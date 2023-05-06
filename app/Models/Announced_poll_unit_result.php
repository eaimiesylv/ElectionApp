<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announced_poll_unit_result extends Model
{
    protected $table='announced_pu_results';
    public $timestamps = false;
    // protected $hidden=['updated_at', 'created_at'];
    use HasFactory;
}
