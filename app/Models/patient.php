<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class patient extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['status','date_injury','updated_at','date_healing'];

    public function contact(){
        return $this->hasMany(ContactMap::class,'contact_id');
    }

    public function contact_with(){
        return $this->hasMany(ContactMap::class,'contact_with_id');
    }
}
