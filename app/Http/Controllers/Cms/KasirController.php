<?php

namespace App\Http\Controllers\Cms;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Livewire\Cms\Admin\EditAdmin;
use App\Http\Livewire\Cms\Admin\ShowAdmin;
use App\Http\Livewire\Cms\Kasir\EditKasir;
use App\Http\Livewire\Cms\Kasir\ShowKasir;
use App\Http\Livewire\Cms\Admin\CreateAdmin;
use App\Http\Livewire\Cms\Kasir\ChatComponent;
use App\Http\Livewire\Cms\Kasir\CreateKasir;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.cms.kasir.index-kasir');       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateKasir())(app(), Request()->route());
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

    public function listChat()
    {
        return view('livewire.cms.kasir.list-chat');
    }

    public function chat($id)
    {
        return App::call(ChatComponent::class);
    }

    public function show($id)
    {
        return App::call(ShowKasir::class, ['admin' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return App::call(EditKasir::class, ['admin' => $id]);
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
