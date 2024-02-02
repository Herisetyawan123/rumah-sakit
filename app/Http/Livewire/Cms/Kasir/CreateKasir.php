<?php

namespace App\Http\Livewire\Cms\Kasir;

use App\Models\Admin;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Livewire\Cms\Admin\FormAdmin;
use App\Http\Livewire\Cms\Kasir\FormKasir;
use App\Models\Kasir;

class CreateKasir extends FormKasir
{

     /**
     * Handle the `mount` lifecycle event.
     */
    public function mount(): void
    {
        $this->kasir = new Kasir();
        $this->operation = 'create';
        parent::mount();
    }



    public function render()
    {
       return view('livewire.cms.kasir.create-kasir')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
