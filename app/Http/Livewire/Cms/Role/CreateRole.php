<?php

namespace App\Http\Livewire\Cms\Role;

use Livewire\Component;
use App\Http\Livewire\Cms\Role\FormRole;
use Spatie\Permission\Models\Role;

class CreateRole extends FormRole
{
     /**
     * Handle the `mount` lifecycle event.
     */
    public function mount(): void
    {
        $this->role = new Role();
        $this->operation = 'create';
        parent::mount();
    }


    public function render()
    {
        return view('livewire.cms.roles.create-role')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
