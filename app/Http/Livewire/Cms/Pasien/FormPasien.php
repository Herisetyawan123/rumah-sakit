<?php

namespace App\Http\Livewire\Cms\Pasien;

use App\Models\Admin;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Livewire\Cms\Contract\PageAction;
use App\Models\Pasien;
use Illuminate\Auth\Access\AuthorizationException;

class FormPasien extends Component
{
    use PageAction;
    // define eloquent model to use direct data binding
    public Pasien $pasien;

    public $operation;
    public $genderOptions = [
        'L' => 'Laki-laki',
        'P' => 'Perempuan'
    ];

    // POST
    protected $rules = [
        'pasien.no_rm' => 'required|string|max:255',
        'pasien.nama' => 'required|string|max:255',
        'pasien.nik' => 'required|string|max:255',
        'pasien.jenis_kelamin' => 'required|in:P,L',
        'pasien.no_telepon' => 'required|string|max:255',
        'pasien.alamat' => 'required|string|max:255',
    ];

    /**
     * Confirm pasien authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . $this->pasien->getTable() . '.' . $this->operation;
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
        return redirect(route('cms.pasien.index'));
    }

    public function save()
    {
        if (($this->operation !== 'create') && ($this->operation !== 'update')) {
            return redirect()->to(route('cms.pasien.index'));
        }

        $this->confirmAuthorization();

        $this->validate();


        $this->pasien->save();
        if ($this->operation === 'create') {
            $this->pasien->assignRole('pasien');
        } else {
            $this->pasien->syncRoles('pasien');
        }


        session()->flash('success', 'Pasien berhasil ditambahkan.');
        return redirect(route('cms.pasien.index'));
    }
}
