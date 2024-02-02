<?php

namespace App\Http\Controllers;

use App\Http\Livewire\ChatComponent;
use App\Models\Chat;
use App\Models\ChatDetail;
use App\Models\Kasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ChatController extends Controller
{

    public function proccessChat(){
        $pasien = auth()->user()->id;
        $kasir = Kasir::first();
        $chat = Chat::where("pasien_id", $pasien)->where('kasir_id', $kasir->id)->where('status', 'berlangsung')->first();
        if($chat == null){
            $new_chat = Chat::create([
                'pasien_id' => $pasien,
                'kasir_id' => $kasir->id,
                'status' => 'berlangsung',
            ]);

            return redirect('/pasien/chat/'. $new_chat->id);
        }
        $chat->save();

        return redirect('/pasien/chat/'.$chat->id);
    }

    public function chat($id)
    {
        return App::call(ChatComponent::class);

    }

    public function updatestatus($id){
        $chat = Chat::find($id);
        if($chat->status == 'selesai'){
            $chat->status = 'berlangsung';
        }else{
            $chat->status = 'selesai';
        }
        $chat->save();

        return redirect('/pasien/chat/'.$id);
    }

    public function send(Request $request)
    {
    
        $request->validate([
            'pesan' => 'required',
            'chat_id' => 'required',
            'pengirim' => 'required',
        ]);

        $send = ChatDetail::create([
            'pengirim' => $request->pengirim,
            'content' => $request->pesan, 
            'chat_id' => $request->chat_id,
        ]);


        return redirect()->back();
    }
}
