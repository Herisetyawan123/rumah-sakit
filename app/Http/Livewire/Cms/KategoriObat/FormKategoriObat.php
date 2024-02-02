<?php

namespace App\Http\Livewire\Cms\KategoriObat;

use Livewire\Component;
use App\Models\KategoriObat;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Illuminate\Auth\Access\AuthorizationException;


class FormKategoriObat extends Component
{
    use PageAction;
    public KategoriObat $kategori_obat;
    public $operation;

    // POST
    protected $rules = [
        'kategori_obat.kategori' => "required|string|max:255"
    ];

    /**
     * Confirm pasien authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . $this->kategori_obat->getTable() . '.' . $this->operation;
        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    public function mount()
    {
        $this->confirmAuthorization();
    }

    public function backToIndex()
    {
        return redirect(route('cms.kategori-obat.index'));
    }

    public function save()
    {
        if (($this->operation !== 'create') && ($this->operation !== 'update')) {
            return redirect()->to(route('cms.kategori-obat.index'));
        }

        $this->confirmAuthorization();

        $this->validate();
        if ($this->operation === "create") {
            $this->validate([
                'kategori_obat.kategori' => 'required|string|max:255|unique:kategori_obat,kategori',
            ]);
        } else {
            $this->validate([
                'kategori_obat.kategori' => 'required|string|max:255|unique:kategori_obat,kategori,' . $this->kategori_obat->id,
            ]);
        }

        $this->kategori_obat->save();

        session()->flash('success', 'Kategori obat berhasil ditambahkan.');
        return redirect(route('cms.kategori-obat.index'));
    }
}
