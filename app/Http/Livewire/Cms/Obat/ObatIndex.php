<?php

namespace App\Http\Livewire\Cms\Obat;

use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use App\Models\KategoriObat;
use Mediconesystems\LivewireDatatables\Column;
use Illuminate\Auth\Access\AuthorizationException;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ObatIndex extends LivewireDatatable
{
    use PageAction;
    public $hideable = 'select';
    public $model = Obat::class;
    public $operation = 'viewAny';

    public function __construct()
    {
        $this->confirmAuthorization();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID Kategori Obat')->sortable()->searchable(),
            Column::name('nama')->searchable()->editable(),
            Column::callback('kategori_obat', function ($row) {
                $kategori_obat = KategoriObat::all();
                foreach ($kategori_obat as $value) {
                    if ($value->id == $row) {
                        return $value->kategori;
                    }
                }
                return '';
            })->label('Kategori Obat'),
            Column::name('stok')->searchable()->editable(),
            Column::name('harga')->searchable()->editable(),
            Column::callback(['id', 'nama'], function ($id, $nama) {
                return view('components.cms.action', ['id' => $id, 'nama' => $nama, 'permissions' => $this->permission()]);
            })->unsortable()->label('action')
        ];
    }

    public function permission()
    {
        // dd($this->getBasePermission((new Kasir())));
        return $this->getBasePermission((new Obat()));
    }

    /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    public function getBaseRouteName(): string
    {
        return 'cms.obat.';
    }

    /**
     * Confirm Kasir authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . (new Obat())->getTable() . '.' . $this->operation;

        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    public function performAction(string $action, string $key = null)
    {
        return redirect()->to(
            route($this->getBaseRouteName() . $action, ['obat' => $key])
        );
    }
}
