<?php

namespace App\Http\Livewire\Dokter\Konsultasi;


use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use App\Models\Bank;
use App\Models\Dokter;
use App\Models\Konsultasi;
use App\Models\Pasien;
use Illuminate\Auth\Access\AuthorizationException;

class FormKonsultasi extends Component
{
    use PageAction;
    use WithFileUploads;
    public Konsultasi $konsultasi;
    public $kategori_konsultasi;
    public $operation;
    public $image;
    public $imageUpload;

    public array $dokterOptions;
    public array $pasienOptions;
    public array $bankOptions;
    public array $statusPembayaranOptions = [
        'pending'=>'Pending',
        'lunas' =>'Lunas',
        'ditolak'=> 'Ditolak'
    ];
    public array $statusKonsultasiOptions = [
        'belum konsultasi'=>'Belum Konsultasi',
        'selesai' =>'Selesai'
    ];

    // POST
    protected $rules = [
        'konsultasi.no_pesanan' => "required|string|max:255",
        'konsultasi.pasien_id' => "required|integer|exists:pasien,id",
        'konsultasi.dokter_id' => "required|integer|exists:dokter,id",
        'konsultasi.bank_id' => "required|integer|exists:banks,id",
        'konsultasi.no_telepon' => "required|string",
        'konsultasi.tanggal_pesanan' => "required|date",
        'konsultasi.tarif' => "required",
        'konsultasi.status_pembayaran' => "nullable|in:pending,lunas,ditolak",
        'konsultasi.status_konsultasi' => "nullable|in:belum konsultasi,selesai",
    ];

    /**
     * Confirm pasien authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'dokter.' . $this->konsultasi->getTable() . '.' . $this->operation;
        if (!Auth::guard('dokter')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    public function mount()
    {
        $this->confirmAuthorization();

        $this->dokterOptions = Dokter::pluck('nama','id')->toArray();
        $this->pasienOptions = Pasien::pluck('nama','id')->toArray();
        $this->bankOptions = Bank::pluck('nama_bank','id')->toArray();
        $this->image = $this->konsultasi->getMedia($this->konsultasi::BUKTI_PEMBAYARAN_KONSULTASI);

        if ($this->operation === 'create') {
            $this->konsultasi->status_konsultasi = 'belum konsultasi';
            $this->konsultasi->status_pembayaran = 'pending';
        }
    }

    public function backToIndex()
    {
        return redirect(route('dokter.konsultasi.index'));
    }

    public function save()
    {
        if (($this->operation !== 'create') && ($this->operation !== 'update')) {
            return redirect()->to(route('dokter.konsultasi.index'));
        }

        $this->confirmAuthorization();
        // $this->dispatchBrowserEvent('reset-tinymce');
        $this->validate();

        $this->konsultasi->save();

        if ($this->imageUpload instanceof TemporaryUploadedFile) {
            $this->konsultasi->addMedia($this->imageUpload)
                ->toMediaCollection($this->konsultasi::BUKTI_PEMBAYARAN_KONSULTASI);
        }

        session()->flash('success', 'konsultasi berhasil ditambahkan.');
        return redirect(route('dokter.konsultasi.index'));
    }
}
