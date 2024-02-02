<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\TransaksiObat;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    function transaksiObat()
    {
        $transaksiObat = TransaksiObat::all();
        return view('cms.export.transaksi-obat',['transaksiObat'=>$transaksiObat,'total'=>0]);
    }
}
