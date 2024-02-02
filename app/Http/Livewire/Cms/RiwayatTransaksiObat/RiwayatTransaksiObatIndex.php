<?php

namespace App\Http\Livewire\Cms\RiwayatTransaksiObat;

use App\Models\Pasien;
use App\Models\TransaksiObat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Mediconesystems\LivewireDatatables\Column;
use Illuminate\Auth\Access\AuthorizationException;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Exports\DatatableExport;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RiwayatTransaksiObatIndex extends LivewireDatatable
{

    use PageAction;
    public $hideable = 'select';
    public $exportable = true;
    public $operation = 'viewAny';
    public $model = TransaksiObat::class;
    public $pdfExport;

    public function __construct()
    {
        $this->confirmAuthorization();
        $this->pdfExport = route('cms.transaksi-obat-export.export');
    }

    // public function Builder(){
    //     return TransaksiObat::query()->where(function ($query) {
    //         $query->where('status_pembayaran','lunas')->where('status_pengambilan','diterima');
    //     })->orWhere('status_pembayaran','ditolak');
    // }

    public function export(string $filename = 'DatatableExport.xlsx')
    {
        $this->forgetComputed();

        $export = new DatatableExport($this->getExportResultsSet());
        $export->setFilename('Transaksi_Obat_'.Carbon::now('GMT+7').'.xlsx');

        return $export->download();
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
            Column::callback(['status_pembayaran'], function ($status_pembayaran) {
                return view('components.cms.status-pembayaran', ['status' => $status_pembayaran, 'permissions' => $this->permission()]);
            })->unsortable()->label('Status Pembayaran')->exportCallback(function ($value) {
                return (string) $value;
            }),
            Column::callback(['status_pengambilan'], function ($status_konsultasi) {
                return view('components.cms.status-pengambilan', ['status' => $status_konsultasi, 'permissions' => $this->permission()]);
            })->unsortable()->label('Status Konsultasi')->exportCallback(function ($value) {
                return (string) $value;
            }),
            NumberColumn::callback(['harga_saat_ini'], function ($harga_saat_ini) {
                return 'Rp. '.number_format($harga_saat_ini,0,',','.');
            })->unsortable()->label('Total Biaya'),
            Column::callback(['id'], function ($id) {
                return view('components.cms.action', ['id' => $id, 'permissions' => $this->permission()]);
            })->unsortable()->label('action')->excludeFromExport(),
            Column::callback(['id','status_pengambilan'], function ($id) {
                return view('components.cms.detail-transaksi', ['id' => $id, 'permissions' => $this->permission()]);
            })->unsortable()->label('lihat detail')->excludeFromExport(),
        ];
    }

    function getTotalHarga($id)
    {
        $totalHarga = 0;
        $transaksi = TransaksiObat::findOrFail($id);
        foreach ($transaksi->detailTransaksi as $key => $value) {
            $totalHarga += $value->jumlah * $value->harga_saat_ini;
        }

        return $totalHarga;
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
        return 'cms.riwayat-transaksi-obat.';
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
            route($this->getBaseRouteName().$action, ['riwayat_transaksi_obat' => $key])
        );
    }

    // function pdfExport()
    // {
    //     return 'https://laravel-livewire.com/docs/2.x/alpine-js#extracting-blade-components';
    // }

}
