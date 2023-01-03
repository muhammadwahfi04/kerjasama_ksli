<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbkerjasama extends Model
{

    protected $table = 'tbkerjasamas';
    protected $primaryKey = 'ksId';
    // protected $guarded =[];
    // protected $fillable = ['ksJenis', 'ksInstansi', 'ksNama', 'ksKota', 'ksNegara', 'ksBenua', 'ksNoKS', 'ksTglKontrak', 'ksTglAkhir', 'ksJangka', 'ksIsiKS', 'ksKet', 'ksFile', 'ksUnit', 'created_at', 'updated_at'];
    protected $fillable = ['ksJenis', 'ksInstansi', 'ksNama', 'ksKota', 'ksNegara', 'ksBenua', 'ksNoKS', 'ksTglKontrak', 'ksTglAkhir', 'ksJangka', 'ksIsiKS', 'ksKet', 'ksFile', 'created_at', 'updated_at'];

    // public function tbunit(){
    //     return $this->hasMany(Tbunit::class, 'unitId');
    // }
    
    public function tbpihakdetails(){
        // return $this->belongsToMany(Tbpihakdetail::class, 'tbunits', 'unitIsiKS', 'unitPihakdetail')->withPivot('unitPihakdetail')->wherePivot('unitPihakdetail', 'p101');
        return $this->belongsToMany(Tbpihakdetail::class, 'tbunits', 'unitIsiKS', 'unitPihakdetail');
    }

    public function tbunits(){
        return $this->hasMany(Tbunit::class, 'unitIsiKS');
    }
}
