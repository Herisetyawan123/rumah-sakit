<?php
namespace App\Http\Livewire\Cms\Kasir;

use App\Models\Admin;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Livewire\Cms\Contract\PageAction;
use App\Models\Kasir;
use Illuminate\Auth\Access\AuthorizationException;

class FormKasir extends Component
{
    use PageAction;
    // define eloquent model to use direct data binding
    public Kasir $kasir;
    public $password;
    public $confirmPassword;
    public $isVisible = false;
    public $email;

    public $operation;

    // POST
    protected $rules = [
       'kasir.nama'=>'required|string|max:255',
       'kasir.alamat'=>'required',
       'email'=>'required|email',
    ];

    /**
     * Confirm kasir authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . $this->kasir->getTable() . '.' . $this->operation;
        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    public function mount(){
        $this->confirmAuthorization();

        // dd($this->operation );
        if ($this->operation != 'create') {
            $this->email = $this->kasir->email;
        }
    }

    public function backToIndex()
    {
        return redirect(route('cms.kasir.index'));
    }

    public function save()
    {
        if (($this->operation !== 'create') && ($this->operation !== 'update')) {
            return redirect()->to(route('cms.kasir.index'));
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
                'kasir.nama'=>'required|string|max:255',
                'kasir.alamat'=>'required',
                'email'=>'required|email|unique:kasir,email',
                'password'=>'required|string|min:8|alpha_num',
                'confirmPassword'=>'required|string|min:8|alpha_num',
            ]);
            $this->kasir->password = Hash::make($this->password);
       }


       $this->kasir->email = $this->email;
       $this->kasir->save();
       if ($this->operation === 'create') {
            $this->kasir->assignRole('Kasir');
       }else{
        $this->kasir->syncRoles('Kasir');
       }


       session()->flash('success', 'New competition successfully created.');
       return redirect(route('cms.kasir.index'));
    }
}

?>
