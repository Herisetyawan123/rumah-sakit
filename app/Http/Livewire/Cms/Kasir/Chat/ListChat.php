<?php

namespace App\Http\Livewire\Cms\Kasir\Chat;

use App\Http\Livewire\Cms\Contract\PageAction;
use App\Models\Chat;
use App\Models\ChatDetail;
use App\Models\Pasien;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ListChat extends LivewireDatatable
{
    use PageAction;
    public $hideable = 'select';
    public $model = Chat::class;
    public $operation = 'viewAny';

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('Id Chat')->sortable()->searchable(),
            Column::callback(['pasien_id'], function($pasien_id){
                
                $nama = Pasien::find($pasien_id)->nama;
                return $nama;
            })->label('Nama Pasien')->searchable(),
            Column::name('status')->searchable()->searchable(),
            Column::callback(['id', 'status'], function ($id, $status) {
                return view('components.cms.action-chat', ['id' => $id, 'status' => $status, 'permissions' => 'cms.obat.']);
            })->unsortable()->label('action')
        ];
    }

    public function query()
    {
        return Chat::with('pasien'); // Pastikan untuk memuat relasi patient
    }

    public function map($chat): array
{
    return [
        'id' => $chat->id,
        'status' => $chat->status,
        'patient_name' => $chat->pasien->name, // Ambil nama pasien dari relasi
    ];
}

    public function getBaseRouteName(): string
    {
        return 'cms.chat.';
    }

    public function performAction(string $action, string $key = null)
    {
        return redirect()->to(
            route($this->getBaseRouteName() . $action, ['chat' => $key])
        );
    }
}
