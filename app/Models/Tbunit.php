<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbunit extends Model
{
    public $timestamps = false;
    protected $table = 'tbunits';
    protected $primaryKey = 'unitId';
    protected $fillable = ['unitPihakdetail', 'unitIsiKS'];
    // protected $primaryKey = 'unitId';
    // protected $fillable = ['unitPihakdetail', 'unitIsiKS'];

    // public function ks_instansi(){
    //     return $this->belongsTo(Ks_instansi::class);
    // }
    
    // public function tbpihakdetail(){
    //     return $this->belongsTo(Tbpihakdetail::class, 'pdId');
    // }
}
