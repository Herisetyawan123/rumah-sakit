<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use Livewire\Component;

class ChatComponent extends Component
{
    public $chatId;

    public function mount($id)
    {
        $this->chatId = $id;
    }

    public function render()
    {
        $chat = Chat::with('ChatDetail')->find($this->chatId);
        return view('livewire.chat-component', ['chat' => $chat])->extends('layouts.layout_user')
        ->section('content');
    }
}
