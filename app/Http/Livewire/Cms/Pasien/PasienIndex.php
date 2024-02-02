<?php

namespace App\Http\Livewire\Cms\Pasien;


use App\Models\Kasir;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Mediconesystems\LivewireDatatables\Column;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Crypt;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PasienIndex extends LivewireDatatable
{
    use PageAction;
    public $hideable = 'select';
    public $model = Pasien::class;
    public $operation = 'viewAny';

    public function __construct()
    {
        $this->confirmAuthorization();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->sortable()->searchable(),
            Column::name('email')->searchable(),
            Column::name('nama')->searchable(),
            Column::callback(['jenis_kelamin'],function($row){
                return $row == 'L'?'Laki-laki':'Perempuan';
            })->label('Jenis Kelamin'),
            Column::name('no_telepon')->searchable(),
            Column::name('alamat')->searchable(),
            // Column::name('roles.name')->label('jabatan')->filterable($this->roles),
            Column::callback(['id','alamat'], function ($id,$alamat) {
                return view('components.cms.action', ['id' => $id,'permissions'=>$this->permission()]);
            })->unsortable()->label('action')
        ];
    }

    public function permission()
    {
        // dd($this->getBasePermission((new Kasir())));
        return $this->getBasePermission((new Pasien()));
    }

    /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    public function getBaseRouteName(): string
    {
        return 'cms.pasien.';
    }

    /**
     * Confirm Kasir authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . (new Pasien())->getTable() . '.' . $this->operation;

        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }
}
