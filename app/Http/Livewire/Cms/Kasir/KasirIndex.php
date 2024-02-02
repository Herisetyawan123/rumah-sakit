<?php

namespace App\Http\Livewire\Cms\Kasir;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use App\Models\Kasir;
use Mediconesystems\LivewireDatatables\Action;
use Mediconesystems\LivewireDatatables\Column;
use Illuminate\Auth\Access\AuthorizationException;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class KasirIndex extends LivewireDatatable
{
    use PageAction;
    public $hideable = 'select';
    public $model = Kasir::class;
    public $roles;
    public $operation = 'viewAny';


    public function __construct()
    {
        $this->roles = Role::plucK('name');
        $this->confirmAuthorization();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID Kasir')->sortable()->searchable(),
            Column::name('nama')->searchable()->editable(),
            Column::name('email')->searchable()->editable(),
            Column::name('alamat')->searchable()->editable(),
            // Column::name('roles.name')->label('jabatan')->filterable($this->roles),
            Column::callback(['id', 'nama'], function ($id, $name) {
                return view('components.cms.action', ['id' => $id, 'name' => $name, 'permissions' => $this->permission()]);
            })->unsortable()->label('action')
        ];
    }

    public function permission()
    {
        // dd($this->getBasePermission((new Kasir())));
        return $this->getBasePermission((new Kasir()));
    }

    /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    public function getBaseRouteName(): string
    {
        return 'cms.kasir.';
    }

    /**
     * Confirm Kasir authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . (new Kasir())->getTable() . '.' . $this->operation;

        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }
}
