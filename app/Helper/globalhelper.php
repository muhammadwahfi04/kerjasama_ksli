<?php

use App\Models\Tbpihak;
use App\Models\Tbpihakdetail;
use App\Models\Tbunit;
use Database\Factories\TbpihakdetailFactory;

if (!function_exists('databerhubungan')) {
    function databerhubungan($id)
    {
        return Tbunit::where('unitIsiKS', $id)->get();
    }
}
if (!function_exists('datapihak')) {
    function datapihak($id)
    {
        return Tbpihakdetail::where('pdId', $id)->get();
    }
}
