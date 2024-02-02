<?php

namespace App\Http\Livewire\Cms\TransaksiObat;

use App\Models\Obat;
use App\Models\Pasien;
use Livewire\Component;
use App\Models\TransaksiObat;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\DetailTransaksiObat;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Illuminate\Auth\Access\AuthorizationException;

class FormTransaksiObat extends Component
{
    use PageAction;
    use WithFileUploads;
    // define eloquent model to use direct data binding
    public TransaksiObat $transaksi_obat;
    public DetailTransaksiObat $detail_transaksi_obat;

    public $operation;

    public array $statusPembayaranOptions = [
        'pending'=>'Pending',
        'menunggu konfirmasi'=>'Menunggu Korfirmasi',
        'lunas'=>'Lunas',
        'ditolak'=>'Ditolak'
    ];

    public array $statusPengambilanOptions = [
        'pending'=>'Pending',
        'diterima'=>'Diterima',
        'sedang diantarkan'=>'Sedang Diantarkan'
    ];

    public array $jenisPengambilan = [
        "diambil"=>"Diambil",
        "diantar"=>"Diantar",
    ];

    public array $jenisProses = [
        "diproses"=>"diproses",
        "selesai"=>"selesai",
    ];

    public $pasienOptions;
    public $obatOptions;

    public array $pesananObat = [];

    public $images = [];
    public $imageUpload;

    // POST
    protected $rules = [
        'transaksi_obat.kode_transaksi' => 'nullable|string|max:255',
        'transaksi_obat.harga_saat_ini' => 'required',
        'transaksi_obat.pasien_id' => 'required|integer|exists:pasien,id',
        'transaksi_obat.status_pembayaran' => 'nullable|in:pending,lunas,menunggu konfirmasi,ditolak',
        'transaksi_obat.jenis_pengambilan' => 'nullable|in:diambil,diantar',
        'transaksi_obat.status_pengambilan' => 'nullable|in:pending,diterima,sedang diantarkan',
        'transaksi_obat.status_proses' => 'nullable|in:diproses,selesai',
    ];

    /**
     * Confirm transaksi_obat authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . $this->transaksi_obat->getTable() . '.' . $this->operation;
        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    function addObat()
    {
        array_push($this->pesananObat, [
            'obat_id' => null,
            'amount'=>null
        ]);
    }

    public function mount()
    {
        $this->confirmAuthorization();

        $this->images = $this->transaksi_obat->getMedia($this->transaksi_obat::BUKTI_PEMBAYARAN);
        // dd($this->images);

        $this->pasienOptions = Pasien::pluck('nama','id')->toArray();
        $this->obatOptions = Obat::pluck('nama','id')->toArray();
    }

    public function backToIndex()
    {
        return redirect(route('cms.transaksi-obat.index'));
    }

    public function save()
    {
        if (($this->operation !== 'create') && ($this->operation !== 'update')) {
            return redirect()->to(route('cms.transaksi-obat.index'));
        }

        $this->confirmAuthorization();


        $this->validate();

        if ($this->operation == 'create') {
            $this->transaksi_obat->kode_transaksi = 'TO'.$this->transaksi_obat->pasien_id.preg_replace('/[^A-Za-z0-9]+/', '', Carbon::now());


            DB::transaction(function () {
                $this->transaksi_obat->save();

                foreach ($this->pesananObat as $key => $value) {
                    DetailTransaksiObat::create([
                        'transaksi_obat_id'=>$this->transaksi_obat->id,
                        'jumlah'=>$value['amount'],
                    ]);
                }
            });
        }else{
            if($this->transaksi_obat->status_pengambilan == 'diterima'){
                $this->transaksi_obat->status_pembayaran = 'lunas';
            }
            $this->transaksi_obat->save();
        }


        if ($this->imageUpload instanceof TemporaryUploadedFile) {
            $this->transaksi_obat->addMedia($this->imageUpload)
                ->toMediaCollection($this->transaksi_obat::BUKTI_PEMBAYARAN);
        }


        session()->flash('success', 'transaksi obat berhasil ditambahkan.');
        return $this->backToIndex();
    }
}
