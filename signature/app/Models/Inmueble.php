<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
     protected $table = "inmuebles";

     public function user()
    {
        return $this;
    }
}
