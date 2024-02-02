<?php
namespace App\Http\Livewire\Cms\Role;


use Livewire\Component;
use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Illuminate\Auth\Access\AuthorizationException;

class FormRole extends Component
{
    use PageAction;
    public $operation;

    public Role $role;

    public $guards;
    public $permissionOptions = [];
    public $permissions = [];


    // POST
    protected $rules = [
       'role.name'=>'required|string|max:255',
       'role.guard_name'=>'required',
    ];

    public function mount(){
        $this->confirmAuthorization();

        foreach (config('auth.guards') as $key => $value) {
            $this->guards[$key] = $key;
        }
        $collection = Permission::all()->sortBy('name');

        foreach ($collection as $key => $value) {
           if (array_key_exists(explode('.',$value->name)[1],$this->permissionOptions)) {
                array_push($this->permissionOptions[explode('.',$value->name)[1]],$value->name);
           }else{
                $this->permissionOptions[explode('.',$value->name)[1]] = [$value->name];
           }

        }

        if ($this->operation != 'create') {
            $this->permissions = $this->role->permissions->pluck('name');
        }
        // dd($this->permissionOptions);

    }

    /**
     * Confirm Admin authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . $this->role->getTable() . '.' . $this->operation;
        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    public function backToIndex()
    {
        return redirect(route('cms.roles.index'));
    }

    public function save()
    {
        if (($this->operation !== 'create') && ($this->operation !== 'update')) {
            return redirect()->to(route('cms.roles.index'));
        }
        $this->confirmAuthorization();
       $this->validate();

       $this->role->save();
       $this->role->syncPermissions($this->permissions);


       session()->flash('success', 'New competition successfully created.');
       return redirect(route('cms.roles.index'));
    }
}

?>
