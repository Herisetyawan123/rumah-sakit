<?php

namespace App\Http\Livewire\Cms\Konsultasi;

use App\Models\Bank;
use App\Models\Kasir;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Konsultasi;
use App\Models\KategoriObat;
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
        return Konsultasi::query()->where('status_pembayaran','!=','pending')->where('status_pembayaran','!=','menunggu konfirmasi');
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
            Column::callback('dokter_id', function ($row) {
                $dokter = Dokter::all();
                foreach ($dokter as $value) {
                    if ($value->id == $row) {
                        return $value->nama;
                    }
                }
                return '';
            })->label('Dokter'),
            Column::name('no_telepon')->searchable(),
            DateColumn::callback('tanggal_pesanan',function($row){
                return Carbon::parse($row)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y');
            })->searchable()->filterable(),
            Column::callback('bank_id', function ($row) {
                $bank = Bank::all();
                foreach ($bank as $value) {
                    if ($value->id == $row) {
                        return $value->nama_bank.' ('.$value->no_rekening.')';
                    }
                }
                return '';
            })->label('Bank'),
            NumberColumn::name('tarif'),
            Column::callback(['status_pembayaran'], function ($status_pembayaran) {
                return view('components.cms.status-pembayaran', ['status' => $status_pembayaran, 'permissions' => $this->permission()]);
            })->unsortable()->label('Status Pembayaran'),
            Column::callback(['status_konsultasi'], function ($status_konsultasi) {
                return view('components.cms.status-konsultasi', ['status' => $status_konsultasi, 'permissions' => $this->permission()]);
            })->unsortable()->label('Status Konsultasi'),
            Column::callback(['id','no_pesanan','pasien.nama','dokter.nama','tanggal_pesanan','tarif','bank.nama_bank','bank.no_rekening'], function (
                $id,
                $no_pesanan,
                $pasien,
                $dokter,
                $tanggal_pesanan,
                $tarif,
                $nama_bank,
                $no_rekening
                ) {
                return view('components.cms.riwayat-konsultasi', [
                    'id' => $id,
                    'no_pesanan'=>$no_pesanan,
                    'pasien'=>$pasien,
                    'dokter'=>$dokter,
                    'tanggal_pesanan'=>Carbon::parse($tanggal_pesanan)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y'),
                    'tarif'=>$tarif,
                    'bank'=>$nama_bank,
                    'no_rekening'=>$no_rekening,
                    'permissions' => $this->permission()]);
            })->unsortable()->label('action'),
        ];
    }

    public function permission()
    {
        return $this->getBasePermission((new Konsultasi()));
    }

    /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    public function getBaseRouteName(): string
    {
        return 'cms.konsultasi.';
    }

    /**
     * Confirm Kasir authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . (new Konsultasi())->getTable() . '.' . $this->operation;

        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }
}
