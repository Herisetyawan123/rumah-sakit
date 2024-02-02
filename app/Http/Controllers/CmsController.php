<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Konsultasi;
use App\Models\TransaksiObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasien = Pasien::all()->count();
        $akun = Pasien::where('login_status',1)->count();
        $jumlahTransaksi = TransaksiObat::where('status_pembayaran','lunas')->where('status_pengambilan','diterima')->count();
        $transaksi = TransaksiObat::where('status_pembayaran','lunas')->where('status_pengambilan','diterima')->get();
        $totalPemasukan = 0;
        foreach ($transaksi as $key => $value) {
            foreach ($value->detailTransaksi as $detail) {
                $totalPemasukan += $detail->jumlah*$detail->harga_saat_ini;
            }
        }
        // dd($totalPemasukan);
        return view('cms.pages.index',[
            'pasien'=>$pasien,
            'akun'=>$akun,
            'jumlahTransaksi'=>$jumlahTransaksi,
            'totalPemasukan'=>$totalPemasukan
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dokter()
    {
        $dokter = Auth::guard('dokter')->user();
        $latestKonsultasi = Konsultasi::where('status_pembayaran','lunas')->where('status_konsultasi','belum konsultasi')->where('dokter_id',$dokter->id)->orderBy('created_at','desc')->first();
        // dd($latestKonsultasi);
        return view('cms.pages.dokter-index',['konsultasi'=>$latestKonsultasi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
