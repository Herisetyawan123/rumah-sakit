<?php
namespace App\Http\Livewire\Cms\Dokter;

use App\Models\Admin;
use App\Models\Kasir;
use App\Models\Dokter;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Livewire\Cms\Contract\PageAction;
use Illuminate\Auth\Access\AuthorizationException;

class FormDokter extends Component
{
    use PageAction;
    use WithFileUploads;
    // define eloquent model to use direct data binding
    public Dokter $dokter;
    public $password;
    public $confirmPassword;
    public $isVisible = false;
    public $email;
    public $image;
    public $uploadedImage;

    public $operation;

    // POST
    protected $rules = [
       'dokter.nama'=>'required|string|max:255',
       'email'=>'required|email',
        'dokter.umur'=>'required|numeric',
        'dokter.spesialisasi'=>'required|string',
        'dokter.jam_kerja_start'=>'required',
        'dokter.jam_kerja_end'=>'required',
        'dokter.nominal'=>'required|numeric',
        'dokter.no_telepon'=>'required|string',
    ];

    /**
     * Confirm dokter authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . $this->dokter->getTable() . '.' . $this->operation;
        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    public function mount(){
        $this->confirmAuthorization();

        $this->uploadedImage = $this->dokter->getMedia($this->dokter::FOTO_DOKTER);
        // dd($this->operation );
        if ($this->operation != 'create') {
            $this->email = $this->dokter->email;
        }
    }

    public function backToIndex()
    {
        return redirect(route('cms.dokter.index'));
    }

    public function save()
    {
        if (($this->operation !== 'create') && ($this->operation !== 'update')) {
            return redirect()->to(route('cms.dokter.index'));
        }

        $this->confirmAuthorization();

       $this->validate();
       if ($this->operation === 'create') {
            if ($this->password != $this->confirmPassword) {
                session()->flash('alertType', 'danger');
                session()->flash('alertMessage', 'Password not match');
                return redirect()->back();
            }
            $validatedData = $this->validate([
                'dokter.nama'=>'required|string|max:255',
                'email'=>'required|email|unique:dokter,email',
                'password'=>'required|string|min:8|alpha_num',
                'confirmPassword'=>'required|string|min:8|alpha_num',
            ]);
            $this->dokter->password = Hash::make($this->password);
       }


       $this->dokter->email = $this->email;
       $this->dokter->save();
       if ($this->operation === 'create') {
            $this->dokter->assignRole('Dokter');
       }else{
        $this->dokter->syncRoles('Dokter');
       }

       if ($this->image instanceof TemporaryUploadedFile) {
        $this->dokter->addMedia($this->image)
            ->toMediaCollection($this->dokter::FOTO_DOKTER);
    }


       session()->flash('success', 'New dokter successfully created.');
       return redirect(route('cms.dokter.index'));
    }
}

?>
