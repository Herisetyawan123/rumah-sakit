<?php

namespace App\Http\Livewire\Cms\ResepNDiagnosa;

use App\Models\Dokter;
use App\Models\Pasien;
use Livewire\Component;
use App\Models\ResepNDiagnosa;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Illuminate\Auth\Access\AuthorizationException;

class FormResepNDiagnosa extends Component
{
    use PageAction;
    // define eloquent model to use direct data binding
    public ResepNDiagnosa $resep_n_diagnosa;

    public $operation;
    public $pasienOptions;
    public $dokterOptions;

    // POST
    protected $rules = [
        'resep_n_diagnosa.kode_transaksi' => 'required|string|max:255',
        'resep_n_diagnosa.pasien_id' => 'required|numeric|exists:pasien,id',
        'resep_n_diagnosa.dokter_id' => 'required|numeric|exists:dokter,id',
        'resep_n_diagnosa.tarif' => 'required',
        'resep_n_diagnosa.resep' => 'required',
        'resep_n_diagnosa.diagnosa' => 'required',
    ];

    /**
     * Confirm pasien authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . $this->resep_n_diagnosa->getTable() . '.' . $this->operation;
        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    public function mount()
    {
        $this->confirmAuthorization();
        $this->pasienOptions = Pasien::pluck('nama','id');
        $this->dokterOptions = Dokter::pluck('nama','id');
    }

    public function backToIndex()
    {
        return redirect(route('cms.resep-n-diagnosa.index'));
    }

    public function save()
    {
        if (($this->operation !== 'create') && ($this->operation !== 'update')) {
            return redirect()->to(route('cms.resep-n-diagnosa.index'));
        }

        $this->confirmAuthorization();

        $this->validate();

        $this->resep_n_diagnosa->save();


        session()->flash('success', 'Pasien berhasil ditambahkan.');
        return redirect(route('cms.resep-n-diagnosa.index'));
    }
}
