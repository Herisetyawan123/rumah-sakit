<?php

namespace App\View\Components;

use App\Models\Konsultasi;
use App\Models\TransaksiObat;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Notification extends Component
{
    public $totalNotif;
    public $transaksiObat;
    public $konsultasi;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->totalNotif = $this->getTotalNotif();
        $this->transaksiObat = TransaksiObat::where('pasien_id',Auth::guard('pasien')->user()->id)->where('status_pembayaran','!=','lunas')->count();
        $this->konsultasi = Konsultasi::where('pasien_id',Auth::guard('pasien')->user()->id)->where('status_pembayaran','!=','lunas')->count();
    }

    function getTotalNotif()
    {
        $konsultasi = Konsultasi::where('pasien_id',Auth::guard('pasien')->user()->id)->where('status_pembayaran','!=','lunas')->count();
        $obat = TransaksiObat::where('pasien_id',Auth::guard('pasien')->user()->id)->where('status_pembayaran','!=','lunas')->count();
        return $konsultasi + $obat;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.notification',[
            'totalNotif' => $this->totalNotif
        ]);
    }
}
