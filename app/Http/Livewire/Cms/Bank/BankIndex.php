<?php

namespace App\Http\Livewire\Cms\Bank;


use App\Models\Bank;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use Mediconesystems\LivewireDatatables\Column;
use Illuminate\Auth\Access\AuthorizationException;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class BankIndex extends LivewireDatatable
{
    use PageAction;
    public $hideable = 'select';
    public $model = Bank::class;
    public $operation = 'viewAny';


    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->sortable()->searchable(),
            Column::name('nama_bank')->searchable(),
            Column::name('no_rekening')->searchable(),
            Column::callback(['id'], function ($id) {
                return view('components.cms.action', ['id' => $id,'permissions'=>$this->permission()]);
            })->unsortable()->label('Action')
        ];
    }

    public function permission()
    {
        return $this->getBasePermission((new Bank()));
    }

    /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    public function getBaseRouteName(): string
    {
        return 'cms.bank.';
    }

    /**
     * Confirm Bank authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'cms.' . (new Bank())->getTable() . '.' . $this->operation;

        if (!Auth::guard('cms')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }
}
