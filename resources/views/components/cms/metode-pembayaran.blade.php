<div>
    @if ($status == 'cod')
        <div class="badge badge-success ">Bayar Ditempat</div>
    @elseif ($status == 'transfer')
        <div class="badge badge-primary">Transfer</div>
    @endif
</div>
