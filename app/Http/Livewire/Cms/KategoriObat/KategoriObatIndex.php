<?php

namespace App\Http\Livewire\Cms\KategoriObat;

use App\Http\Livewire\Cms\Contract\PageAction;
use Mediconesystems\LivewireDatatables\Column;
use App\Models\KategoriObat as ModelsKategoriObat;
use Illuminate\Auth\Access\AuthorizationException;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Auth;


class KategoriObatIndex extends LivewireDatatable
{
    use PageAction;
    public $hideable = 'select';
    public $model = ModelsKategoriObat::class;
    public $operation = 'viewAny';

    public function __construct()
    {
        $this->confirmAuthorization();
    }
    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID Kategori Obat')->sortable()->searchable(),
            Column::name('kategori')->searchable()->editable(),
            Column::callback(['id', 'kategori'], function ($id, $kategori) {
                return view('components.cms.action', ['id' => $id, 'kategori' => $kategori, 'permissions' => $this->permission()]);
            })->unsortable()->label('action')
        ];
    }

    public function permission()
    {
        // dd($this->getBasePermission((new Kasir())));
        return $this->getBasePermission((new ModelsKategoriObat()));
    }

    /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    public function getBaseRouteName(): string
    {
        return 'cms.kategori-obat.';
    }

    /**
     * Confirm Kasir authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . (new ModelsKategoriObat())->getTable() . '.' . $this->operation;

        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    public function performAction(string $action, string $key = null)
    {
        return redirect()->to(
            route($this->getBaseRouteName() . $action, ['kategori_obat' => $key])
        );
    }
}
