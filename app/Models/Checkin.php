<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    protected $table_name = 'checkins';
    /**
     * @var mixed|\phpDocumentor\Reflection\Types\Integer
     */
    private $device_id ;
    private $place_id ;
    private $checkin_time ;
    /**
     * @var \Carbon\Carbon|mixed
     */
}
