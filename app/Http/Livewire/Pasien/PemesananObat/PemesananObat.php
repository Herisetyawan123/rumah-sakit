<?php

namespace App\Http\Livewire\Pasien\PemesananObat;

use App\Models\Obat;
use Livewire\Component;
use App\Models\TransaksiObat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\DetailTransaksiObat;
use Illuminate\Support\Facades\Auth;

class PemesananObat extends Component
{
    public $listObat;
    public $search;
    public array $cart = [];

    function mount()
    {
        $this->getListObat();
    }

    public function add(string $id){
        $data = Obat::findOrFail($id)->toArray();
        $data['amount'] = 1;
        array_push($this->cart,$data);
        session()->flash('alertType','success');
        session()->flash('alertMessage','Obat berhasil ditambah ke keranjang.');
    }

    public function addAmount(string $id){
        // dd($this->cart);
        foreach ($this->cart as $key => $value) {
            if ($value['id'] == $id) {
                $this->cart[$key]['amount']+=1;
            }
        }

    }
    public function lessAmount(string $id){
        // dd($this->cart);
        foreach ($this->cart as $key => $value) {
            if ($value['id'] == $id) {
                $this->cart[$key]['amount']-=1;
                if ($this->cart[$key]['amount']<1) {
                    unset($this->cart[$key]);
                }
            }
        }

    }

    function getListObat() : void {
        $this->listObat = $this->search? Obat::whereLike(['nama'],$this->search)->get():Obat::all();
    }

    function pesan()
    {
        // dd($this->cart);
        DB::transaction(function () {
            $transaksi_obat = TransaksiObat::create([
                'kode_transaksi'=>'TO'.Auth::guard('pasien')->user()->id.preg_replace('/[^A-Za-z0-9]+/', '', Carbon::now()),
                'tanggal_pemesanan'=> Carbon::now()->toDateString(),
                'pasien_id'=>Auth::guard('pasien')->user()->id,
                'status_pembayaran'=>'pending',
                'status_pengambilan'=>'pending'
            ]);

            foreach ($this->cart as $key => $value) {
                $obat = Obat::findOrFail($value['id']);
                DetailTransaksiObat::create([
                    'transaksi_obat_id'=>$transaksi_obat->id,
                    'obat_id'=>$obat->id,
                    'jumlah'=>$value['amount'],
                    'harga_saat_ini'=>$obat->harga

                ]);

                $obat->stok = $obat->stok - $value['amount'];
                $obat->save();
            }
        });

        return redirect()->route('pasien.tebus-obat.index');
    }

    public function render()
    {
        return view('pages.pasien.obat.obat-index')
        ->extends('layouts.layout_user')
        ->section('content');
    }
}
