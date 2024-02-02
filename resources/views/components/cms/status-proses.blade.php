<div>
    @if ($status == 'diproses')
        <div class="badge badge-warning ">Menunggu Diproses</div>
    @elseif ($status == 'selesai')
        <div class="badge badge-success ">Selesai Diproses</div>
    @endif
</div>
