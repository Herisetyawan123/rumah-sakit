<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Livewire\Cms\Konsultasi\CreateKonsultasi;
use App\Http\Livewire\Cms\Konsultasi\EditKonsultasi;
use App\Http\Livewire\Cms\Konsultasi\ShowKonsultasi;
use App\Http\Livewire\Cms\Konsultasi\ShowRiwayatKonsultasi;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.cms.konsultasi.index-konsultasi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return App::call(CreateKonsultasi::class);
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
        return App::call(ShowKonsultasi::class,['konsultasi'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return App::call(EditKonsultasi::class,['konsultasi'=>$id]);
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

    public function riwayat()
    {
        return view('livewire.cms.konsultasi.riwayat-konsultasi');
    }
    public function showRiwayat($id)
    {
        return App::call(ShowRiwayatKonsultasi::class,['konsultasi'=>$id]);
    }
}
