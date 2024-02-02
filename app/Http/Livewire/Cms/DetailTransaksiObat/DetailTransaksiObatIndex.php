<?php

namespace App\Http\Livewire\Cms\DetailTransaksiObat;


use App\Models\Pasien;
use App\Models\DetailTransaksiObat;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use App\Models\Obat;
use App\Models\TransaksiObat;
use Carbon\Carbon;
use Mediconesystems\LivewireDatatables\Column;
use Illuminate\Auth\Access\AuthorizationException;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DetailTransaksiObatIndex extends LivewireDatatable
{
    use PageAction;
    public $hideable = 'select';
    public $operation = 'viewAny';
    public $model = DetailTransaksiObat::class;
    // public $params = ['transaksiId'];

    public $transaksiId;

    public function __construct()
    {
        $this->confirmAuthorization();

    }

    public function Builder(){
        return DetailTransaksiObat::query()->where('transaksi_obat_id',$this->transaksiId);
    }

    public function columns()
    {
        return[
            NumberColumn::name('id')->label('ID')->sortable()->searchable(),
            Column::name('transaksi.kode_transaksi')->label('Kode Transaksi'),
            Column::name('transaksi.harga_saat_ini')->label('Kode Transaksi'),
            Column::callback(['tinggi'],function($tinggi){
                return $tinggi ?? 'Tidak tercantum' ;
            })->label('tinggi'),
            Column::callback(['berat'],function($berat){
                return $berat ?? 'Tidak tercantum' ;
            })->label('Berat'),

            Column::callback(['riwayat_alergi'],function($riwayat_alergi){
                return $riwayat_alergi ;
            })->label('riwayat alergi'),
            Column::callback(['alamat'],function($alamat){
                return $alamat ;
            })->label('alamat'),
            Column::callback(['detail_lokasi'],function($detail_lokasi){
                return $detail_lokasi ;
            })->label('Detail Lokasi'),
            Column::callback(['id'], function ($id) {
                return view('components.cms.action', ['id' => $id, 'permissions' => $this->permission()]);
            })->unsortable()->label('action')
        ];
    }

    public function permission()
    {
        return $this->getBasePermission((new DetailTransaksiObat()));
    }

    /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    public function getBaseRouteName(): string
    {
        return 'cms.transaksi-obat.';
    }

    /**
     * Confirm Kasir authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . (new DetailTransaksiObat())->getTable() . '.' . $this->operation;

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
            route($this->getBaseRouteName().$action, ['detail_transaksi_obat' => $key])
        );
    }
}
