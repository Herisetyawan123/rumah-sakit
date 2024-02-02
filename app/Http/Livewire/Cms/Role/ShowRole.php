<?php
namespace App\Http\Livewire\Cms\Role;

use App\Http\Livewire\Cms\Role\FormRole;
use Livewire\Component;

class ShowRole extends FormRole
{
     /**
     * Handle the `mount` lifecycle event.
     */
    public function mount(): void
    {
        $this->operation = 'view';
        parent::mount();
    }

    public function render()
    {
        return view('livewire.cms.roles.show-role')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
