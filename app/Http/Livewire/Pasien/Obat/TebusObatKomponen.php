<?php

namespace App\Http\Livewire\Pasien\Obat;

use App\Models\DetailTransaksiObat;
use App\Models\TebusObatDetail;
use App\Models\TransaksiObat;
use Livewire\Component;

class TebusObatKomponen extends Component
{
    protected $listeners = ['switchTab' => 'switchTab', 'submitObat' => 'submitObat', 'updatedata' => 'updatedata'];
    public $activeTab = "informasi";
    
    public $obatId;

    public $formInformasi = [
        'name' => '',
        'no_tlp' => '',
        'nik' => '',
        'alamat' => '',
        'tanggal_lahir' => '',
        'gender' => '',
        'tinggi' => '',
        'berat' => '',
        'alergi' => '',
        'alamat_tujuan' => '',
        'detail_lokasi' => '',
        'pengambilan' => '',
    ];

    public function mount($id)
    {
        $this->obatId = $id;
        $this->formInformasi['name'] = auth()->user()->nama;
        $this->formInformasi['no_tlp'] = auth()->user()->no_telepon;
        $this->formInformasi['alamat'] = auth()->user()->alamat;
        $this->formInformasi['nik'] = auth()->user()->nik;
        $this->formInformasi['tanggal_lahir'] = auth()->user()->tanggal_lahir;
    }

    public function checkInformasiPasien(){
        $excludedKeys = ['tinggi', 'berat', 'alergi', 'alamat_tujuan', 'detail_lokasi', 'pengambilan'];
        $emptyKeys = array_keys(array_filter($this->formInformasi, function ($value){
            return $value === '';
        }));
        $filteredEmptyKeys = array_diff($emptyKeys, $excludedKeys);
        return count($filteredEmptyKeys) > 0;
    }

    public function checkAlamat(){
        if($this->formInformasi['pengambilan'] != ''){
            if($this->formInformasi['pengambilan'] == "diantar"){
                if($this->formInformasi['alamat_tujuan'] != '' || $this->formInformasi['detail_lokasi'] != '' ){
                    return true;
                }else{
                    return false;
                }
            }else{
                return true;
            }
        }else{
            return false;
        }
    }

    public function updatedata($data)
    {
        $this->formInformasi = $data;
    }
    public function switchTab($tab)
    {
        if($this->activeTab == 'informasi' && $this->checkInformasiPasien()){
            return;
        }
        $this->activeTab = $tab;
    }

    public function submitObat()
    {

        if($this->checkAlamat()){
            DetailTransaksiObat::create([
                'transaksi_obat_id' => $this->obatId,
                'tinggi' => $this->formInformasi['tinggi'] == '' ? null : $this->formInformasi['tinggi'],
                'berat' => $this->formInformasi['berat'] == '' ? null : $this->formInformasi['berat'],
                'riwayat_alergi' => $this->formInformasi['alergi'] == '' ? null : $this->formInformasi['alergi'],
                'alamat' => $this->formInformasi['alamat_tujuan'] == '' ? null : $this->formInformasi['alamat_tujuan'],
                'detail_lokasi' => $this->formInformasi['detail_lokasi'] == '' ? null : $this->formInformasi['detail_lokasi'],
            ]);

            $transaksiObat = TransaksiObat::find($this->obatId);
            $transaksiObat->jenis_pengambilan = $this->formInformasi['pengambilan'];
            $transaksiObat->save();
            return redirect('/pasien/beranda');
        }
    }

    public function render()
    {
        return view('livewire.pasien.obat.tebus-obat-komponen')->extends('layouts.layout_user')
        ->section('content');
    }

}
