<?php

namespace App\Http\Livewire\Dokter\Konsultasi;

use App\Models\Bank;
use App\Models\Pasien;
use App\Models\Konsultasi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Mediconesystems\LivewireDatatables\Column;
use Illuminate\Auth\Access\AuthorizationException;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RiwayatKonsultasi extends LivewireDatatable
{
    use PageAction;
    public $hideable = 'select';
    public $operation = 'viewAny';
    public $model = Konsultasi::class;

    public function __construct()
    {
        $this->confirmAuthorization();
    }

    public function Builder(){
        $dokter = Auth::guard('dokter')->user();
        return Konsultasi::query()->where('status_pembayaran','lunas')->where('status_konsultasi','selesai')->where('dokter_id',$dokter->id);
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID Kategori Obat')->sortable()->searchable(),
            Column::name('no_pesanan')->searchable()->editable(),
            Column::callback('pasien_id', function ($row) {
                $pasien = Pasien::all();
                foreach ($pasien as $value) {
                    if ($value->id == $row) {
                        return $value->nama;
                    }
                }
                return '';
            })->label('Pasien'),
            Column::name('no_telepon')->searchable(),
            DateColumn::callback('tanggal_pesanan',function($row){
                return Carbon::parse($row)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y');
            })->searchable()->filterable()->label('tanggal pesanan'),
            NumberColumn::name('tarif'),
            Column::callback('bank_id', function ($row) {
                $bank = Bank::all();
                foreach ($bank as $value) {
                    if ($value->id == $row) {
                        return $value->nama_bank.' ('.$value->no_rekening.')';
                    }
                }
                return '';
            })->label('Bank'),
            Column::callback(['status_pembayaran'], function ($status_pembayaran) {
                return view('components.cms.status-pembayaran', ['status' => $status_pembayaran, 'permissions' => $this->permission()]);
            })->unsortable()->label('Status Pembayaran'),
            Column::callback(['status_konsultasi'], function ($status_konsultasi) {
                return view('components.cms.status-konsultasi', ['status' => $status_konsultasi, 'permissions' => $this->permission()]);
            })->unsortable()->label('Status Konsultasi'),
            Column::callback(['id'], function ($id) {
                return view('components.cms.buat-resep', ['konsultasi_id' => $id, 'permissions' => $this->permission()]);
            })->unsortable()->label('action'),
        ];
    }

    public function permission()
    {
        return $this->getBasePermissionDokter((new Konsultasi()));
    }

    /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    public function getBaseRouteName(): string
    {
        return 'dokter.konsultasi.';
    }

    /**
     * Confirm Kasir authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'dokter.' . (new Konsultasi())->getTable() . '.' . $this->operation;

        if (!Auth::guard('dokter')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }
}
