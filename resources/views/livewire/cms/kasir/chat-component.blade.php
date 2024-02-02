<div class="mt-1 mb-[5.1rem] flex justify-center px-10 h-screen">
    <div class="flex flex-col bg-slate-200 h-[70%] max-w-[50%] rounded-md relative justify-start">
    @if($chat->status == 'selesai')
        <form action="/cms/kasir/chat/{{ $chat->id }}" method="post" class="w-full">
            @csrf
            @method('PUT')
            <button tyoe="submit" class="bg-green-500 py-2 text-white w-full text-center">
                Mulai chat (pencet dulu)
            </button>
        </form>

        @else
        <form action="/cms/kasir/chat/{{ $chat->id }}" method="post" class="w-full">
            @csrf
            @method('PUT')
            <button tyoe="submit" class="bg-yellow-500 py-2 text-white w-full text-center">
                Selesai Konsultasi (tekan jika selesai)
            </button>
        </form>
        @endif
        <div id="box" wire:poll class="box-container h-[500px] w-full bg-slate-100 overflow-auto" onload="scrollBottom">
            @foreach($chat->ChatDetail as $item)     
                @if($item->pengirim == 'kasir')       
                <div class="flex w-full justify-end my-2">
                    <div class="box-chat bg-green-500 px-5 py-3 rounded-md mx-3">
                        {{ $item->content }}
                    </div>
                </div>
                @else 
                <div class="flex w-full justify-start my-2">
                    <div class="box-chat bg-white px-5 py-3 rounded-md mx-3">
                        {{ $item->content }}
                    </div>
                </div>
                @endif     
            @endforeach


        </div>

        <form action="{{ route('cms.send.chat') }}"  method="POST" class="h-[15%] p-2 justify-center flex gap-2">
            @csrf
            <input type="hidden" name="chat_id" value="{{ $chat->id }}">
            <input type="hidden" name="pengirim" value="kasir">
            <input name="pesan" type="text" placeholder="pesan" class="rounded-md border border-blue-100">
            @if($chat->status == 'selesai')
            <button type="submit" disabled class="px-3 py-2 text-white bg-green-200 rounded">
                Kirim
            </button>
            @else
            <button type="submit" class="px-3 py-2 text-white bg-green-600 rounded">
                Kirim
            </button>
            @endif
        </form>
    </div>
</div>