<?php

namespace App\Http\Livewire\Cms\Kasir;

use App\Models\Chat;
use Livewire\Component;

class ChatComponent extends Component
{
    
    public $chatId;

    public function mount($id)
    {
        $this->chatId = $id;
    
        parent::mount();
    }

    public function render()
    {
        $chat = Chat::with('ChatDetail')->find($this->chatId);
        return view('livewire.cms.kasir.chat-component', ['chat' => $chat])
            ->extends('layouts.cms_layout')
            ->section('main-content');
    }
}
