<?php

namespace App\Http\Livewire\Cms\Obat;

use App\Models\Obat;
use Livewire\Component;
use App\Models\KategoriObat;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Illuminate\Auth\Access\AuthorizationException;

class FormObat extends Component
{
    use PageAction;
    use WithFileUploads;
    public Obat $obat;
    public $kategori_obat;
    public $operation;
    public $image;
    public $imageUpload;

    // POST
    protected $rules = [
        'obat.nama' => "required|string|max:255",
        'obat.kategori_obat' => "required|integer|exists:kategori_obat,id",
        'obat.stok' => "required|integer",
        'obat.harga' => "required|integer",
        'obat.deskripsi' => "required|string",
    ];

    /**
     * Confirm pasien authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . $this->obat->getTable() . '.' . $this->operation;
        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    public function mount()
    {
        $this->confirmAuthorization();

        $this->kategori_obat = KategoriObat::pluck("kategori", "id");

        $this->image = $this->obat->getMedia($this->obat::FOTO_OBAT);
    }

    public function backToIndex()
    {
        return redirect(route('cms.obat.index'));
    }

    public function save()
    {
        if (($this->operation !== 'create') && ($this->operation !== 'update')) {
            return redirect()->to(route('cms.kategori-obat.index'));
        }

        $this->confirmAuthorization();
        $this->dispatchBrowserEvent('reset-tinymce');
        $this->validate();
        if ($this->operation === "create") {
            $this->validate([
                'obat.nama' => "required|string|max:255|unique:obat,nama",
                'obat.kategori_obat' => "required|integer|exists:kategori_obat,id",
                'obat.stok' => "required|integer",
                'obat.harga' => "required|integer",
            ]);
        } else {
            $this->validate([
                'obat.nama' => "required|string|max:255|unique:obat,nama," . $this->obat->id,
                'obat.kategori_obat' => "required|integer|exists:kategori_obat,id",
                'obat.stok' => "required|integer",
                'obat.harga' => "required|integer",
            ]);
        }

        $this->obat->save();

        if ($this->imageUpload instanceof TemporaryUploadedFile) {
            $this->obat->addMedia($this->imageUpload)
                ->toMediaCollection($this->obat::FOTO_OBAT);
        }

        session()->flash('success', 'Obat berhasil ditambahkan.');
        return redirect(route('cms.obat.index'));
    }
}
