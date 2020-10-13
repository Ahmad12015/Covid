<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMap extends Model
{
    use HasFactory;

    public function contact(){
        return $this->belongsTo(patient::class,'contact_id');
    }

    public function contact_with(){
        return $this->belongsTo(patient::class,'contact_with_id');
    }
}
