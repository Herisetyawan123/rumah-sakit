<?php

namespace App\Http\Livewire\Cms\Dokter;


use App\Models\Kasir;
use App\Models\Dokter;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Mediconesystems\LivewireDatatables\Column;
use Illuminate\Auth\Access\AuthorizationException;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\TimeColumn;

class DokterIndex extends LivewireDatatable
{
    use PageAction;
    public $hideable = 'select';
    public $model = Dokter::class;
    public $operation = 'viewAny';

    public function __construct()
    {
        $this->confirmAuthorization();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->sortable()->searchable(),
            Column::name('nama')->searchable(),
            Column::name('email')->searchable(),
            Column::name('umur')->searchable(),
            Column::name('spesialisasi')->searchable(),
            TimeColumn::name('jam_kerja_start')->searchable(),
            TimeColumn::name('jam_kerja_end')->searchable(),
            NumberColumn::name('nominal')->searchable(),
            Column::name('no_telepon')->searchable(),
            Column::callback(['id'], function ($id) {
                return view('components.cms.action', ['id' => $id,'permissions'=>$this->permission()]);
            })->unsortable()->label('Action')
        ];
    }

    public function permission()
    {
        return $this->getBasePermission((new Dokter()));
    }

    /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    public function getBaseRouteName(): string
    {
        return 'cms.dokter.';
    }

    /**
     * Confirm Dokter authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . (new Dokter())->getTable() . '.' . $this->operation;

        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }
}
