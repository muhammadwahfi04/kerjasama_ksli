<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Tbuser extends Authenticatable
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['name', 'password', 'level'];
}
