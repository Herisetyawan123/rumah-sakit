<?php

namespace App\Http\Livewire\Cms\TransaksiObat;

use App\Models\Bank;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\TransaksiObat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Mediconesystems\LivewireDatatables\Column;
use Illuminate\Auth\Access\AuthorizationException;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TransaksiObatIndex extends LivewireDatatable
{
    use PageAction;
    public $hideable = 'select';
    public $operation = 'viewAny';
    public $model = TransaksiObat::class;

    public function __construct()
    {
        $this->confirmAuthorization();
    }

    public function Builder(){
        return TransaksiObat::query()->where('status_pembayaran','pending')->orWhere('status_pengambilan','!=','diterima');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->sortable()->searchable(),
            Column::name('kode_transaksi')->searchable(),
            Column::callback('pasien_id', function ($row) {
                $pasien = Pasien::all();
                foreach ($pasien as $value) {
                    if ($value->id == $row) {
                        return $value->nama;
                    }
                }
                return '';
            })->label('Pasien'),
            DateColumn::callback('created_at',function($row){
                return Carbon::parse($row)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y');
            })->searchable()->filterable()->label('tanggal_pemesanan'),
            Column::callback(['status_pembayaran'], function ($status_pembayaran) {
                return view('components.cms.status-pembayaran', ['status' => $status_pembayaran, 'permissions' => $this->permission()]);
            })->unsortable()->label('Status Pembayaran'),
            Column::callback(['metode_pembayaran'], function ($metode_pembayaran) {
                return view('components.cms.metode-pembayaran', ['status' => $metode_pembayaran, 'permissions' => $this->permission()]);
            })->unsortable()->label('Metode Pembayaran'),
            Column::callback(['status_proses'], function ($status_proses) {
                return view('components.cms.status-proses', ['status' => $status_proses, 'permissions' => $this->permission()]);
            })->unsortable()->label('Status Proses'),
            Column::callback(['status_pengambilan', 'jenis_pengambilan'], function ($status_konsultasi) {
                return view('components.cms.status-pengambilan', ['status' => $status_konsultasi, 'permissions' => $this->permission()]);
            })->unsortable()->label('Status Pengambilan'),
            Column::callback(['jenis_pengambilan'], function ($jenis_pengambilan) {
                return view('components.cms.status-jenis', ['status' => $jenis_pengambilan, 'permissions' => $this->permission()]);
            })->unsortable()->label('Status Pengambilan'),
            NumberColumn::callback(['harga_saat_ini'], function ($harga_saat_ini) { 
                return 'Rp. '.number_format($harga_saat_ini,0,',','.');

            })->unsortable()->label('Total Biaya'),
            Column::callback(['id'], function ($id) {
                return view('components.cms.action', ['id' => $id, 'permissions' => $this->permission()]);
            })->unsortable()->label('action'),
            Column::callback(['id','status_pengambilan'], function ($id) {
                return view('components.cms.detail-transaksi', ['id' => $id, 'permissions' => $this->permission()]);
            })->unsortable()->label('lihat detail'),
        ];
    }
    
    public function permission()
    {
        return $this->getBasePermission((new TransaksiObat()));
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
        $permission = 'cms.' . (new TransaksiObat())->getTable() . '.' . $this->operation;

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
            route($this->getBaseRouteName().$action, ['transaksi_obat' => $key])
        );
    }
}
