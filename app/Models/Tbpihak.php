<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbpihak extends Model
{
    use HasFactory;

    public function tbpihakdetail(){
        return $this->hasMany(Tbpihakdetail::class);
    }
}
