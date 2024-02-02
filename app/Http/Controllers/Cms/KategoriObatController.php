<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Cms\KategoriObat\CreateKategoriObat;
use App\Http\Livewire\Cms\KategoriObat\EditKategoriObat;
use App\Http\Livewire\Cms\KategoriObat\ShowKategoriObat;
use App\Models\KategoriObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class KategoriObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("livewire.cms.kategori-obat.index-kategori-obat");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return App::call(CreateKategoriObat::class);
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
     * @param  \App\Models\KategoriObat  $kategoriObat
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriObat $kategori_obat)
    {
        return App::call(ShowKategoriObat::class, ["kategori_obat" => $kategori_obat->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriObat  $kategoriObat
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriObat $kategori_obat)
    {
        return App::call(EditKategoriObat::class, ["kategori_obat" => $kategori_obat->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriObat  $kategoriObat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriObat $kategoriObat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriObat  $kategoriObat
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriObat $kategoriObat)
    {
        //
    }
}
