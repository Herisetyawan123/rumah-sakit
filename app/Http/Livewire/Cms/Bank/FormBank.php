<?php
namespace App\Http\Livewire\Cms\Bank;

use App\Models\Bank;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Illuminate\Auth\Access\AuthorizationException;

class FormBank extends Component
{
    use PageAction;
    use WithFileUploads;
    // define eloquent model to use direct data binding
    public Bank $bank;

    public $operation;
    public $image;
    public $uploadImage;

    // POST
    protected $rules = [
        'bank.nama_bank'=>'required|string|max:255',
        'bank.no_rekening'=>'required|string|max:255',
    ];

    /**
     * Confirm bank authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . $this->bank->getTable() . '.' . $this->operation;
        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    public function mount(){
        $this->confirmAuthorization();
        $this->image = $this->bank->getMedia($this->bank::LOGO_BANK);

    }

    public function backToIndex()
    {
        return redirect(route('cms.bank.index'));
    }

    public function save()
    {
        if (($this->operation !== 'create') && ($this->operation !== 'update')) {
            return redirect()->to(route('cms.bank.index'));
        }

        $this->confirmAuthorization();

       $this->validate();

       $this->bank->save();

       if ($this->uploadImage instanceof TemporaryUploadedFile) {
        $this->bank->addMedia($this->uploadImage)
            ->toMediaCollection($this->bank::LOGO_BANK);
        }

       session()->flash('success', 'Bank berhasil ditambahkan.');
       return redirect(route('cms.bank.index'));
    }
}

?>
