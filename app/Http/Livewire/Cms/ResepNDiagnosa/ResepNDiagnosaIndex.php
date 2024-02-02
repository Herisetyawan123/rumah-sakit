<?php

namespace App\Http\Livewire\Cms\ResepNDiagnosa;

use App\Models\Pasien;
use App\Models\ResepNDiagnosa;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use App\Models\Dokter;
use Mediconesystems\LivewireDatatables\Column;
use Illuminate\Auth\Access\AuthorizationException;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ResepNDiagnosaIndex extends LivewireDatatable
{
    use PageAction;
    public $hideable = 'select';
    public $model = ResepNDiagnosa::class;
    public $operation = 'viewAny';

    public function __construct()
    {
        $this->confirmAuthorization();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->sortable()->searchable(),
            Column::name('kode_transaksi')->searchable(),
            Column::callback('pasien_id',function($row){
                $pasien = Pasien::all();
                foreach ($pasien as $value) {
                    if ($value->id == $row) {
                        return $value->nama;
                    }
                }
                return '';
            })->label('Pasien'),
            Column::callback('dokter_id',function($row){
                $dokter = Dokter::all();
                foreach ($dokter as $value) {
                    if ($value->id == $row) {
                        return $value->nama;
                    }
                }
                return '';
            })->label('Dokter'),
            NumberColumn::name('tarif')->searchable(),
            Column::callback(['id'], function ($id) {
                return view('components.cms.action', ['id' => $id,'permissions'=>$this->permission()]);
            })->unsortable()->label('action'),
            Column::callback(['id','tarif'], function ($id) {
                return view('components.cms.transaksi-obat', ['id' => $id,'permissions'=>$this->permission()]);
            })->unsortable()->label('action')
        ];
    }

    public function permission()
    {
        return $this->getBasePermission((new ResepNDiagnosa()));
    }

    /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    public function getBaseRouteName(): string
    {
        return 'cms.resep-n-diagnosa.';
    }

    /**
     * Confirm Kasir authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . (new ResepNDiagnosa())->getTable() . '.' . $this->operation;

        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    /**
     * Perform a specific action for the given record key.
     *
     * @param string      $action
     * @param string|null $key
     *
     * @return mixed
     */
    public function performAction(string $action, string $key = null)
    {
        return redirect()->to(
            route($this->getBaseRouteName().$action, ['resep_n_diagnosa' => $key])
        );
    }
}
