<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model {
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}