<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbpihakdetail extends Model
{
    public $incrementing = false;
    protected $table = 'tbpihakdetails';
    protected $primaryKey = 'pdId';
    protected $fillable = ['pdKode', 'pdNama'];
    
    // public function tbpihak(){
    //     return $this->belongsTo(Tbpihak::class);
    // }

    // public function tbunit(){
    //     return $this->hasMany(Tbunit::class, 'unitId');
    // }

    public function ks_instansis(){
        return $this->belongsToMany(Tbkerjasama::class, 'tbunits', 'unitPihakdetail', 'unitIsiKS');
    }

}
