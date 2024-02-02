<?php

namespace App\Http\Livewire\Cms\Dokter;

use Livewire\Component;
use App\Http\Livewire\Cms\Dokter\FormDokter;
use App\Models\Dokter;

class CreateDokter extends FormDokter
{
    /**
     * Handle the `mount` lifecycle event.
     */
    public function mount(): void
    {
        // $this->dokter = new Dokter();
        // $this->operation = 'create';
        // parent::mount();
    }

    public function render()
    {
        return "oke";
    }
}
